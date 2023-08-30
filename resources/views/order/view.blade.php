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
                        <div class="flex justify-between mb-3">
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

            @if (!$order->isPaid())
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
            @else
                <div class="order-complete__message pt-10 mx-auto text-center my-20">
                    <h1>
                        Your payment is complete. Thank you for your purchase. <br>
                        We are processing your order. Please check your email for updates!
                    </h1>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>