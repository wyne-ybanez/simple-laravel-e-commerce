<x-app-layout>
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 p-5">

        @foreach($products as $product)
        <!-- Product Item -->
        <div x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'image' => $product->image,
                    'title' => $product->title,
                    'price' => $product->price,
                    'addToCart' => route('cart.add', $product->slug)
                ]) }})"
                class="border border-bg-soft bg-primary hover:bg-black flex flex-col">
            <a href="{{ route('product.view', $product->slug) }}" class="aspect-w-3 aspect-h-3 block overflow-hidden">
                <img src="{{ $product->image }}" alt="" class="p-8 object-cover hover:p-0 hover:m-auto hover:scale-105 hover:object-contain transition-transform" />
            </a>

            <div class="px-4 pt-4 pb-2 border-bg-soft border-t">
                <a href="{{ route('product.view', $product->slug) }}">
                    <h3 class="text-xl font-montserrat">{{$product->title}}</h3>
                </a>
            </div>

            <div class="flex justify-end items-end pb-5 px-4 mt-auto">
                <div class="mr-auto">
                    <h5 class="font-bold text-2xl font-montserrat">€{{$product->price}}</h5>
                </div>
                <div class="flex">
                    <!-- <button @click="addToWatchlist()" class="w-10 h-10 mr-2 rounded-sm border border-2 text-strong border-bg-strong flex items-center justify-center hover:bg-stone-800 hover:text-white transition-colors" :class="isInWatchlist(id) ? 'bg-stone-800 text-white' : 'text-strong'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button> -->
                    <button
                        class="h-10 border-bg-strong border-2 rounded-sm px-2 text-strong hover:bg-stone-800 hover:text-white" 
                        @click="addToCart()"
                    >
                        Purchase
                    </button>
                </div>
            </div>

        </div>
        @endforeach

    </div>
    <div class="p-5 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>