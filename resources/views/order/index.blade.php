<?php

/** @var \Illuminate\Database\Eloquent\Collection $orders */
?>

<x-app-layout>
    <div class="container mx-auto lg:w-2/3 p-5 font-montserrat">
        <h1 class="text-3xl font-bold mt-6 mb-8">My Orders</h1>
        @if($orders->get(0))
            <div class="bg-white rounded-md p-3 overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="text-left p-2">Order ID</th>
                            <th class="text-left p-2">Date</th>
                            <th class="text-left p-2">Status</th>
                            <th class="text-left p-2">SubTotal</th>
                            <th class="text-left p-2">Items</th>
                            <th class="text-left p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="border-t">
                            <td class="py-4 px-2">
                                <a href="{{ route('order.view', $order) }}" class="text-stone-600 hover:text-stone-500">
                                    #{{ $order->id }}
                                </a>
                            </td>
                            <td class="py-4 px-2 whitespace-nowrap">{{ $order->created_at }}</td>
                            <td class="py-4 px-2">
                                @include('components.status')
                            </td>
                            <td class="py-4 px-2">${{ $order->total_price }}</td>
                            <td class="py-4 px-2 whitespace-nowrap">{{ $order->items_count }} item(s)</td>

                            <td class="py-4 px-2 flex gap-4 w-[100px]">
                                @if ($order->isUnpaid())
                                    <form action="{{ route('cart.checkout-order', $order) }}" method="POST">
                                        @csrf
                                        <button class="flex items-center py-1 btn-primary whitespace-nowrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                            Pay
                                        </button>
                                    </form>
                                @endif
                                @if ($order->isIncomplete())
                                    <a href="{{ route('profile') }}" class="flex items-center py-1 btn-primary whitespace-nowrap">
                                        Add Address
                                    </a>
                                @endif
                                <a href="{{ route('order.view', $order) }}" class="flex items-center py-1 btn-primary whitespace-nowrap">
                                    View
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-3 product-pagination">
                {{ $orders->links() }}
            </div>
        @else 
            <div class="order-complete__message pt-10 mx-auto text-center my-20">
                <h1>
                    Snag our products: Because adulting is tough, <br> 
                    and retail therapy is a lot cheaper than therapy therapy.
                </h1>
                <h1 class="mt-10 font-semibold">
                    You have made no orders...
                </h1>
            </div>
        @endif
    </div>
</x-app-layout>