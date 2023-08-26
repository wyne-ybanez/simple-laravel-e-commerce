<?php

/** @var \Illuminate\Database\Eloquent\Collection $products */
?>

<x-app-layout>
    <div class="py-16 px-16">
        <h1 class="md:text-7xl text-5xl font-crimson-text">{{ $heading }}</h1>
    </div>

    @include('product.partials.view-items')

    <div class="px-16 pt-12 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>