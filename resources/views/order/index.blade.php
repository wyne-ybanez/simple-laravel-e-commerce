<?php

/** @var \Illuminate\Database\Eloquent\Collection $orders */
?>

<x-app-layout>
    <div class="container mx-auto lg:w-2/3 p-5 font-montserrat">
        <h1 class="text-3xl font-bold mb-2">My Orders</h1>
        <div class="bg-white rounded-lg p-3 overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="border-b-2">
                        <th class="text-left p-2">Order</th>
                        <th class="text-left p-2">Date</th>
                        <th class="text-left p-2">Status</th>
                        <th class="text-left p-2">SubTotal</th>
                        <th class="text-left p-2">Items</th>
                        <th class="text-left p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-1 px-2">
                            <a href="#" class="text-purple-600 hover:text-purple-500">
                                #123
                            </a>
                        </td>
                        <td class="py-1 px-2 whitespace-nowrap">12/12/12</td>
                        <td class="py-1 px-2">
                            <small class="py-1 px-2 rounded">
                                Finished
                            </small>
                        </td>
                        <td class="py-1 px-2">$123</td>
                        <td class="py-1 px-2 whitespace-nowrap">1 item(s)</td>
                        <td class="py-1 px-2 flex gap-2 w-[100px]">
                            <form action="#" method="POST">
                                @csrf
                                <button class="flex items-center py-1 btn-primary whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    Pay
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>