<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Helpers\Cart;
use App\Mail\NewOrderEmail;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Helpers\ProductCategory;

class CheckoutController extends Controller
{
    /**
     * CHECKOUT
     */
    public function checkout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        [$products, $cartItems] = Cart::getProductsAndCartItems();

        $orderItems = [];
        $lineItems = []; // what's in the cart
        $totalPrice = 0;

        foreach ($products as $product) {
            $quantity = $cartItems[$product->id]['quantity'];
            $totalPrice += $product->price * $quantity;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $product->title,
                        // 'image' => $product->image
                    ],
                    'unit_amount' => $product->price * 100, // multiply by 100 because Stripe is in cents
                ],
                'quantity' => $quantity,
            ];
            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price
            ];
        }
        // dd(route('checkout.failure', [], true));
        // dd(route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}');

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.failure', [], true),
        ]);

        // Create Order
        $orderData = [
            'total_price' => $totalPrice,
            'status' => OrderStatus::Unpaid,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
        $order = Order::create($orderData);

        // Create Order Items
        foreach ($orderItems as $orderItem) {
            $orderItem['order_id'] = $order->id;
            OrderItem::create($orderItem);
        }

        // Create Payment
        $paymentData = [
            'order_id' => $order->id,
            'amount' => $totalPrice,
            'status' => PaymentStatus::Pending,
            'type' => 'cc',
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'session_id' => $session->id
        ];

        Payment::create($paymentData);

        CartItem::where(['user_id' => $user->id])->delete();

        return redirect($session->url);
    }

    /**
     * SUCCESS
     */
    public function success(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        try {
            $session_id = $request->get('session_id');
            $session = \Stripe\Checkout\Session::retrieve($session_id);
            if (!$session) {
                return view('checkout.failure', ['message' => 'Invalid Session ID']);
            }

            $payment = Payment::query()
                ->where(['session_id' => $session_id])
                ->whereIn('status', [PaymentStatus::Pending, PaymentStatus::Paid])
                ->first();

            if (!$payment) {
                throw new NotFoundHttpException();
            }
            if ($payment->status === PaymentStatus::Pending->value) {
                $this->updateOrderAndSession($payment);
            }

            // return user back to home page
            $customer = \Stripe\Customer::retrieve($session->customer);

            $products = Product::query()
                ->orderBy('updated_at', 'desc')
                ->paginate(12);

            $context = [
                'heading' => 'All Items',
                'products' => $products
            ];

            return view('checkout.success', compact('customer'), $context);
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            $products = Product::query()
                ->orderBy('updated_at', 'asc')
                ->paginate(12);

            $context = [
                'message' => $e->getMessage(),
                'heading' => 'All Items',
                'products' => $products
            ];

            return view('checkout.failure', $context);
        }
    }

    /**
     * FAILURE
     *
     * (Already handled by function above)
     */
    public function failure(Request $request)
    {
        $products = Product::query()
            ->orderBy('updated_at', 'asc')
            ->paginate(12);

        return view('checkout.failure', [
            'message' => 'If the issue persists, please try again later',
            'heading' => 'All Items',
            'products' => $products
        ]);
    }

    /**
     * CHECKOUT ORDER
     */
    public function checkoutOrder(Order $order, Request $request)
    {
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        $lineItems = []; // pass items in cart to Stripe
        foreach ($order->items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item->product->title,
                        // 'image' => $item->product->image
                    ],
                    'unit_amount' => $item->unit_price * 100,
                ],
                'quantity' => $item->quantity,
            ];

            // dd($lineItems);
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.failure', [], true),
        ]);

        $order->payment->session_id = $session->id;
        $order->payment->save();

        return redirect($session->url);
    }

    /**
     * WEBHOOK
     */
    public function webhook()
    {
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        $endpoint_secret = env('WEBHOOK_SECRET_KEY');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 401);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 402);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.sessions.completed':
                $paymentIntent = $event->data->object;
                $sessionId = $paymentIntent['id'];

                $payment = Payment::query()
                    ->where(['session_id' => $sessionId, 'status' => PaymentStatus::Pending])
                    ->first();
                if ($payment) {
                    $this->updateOrderAndSession($payment);
                }
                // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('', 200);
    }

    /**
     * UPDATE ORDER & SESSION
     */
    private function updateOrderAndSession(Payment $payment)
    {
        $payment->status = PaymentStatus::Paid->value;
        $payment->update();

        $order = $payment->order;

        $order->status = OrderStatus::Paid->value;
        $order->update();
        $adminUsers = User::where('is_admin', 1)->get();

        foreach ([...$adminUsers, $order->user] as $user) {
            Mail::to($user)->send(new NewOrderEmail($order, (bool)$user->is_admin));
        }
    }
}
