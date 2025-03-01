<x-app-layout>
    <div x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'images' => $product->images,
                    'title' => $product->title,
                    'price' => $product->price,
                    'addToCartUrl' => route('cart.add', $product),
                ]) }})" class="container mb-6 md:mb-10 lg:mb-0">
        <div class="grid gap-6 lg:gap-2 w-screen grid-cols-1 lg:grid-cols-2 bg-primary text-primary py-20 lg:pb-30">
            <div class="lg:col-span-1 mx-10 xl:pt-24 lg:pl-10 lg:mr-0">
                <div x-data="{
                    image: ['{{$product->image}}'],
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
                        console.log(this.image[0]);
                    },
                }">
                    <div class="relative px-0 lg:px-0 mb-2 cursor-pointer" id="activeImage">
                        <div class="search-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="50" height="50" viewBox="0,0,256,256" class="relative left-[47%] top-[47%]">
                                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M21,3c-9.37891,0 -17,7.62109 -17,17c0,9.37891 7.62109,17 17,17c3.71094,0 7.14063,-1.19531 9.9375,-3.21875l13.15625,13.125l2.8125,-2.8125l-13,-13.03125c2.55469,-2.97656 4.09375,-6.83984 4.09375,-11.0625c0,-9.37891 -7.62109,-17 -17,-17zM21,5c8.29688,0 15,6.70313 15,15c0,8.29688 -6.70312,15 -15,15c-8.29687,0 -15,-6.70312 -15,-15c0,-8.29687 6.70313,-15 15,-15z"></path></g></g>
                            </svg>
                        </div>
                        <img :src="activeImage ? activeImage : image" alt="Active Image" class="cursor-pointer w-full shadow shadow-lg shadow-zinc-900 md:object-contain lg:max-w-[1000px] rounded relative z-10" />
                        <div id="productCaption" class="hidden">
                            {{ $product->description_2 }}
                        </div>
                    </div>
                    <div class="flex mb-[0.1rem] px-0 lg:px-0 flex-wrap">
                        <template x-if="image_1[0] || image_2[0] || image_3[0]">
                            <a x-show="image_1[0] || image_2[0] || image_3[0]" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{ 'border-bg-strong': activeImage === image }" href="#primaryGallery">
                                <img :src="image[0]" alt="" class="w-auto mt-2 rounded hover:shadow-black hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_1">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_1}" href="#primaryGallery">
                                <img :src="image" alt="" class="w-auto mt-2 rounded hover:shadow-black hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_2">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_2}" href="#primaryGallery">
                                <img :src="image" alt="" class="w-auto mt-2 rounded hover:shadow-black hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_3">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_3}" href="#primaryGallery">
                                <img :src="image" alt="" class="w-auto mt-2 rounded hover:shadow-black hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 w-fit lg:px-20 px-10 md:my-0 xl:my-24">
                <h1 class="font-bold text-4xl font-montserrat mb-2">
                    {{$product->title}}
                </h1>

                <div class="text-xl font-bold mb-4 mt-10">
                    €{{$product->price}}
                </div>
                <div class="flex flex-col md:flex-row md:items-center mb-5">
                    <label for="quantity" class="block font-bold mb-2 mr-4">
                        Quantity
                    </label>
                    <input type="number" name="quantity" x-ref="quantityEl" value="1" min="1" class="w-32 focus:border-stone-500 focus:outline-none rounded text-black mb-6" />
                    <button @click="addToCart($refs.quantityEl.value)" class="btn-primary py-4 text-lg flex md:ml-auto min-w-0 w-fit mb-6">
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

    {{-- @include('product.partials.view-reversed') --}}

    @include('product.partials.featured-items')
</x-app-layout>