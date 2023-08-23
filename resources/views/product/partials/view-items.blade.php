<div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-10 p-6">

    @foreach($products as $product)
    <!-- Product Item -->
    <div x-data="productItem({{ json_encode([
                        'id' => $product->id,
                        'image' => $product->image,
                        'title' => $product->title,
                        'price' => $product->price,
                        'color' => $product->color,
                        'addToCartUrl' => route('cart.add', $product)
                    ])
                }})"
        class="bg-primary hover:bg-strong hover:text-white flex flex-col product-item rounded-xl"
    >
        <!-- Image -->
        <a href="{{ route('product.view', $product->slug) }}" class="aspect-w-3 aspect-h-3 block overflow-hidden rounded-xl">
            <img src="{{ $product->image }}" alt="" class="p-8 object-cover hover:p-0 hover:m-auto hover:scale-100 transition-transform hover:grayscale-0" 
                :class="{{ $product->color }} ? '' : 'grayscale'"/>
        </a>

        <!-- Title -->
        <div class="px-10 pt-4 pb-2 border-bg-soft">
            <a href="{{ route('product.view', $product->slug) }}">
                <h3 class="text-xl">{{$product->title}}</h3>
            </a>
        </div>

        <!-- Price -->
        <div class="flex justify-end items-end pb-5 px-10 mt-auto">
            <div class="mr-auto">
                <h5 class="font-bold text-xl font-montserrat">€{{$product->price}}</h5>
            </div>
            <div class="flex font-montserrat">
                <!-- <button @click="addToWatchlist()" class="w-10 h-10 mr-2 rounded-sm border border-2 text-strong border-bg-strong flex items-center justify-center hover:bg-stone-800 hover:text-white transition-colors" :class="isInWatchlist(id) ? 'bg-stone-800 text-white' : 'text-strong'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button> -->
                <button class="h-10 border-stone-800 border-2 rounded-sm px-2 hover:border-white" @click="addToCart()">
                    Purchase
                </button>
            </div>
        </div>

    </div>
    @endforeach

</div>