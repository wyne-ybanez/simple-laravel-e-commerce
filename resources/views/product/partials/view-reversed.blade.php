    <div class="container">
        <div class="grid w-screen grid-cols-1 lg:grid-cols-2 bg-strong text-black">
            <div class="lg:col-span-1 w-fit lg:p-32 px-[2rem] py-10 my-24">
                <h1 class="lg:text-7xl text-4xl text-soft font-semibold font-crimson-text mb-2">
                    {{$product->title}}
                </h1>

                <hr class="h-[2.5px] rounded my-5 bg-strong">

                <div class="mb-6" x-data="{expanded: true}">
                    <div x-show="expanded" x-collapse.min.290px class="text-soft text-lg wysiwyg-content">
                        {{ $product->description_2 }}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 p-40">
                <div x-data="{
                      image: ['{{$product->image}}'],
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
                          if (this.images.length) {
                                this.activeImage = this.images.length > 0 ? this.images[0] : null;
                          } else {
                             this.activeImage = this.image.length > 0 ? this.image[0] : null;
                          }
                      }
                    }">
                    <div class="relative">
                        <template x-for="item in image">
                            <div x-show="activeImage === item">
                                <img :src="item" alt="" class="w-full shadow shadow-xl shadow-white grayscale rounded" />
                            </div>
                        </template>
                        <template x-for="image in images">
                            <div x-show="activeImage === image">
                                <img :src="activeImage.image" alt="" class="w-full shadow shadow-xl shadow-white grayscale rounded" />
                            </div>
                        </template>
                        <!-- <template x-for="image in images">
                            <a @click.prevent="prev" class="cursor-pointer bg-black/30 text-black absolute left-0 top-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-strong" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        </template>
                        <template x-for="image in images">
                            <a @click.prevent="next" class="cursor-pointer bg-black/30 text-black absolute right-0 top-1/2 -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-strong" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </template> -->
                    </div>
                    <div class="flex mb-[0.1rem]">
                        <template x-for="image in images">
                            <a @click.prevent="activeImage=image" @click="console.log(image)" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image}">
                                <img :src="image.image" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </div>