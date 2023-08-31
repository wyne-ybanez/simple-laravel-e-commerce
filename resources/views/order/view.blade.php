<x-app-layout>
<div class="container mx-auto font-montserrat lg:w-2/3 p-5">
        <h1 class="text-3xl font-bold mb-8">Order #{{$order->id}}</h1>
        <div class="bg-white rounded-lg p-10">
            <table>
                <tbody>
                <tr>
                    <td class="font-bold py-1 px-2">Order ID</td>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">Order Date</td>
                    <td>{{$order->created_at}}</td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">Order Status</td>
                    <td>
                        @include('components.status')
                    </td>
                </tr>
                <tr>
                    <td class="font-bold py-1 px-2">SubTotal</td>
                    <td>€{{ $order->total_price }}</td>
                </tr>
                </tbody>
            </table>

            <!-- $order->items() is a static function from 'Order.php' -->
            @foreach($order->items()->with('product')->get() as $item)
                <hr class="my-5"/>

                <!-- Order Item -->
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ route('product.view', $item->product) }}"
                       class="w-36 h-32 flex items-center justify-center overflow-hidden">
                        <img src="{{$item->product->image}}" class="object-cover" alt=""/>
                    </a>
                    <div class="flex flex-col justify-between">
                        <div class="flex justify-between mb-3 font-semibold">
                            <h3>
                                {{$item->product->title}}
                            </h3>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <div>Quantity: <span class="text-lg font-semibold pl-1"> {{$item->quantity}}</span></div>
                                <div class="pl-8">x</div>
                                <div class="pl-8"><span class="text-lg font-semibold">€{{$item->unit_price}} </span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Order Item -->
            @endforeach

            @if ($order->isUnpaid())
                <form action="{{ route('cart.checkout-order', $order) }}"
                      method="POST"
                      class="mt-20">
                    @csrf
                    <button class="btn-primary flex items-center justify-center w-[1/2] mt-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                            />
                        </svg>
                        Make a Payment
                    </button>
                </form>
            @endif
            @if ($order->isIncomplete())
                <button class="btn-primary flex items-center justify-center w-[1/2] mt-20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <a href="{{ route('profile') }}">
                        Add Address
                    </a>
                </button>
            @endif

            <!-- Messages -->
            @if ($order->isShipped() || $order->isPaid())
                <div class="pt-10 mx-auto text-center my-20">
                    <h1>
                        Your payment is complete. Thank you for your purchase. <br>
                        We are processing your order. Please check your email for updates!
                    </h1>
                </div>
            @endif
            @if ($order->isUnpaid())
                <div class="pt-10 mx-auto text-center my-20">
                    <h1>
                        You have made an order however, you were did not complete your payment.
                        <br> Please complete your payment through the link above.
                    </h1>
                </div>
            @endif
            @if ($order->isIncomplete())
                <div class="pt-10 mx-auto text-center my-20">
                    <h1>
                        You have made an order however, you did not provide a Billing &/or a Shipping Address. <br> 
                        Please add it through the link above.
                    </h1>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>