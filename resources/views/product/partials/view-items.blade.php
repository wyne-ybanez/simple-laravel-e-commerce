<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-14 md:gap-10 lg:gap-12 2xl:gap-20 py-6 px-10 lg:px-20">
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
        class="bg-primary text-strong flex flex-col product-item rounded"
    >
        <a href="{{ route('product.view', $product->slug) }}" class="aspect-w-3 aspect-h-3 block overflow-hidden rounded">
            <img src="{{ $product->image }}" alt="" class="object-cover hover:grayscale-0 hover:scale-105 transition duration-200 ease-in-out rounded"
                :class="{{ $product->color }} ? '' : 'grayscale'"/>
        </a>
        <div class="pt-4 pb-2 border-bg-soft">
            <a href="{{ route('product.view', $product->slug) }}">
                <h3 class="text-xl font-montserrat font-semibold">{{$product->title}}</h3>
            </a>

            <div class="mr-auto">
                <h5 class="text-xl font-montserrat">€{{$product->price}}</h5>
            </div>
        </div>
    </div>
    @endforeach
</div>