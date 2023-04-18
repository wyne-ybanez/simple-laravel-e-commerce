<x-app-layout>
    <div x-data="productItem({{ json_encode([
                    'id' => $product->id,
                    'slug' => $product->slug,
                    'image' => $product->image,
                    'title' => $product->title,
                    'price' => $product->price,
                ]) }})" class="container">
        <div class="grid gap-6 w-screen grid-cols-1 lg:grid-cols-2">
            <div class="lg:col-span-1">
                <div x-data="{
                      images: ['{{$product->image}}'],
                      activeImage: null,
                      prev() {
                          let index = this.images.indexOf(this.activeImage);
                          if (index === 0)
                              index = this.images.length;
                          this.activeImage = this.images[index - 1];
                      },
                      next() {
                          let index = this.images.indexOf(this.activeImage);
                          if (index === this.images.length - 1)
                              index = -1;
                          this.activeImage = this.images[index + 1];
                      },
                      init() {
                          this.activeImage = this.images.length > 0 ? this.images[0] : null
                      }
                    }">
                    <div class="relative">
                        <template x-for="image in images">
                            <div x-show="activeImage === image">
                                <img :src="image" alt="" class="w-full" />
                            </div>
                        </template>
                        <a @click.prevent="prev" class="cursor-pointer bg-black/30 text-white absolute left-0 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <a @click.prevent="next" class="cursor-pointer bg-black/30 text-white absolute right-0 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex mb-1">
                        <template x-for="image in images">
                            <a @click.prevent="activeImage = image" class="cursor-pointer w-[12rem] pt-1 pr-1 flex items-center justify-center" :class="{'border-bg-strong': activeImage === image}">
                                <img :src="image" alt="" class="w-auto hover:shadow-black hover:shadow-lg object-cover" />
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 w-fit px-[2rem] py-10">
                <h1 class="lg:text-7xl text-4xl font-semibold mb-2">
                    {{$product->title}}
                </h1>
                <div class="mb-6" x-data="{expanded: false}">
                    <div x-show="expanded" x-collapse.min.120px class="text-black wysiwyg-content">
                        {{ $product->description }}
                    </div>
                    <p class="text-right">
                        <a @click="expanded = !expanded" href="javascript:void(0)" class="text-stone-500 hover:text-stone-700" x-text="expanded ? 'Read Less' : 'Read More'"></a>
                    </p>
                </div>

                <hr class="h-[2px] bg-black mb-10">

                <div class="text-xl font-bold mb-6">${{$product->price}}</div>
                <div class="flex items-center mb-5">
                    <label for="quantity" class="block font-bold mr-4">
                        Quantity
                    </label>
                    <input type="number" name="quantity" x-ref="quantityEl" value="1" min="1" class="w-32 focus:border-stone-500 focus:outline-none rounded" />
                    <button @click="addToCart($refs.quantityEl.value)" class="btn-primary py-4 text-lg flex ml-auto min-w-0 w-fit mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>