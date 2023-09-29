    <div class="container">
        <div class="grid w-screen grid-cols-1 lg:grid-cols-2 bg-strong text-black">
            <div class="lg:col-span-1 w-fit lg:p-32 px-[2rem] py-10 my-24">
                <h1 class="lg:text-7xl text-4xl text-soft font-almarai mb-2">
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
                        this.activeImage = this.image.length > 0 ? this.image[0] : null;
                      },
                      grayscale: true,
                    }">
                    <div class="relative">
                        <img :src="activeImage ? activeImage : image" alt="" class="w-full shadow shadow-xl shadow-white cursor-pointer grayscale rounded"
                            :class="grayscale ? 'grayscale' : 'grayscale-0'"
                            @click="grayscale = !grayscale"/>
                    </div>
                    <div class="flex mb-[0.1rem]">
                        <div x-show="image_1">
                            <a @click.prevent="activeImage=image_1" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_1}">
                                <img :src="image_1" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto"/>
                            </a>
                        </div>
                        <div x-show="image_2">
                            <a @click.prevent="activeImage=image_2" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_2}">
                                <img :src="image_2" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto"/>
                            </a>
                        </div>
                        <div x-show="image_3">
                            <a @click.prevent="activeImage=image_3" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_3}">
                                <img :src="image_3" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto"/>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>