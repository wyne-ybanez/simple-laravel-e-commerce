<?php

/** @var \Illuminate\Database\Eloquent\Collection $products */
?>

<x-app-layout>
    <div class="pt-16 pb-8 px-16 flex flex-col justify-between items-center md:flex-row lg:flex-row">
        <h1 class="md:text-7xl text-5xl font-almarai mb-10 md:mb-0">{{ $heading }}</h1>

        @include('components.query-nav')
    </div>

    <div class="px-16 pb-16 lg:w-1/2">
        {{ $pageDescription }}
    </div>

    @include('product.partials.view-items')

    <div class="px-16 pt-12 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>