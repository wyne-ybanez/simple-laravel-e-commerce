@php
    use App\Helpers\ProductCategory;
@endphp

<div class="bg-white text-strong text-xl py-32 font-montserrat w-full">
    <h1 class="text-center md:text-9xl sm:text-5xl text-5xl font-extrabold">
        <a href="{{ route('home') }}" class="text-strong">
            {{ getenv('APP_NAME') }}
        </a>
    </h1>
    <div class="container mx-auto justify-items-center grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="mb-4 mt-20">
            <a href="{{ route('category1') }}" class="text-2xl hover:text-soft font-bold font-montserrat mt-20 mb-2">
                {{ ProductCategory::getCategory('category1')['plural_name'] }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('category2') }}" class="text-2xl hover:text-soft font-bold font-montserrat mt-20 mb-2">
                {{ ProductCategory::getCategory('category2')['plural_name'] }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('category3') }}" class="text-2xl hover:text-soft font-bold font-montserrat mt-20 mb-2">
                {{ ProductCategory::getCategory('category3')['plural_name'] }}
            </a>
        </div>
        <div class="mb-4 mt-20">
            <a href="{{ route('category4') }}" class="text-2xl hover:text-soft font-bold font-montserrat mt-20 mb-2">
                {{ ProductCategory::getCategory('category4')['plural_name'] }}
            </a>
        </div>
    </div>
</div>