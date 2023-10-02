    <div class="container">
        <div class="grid w-screen grid-cols-1 lg:grid-cols-2 bg-strong text-black py-20">
            <div class="lg:col-span-1 w-fit px-20 my-24">
                <h1 class="text-4xl text-soft font-bold font-montserrat mb-2">
                    {{$product->title}}
                </h1>

                <hr class="h-[2.5px] rounded my-5 bg-strong">

                <div class="mb-6" x-data="{expanded: true}">
                    <div x-show="expanded" x-collapse.min.290px class="text-soft text-lg wysiwyg-content">
                        {{ $product->description_2 }}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 xl:my-24 lg:px-20 lg:pl-0">
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
                        <img :src="activeImage ? activeImage : image" alt="" class="w-full shadow shadow-xl shadow-white cursor-pointer grayscale rounded" :class="grayscale ? 'grayscale' : 'grayscale-0'" @click="grayscale = !grayscale" />
                    </div>
                    <div class="flex mb-[0.1rem]">
                        <template x-for="image in image_1">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_1}">
                                <img :src="image" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_2">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_2}">
                                <img :src="image" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_3">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_3}">
                                <img :src="image" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </div>