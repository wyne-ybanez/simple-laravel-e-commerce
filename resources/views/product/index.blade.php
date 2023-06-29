<x-app-layout>
    <div class="py-16 px-16">
        <h1 class="md:text-7xl text-5xl">{{ $heading }}</h1>
    </div>

    @include('product.partials.view-items')

    <div class="p-5 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>