<div class="bg-white text-strong text-xl py-32 font-montserrat w-full">
    <h1 class="text-center md:text-9xl sm:text-5xl text-5xl font-extrabold">
        <a href="{{ route('home') }}" class="text-strong">
            {{ getenv('APP_NAME') }}
        </a>
    </h1>
    <div class="container mx-auto justify-items-center grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_1')) }}" class="text-2xl hover:text-soft font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_1') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_4')) }}" class="text-2xl hover:text-soft font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_4') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_3')) }}" class="text-2xl hover:text-soft font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_3') }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route(getenv('PRODUCT_CATEGORY_2')) }}" class="text-2xl hover:text-soft font-bold font-montserrat mt-20 mb-2">
                {{ getenv('PRODUCT_CATEGORY_2') }}
            </a>
        </div>
    </div>
</div>