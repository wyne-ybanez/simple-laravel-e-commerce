<x-app-layout>
    <div x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'images' => $product->images,
                    'title' => $product->title,
                    'price' => $product->price,
                    'addToCartUrl' => route('cart.add', $product),
                ]) }})" class="container mb-24">
        <div class="grid gap-6 w-screen grid-cols-1 lg:grid-cols-2 bg-primary text-primary py-20">
            <div class="lg:col-span-1 md:px-0 lg:px-20 xl:pt-24 lg:pr-0">
                <div x-data="{
                    image_0: ['{{$product->image}}'],
                    image_1: ['{{$product->image_1}}'],
                    image_2: ['{{$product->image_2}}'],
                    image_3: ['{{$product->image_3}}'],
                    images: [{{$product->images}}][0],
                    activeImage: null,
                    prev() {
                        let index = this.images.indexOf(this.activeImage);
                        if (index === 0) {
                            index = this.images.length;
                        }
                        this.activeImage = this.images[index - 1];
                    },
                    next() {
                        let index = this.images.indexOf(this.activeImage);
                        if (index === this.images.length - 1) {
                            index = -1;
                        }
                        this.activeImage = this.images[index + 1];
                    },
                    init() {
                        console.log(this.image_0[0]);
                    }
                }">
                    <div class="relative">
                        <img :src="activeImage ? activeImage : image_0" alt="" class="w-full cursor-pointer xl:rounded" />
                    </div>
                    <div class="flex mb-[0.1rem]">
                        <template x-if="image_1[0] || image_2[0] || image_3[0]">
                            <a x-show="image_1[0] || image_2[0] || image_3[0]" @click.prevent="activeImage=image_0" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{ 'border-bg-strong': activeImage === image_0 }">
                                <img :src="image_0" alt="" class="w-auto mt-2 rounded hover:shadow-black hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_1">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_1}">
                                <img :src="image" alt="" class="w-auto mt-2 rounded hover:shadow-black hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_2">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_2}">
                                <img :src="image" alt="" class="w-auto mt-2 rounded hover:shadow-black hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_3">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_3}">
                                <img :src="image" alt="" class="w-auto mt-2 rounded hover:shadow-black hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 w-fit md:px-20 px-10 md:my-0 xl:my-24">
                <h1 class="font-bold text-4xl font-montserrat mb-2">
                    {{$product->title}}
                </h1>

                <div class="text-xl font-bold mt-10">€{{$product->price}}</div>
                <div class="flex items-center mb-5">
                    <label for="quantity" class="block font-bold mr-4">
                        Quantity
                    </label>
                    <input type="number" name="quantity" x-ref="quantityEl" value="1" min="1" class="w-32 focus:border-stone-500 focus:outline-none rounded text-black" />
                    <button @click="addToCart($refs.quantityEl.value)" class="btn-primary py-4 text-lg flex ml-auto min-w-0 w-fit mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Add to Basket
                    </button>
                </div>

                <hr class="h-[2.5px] rounded my-5 bg-black">

                <div class="mb-6" x-data="{expanded: false}">
                    <div x-show="expanded" x-collapse.min.280px class="text-black text-lg wysiwyg-content">
                        {{ $product->description }}
                    </div>
                    @if(strlen($product->description) > 300)
                    <p class="text-right">
                        <a @click="expanded = !expanded" href="javascript:void(0)" class="text-stone-500 hover:text-stone-700" x-text="expanded ? 'Read Less' : 'Read More'"></a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('product.partials.view-reversed')

    @include('product.partials.featured-items')
</x-app-layout>