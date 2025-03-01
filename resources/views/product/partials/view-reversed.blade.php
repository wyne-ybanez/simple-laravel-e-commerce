<div class="container">
    <div class="grid w-screen grid-cols-1 bg-strong text-black py-20 gap-16 lg:gap-0">
        <div class="w-full lg:px-20 px-10 md:my-0 xl:my-24">
            <h1 class="text-4xl text-soft font-bold font-montserrat mb-2">
                {{$product->title}}
            </h1>

            <hr class="h-[2.5px] rounded my-5 bg-strong">

            <div class="lg:mt-24 lg:mb-10">
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
                        this.activeImage = this.image[0].length > 0 ? this.image[0] : null;
                    },
                    grayscale: true,
                    }">
                    <div class="relative flex flex-col items-center justify-center" id="secondaryGallery">
                        <img :src="activeImage ? activeImage : image[0]" alt="" class="shadow shadow-xl shadow-white cursor-pointer grayscale rounded object-contain max-h-[100vh] lg:max-w-[75vw] lg:max-h-[150vh]" :class="grayscale ? 'grayscale' : 'grayscale-0'" @click="grayscale = !grayscale" />
                        <div class="text-white italic mt-10 text-zinc-300">
                            Click on the image to display image colours
                        </div>
                    </div>
                    <div class="flex mb-[0.1rem] flex-wrap items-center justify-center">
                        <template x-if="image_1[0] || image_2[0] || image_3[0]">
                            <a x-show="image_1[0] || image_2[0] || image_3[0]" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{ 'border-bg-strong': activeImage === image }" href="/#secondaryGallery">
                                <img :src="image[0]" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_1">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_1}" href="/#secondaryGallery">
                                <img :src="image" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_2">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_2}" href="/#secondaryGallery">
                                <img :src="image" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                        <template x-for="image in image_3">
                            <a x-show="image" @click.prevent="activeImage=image" class="cursor-pointer w-[12rem] pt-[0.1rem] pr-[3px] ml-0 pl-0 flex" :class="{'border-bg-strong': activeImage === image_3}" href="/#secondaryGallery">
                                <img :src="image" alt="" class="w-auto mt-10 grayscale rounded hover:shadow-white hover:shadow-lg object-cover h-[10rem] mr-auto" />
                            </a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="mb-6" x-data="{expanded: true}">
                <div class="text-soft text-lg wysiwyg-content">
                    {{ $product->description_2 }}
                </div>
            </div>

        </div>
    </div>
</div>