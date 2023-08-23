<footer class="bg-strong text-soft text-xl py-8 font-montserrat w-full mt-40">
    <h1 class="text-center text-soft md:text-9xl sm:text-8xl text-7xl mt-20 font-extrabold">
        <a href="{{ route('home') }}" class="">
            {{ getenv('APP_NAME') }}
        </a>
    </h1>
    <div class="container mx-auto justify-items-center grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_1')) }}" class="text-2xl text-soft hover:text-white font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_1') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_4')) }}" class="text-2xl text-soft hover:text-white font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_4') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_3')) }}" class="text-2xl text-soft hover:text-white font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_3') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_2')) }}" class="text-2xl text-soft hover:text-white font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_2') }}
            </a>
        </div>
    </div>
    <div class="mt-10 pt-8 px-20 text-xl text-soft flex">
        <p>
            &copy; 2023 <span class="font-semibold px-2">{{ getenv('APP_NAME') }}</span>
            All rights reserved
        </p>
        <div class="ml-auto">
            <a class="mr-10 hover:text-white" href="#">Terms of Use</a>
            <a class="hover:text-white" href="#">Privacy Policy</a>
        </div>
    </div>
</footer>