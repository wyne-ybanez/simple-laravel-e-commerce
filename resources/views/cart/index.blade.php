<x-app-layout>
    <div class="container lg:w-2/4 xl:w-2/4 mx-auto mt-20 font-montserrat">
        <h1 class="text-3xl font-bold m-6">Basket Items:</h1>

        <!-- Products - Container -->
        <div x-data="{
                cartItems: {{
                    json_encode(
                        $products->map(fn($product) => [
                            'id' => $product->id,
                            'slug' => $product->slug,
                            'image' => $product->image,
                            'title' => $product->title,
                            'price' => $product->price,
                            'quantity' => $cartItems[$product->id]['quantity'],
                            'href' => route('product.view', $product->slug),
                            'removeUrl' => route('cart.remove', $product),
                            'updateQuantityUrl' => route('cart.update-quantity', $product)
                        ])
                    )
                }},
                get cartTotal() {
                    return this.cartItems.reduce((accum, next) => accum + (next.price * next.quantity), 0).toFixed(2)
                },
            }" class="p-5 mb-10">
            <template x-if="cartItems.length">
                <!-- div required as a wrapper for alpine -->
                <div>
                    <template x-for="product of cartItems" :key="product.id">
                        <!-- Product - Item -->
                        <div x-data="productItem(product)">
                            <div class="w-full flex flex-col sm:flex-row items-center gap-4 flex-1">
                                <a :href="product.href" class="w-1/2 h-52 flex items-center justify-center overflow-hidden object-contain">
                                    <img :src="product.image" class="object-cover" alt="" />
                                </a>
                                <div class="flex flex-col justify-between flex-1">
                                    <div class="flex justify-between mb-3">
                                        <h3 x-text="product.title" class="font-semibold"></h3>
                                        <span class="text-lg">
                                            <span x-text="`€${product.price * product.quantity}`">
                                            </span>
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            Quantity:
                                            <input type="number" min="1" x-model="product.quantity" @change="changeQuantity()" class="ml-3 py-1 border-gray-200 focus:border-stone-600 focus:ring-stone-600 w-16" />
                                        </div>
                                        <a href="#" @click.prevent="removeItemFromCart()" class="text-stone-500 hover:text-stone-900">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-5 h-[3px] bg-soft" />
                        </div>
                        <!--/ Product - Item -->
                    </template>

                    <!-- Subtotal -->
                    <div class="py-6">
                        <div class="flex justify-between">
                            <span class="font-semibold text-lg">Subtotal</span>
                            <span id="cartTotal" class="text-xl font-semibold" x-text="`€${cartTotal}`"></span>
                        </div>
                        <p class="text-stone-800 mb-6">
                            Shipping and taxes calculated at checkout
                        </p>
                        <form action="{{ route('cart.checkout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn-primary md:w-2/5 2xl:w-1/5 w-full flex justify-center ml-auto py-3 text-lg">
                                Proceed to Checkout
                            </button>
                        </form>
                    </div>
                    <!--/ Subtotal -->
                </div>
            </template>

            <template x-if="!cartItems.length">
                <div class="text-center text-xl py-8 text-stone-600">
                    You don't have any items in cart
                </div>
            </template>
        </div>
        <!--/ Products - Container -->

    </div>
</x-app-layout>