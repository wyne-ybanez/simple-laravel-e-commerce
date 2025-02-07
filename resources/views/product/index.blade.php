<?php

/** @var \Illuminate\Database\Eloquent\Collection $products */
?>

<x-app-layout>
    <div class="pt-16 pb-8 px-10 lg:px-20 flex flex-col md:items-center md:flex-row lg:flex-row">
        <h1 class="md:text-7xl text-5xl font-almarai mb-10 md:mb-0">{{ $heading }}</h1>

        @include('components.query-nav')
    </div>

    <div class="px-10 lg:px-20 pb-16 2xl:w-1/2 xl:w-[60%]">
        @if (isset($category_description) && $category_description !== null)
            {{ $category_description }}
        @else
            Delve into a world teeming with the imagination of artists who have breathed life into our favourite fantasy universes. 
            From majestic dragons to heroic characters, our carefully curated collection showcases the incredible diversity and creativity of digital artists.
        @endif
    </div>

    @include('product.partials.view-items')

    <div class="px-20 pt-12 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>