<x-app-layout>
    <div class="py-20 px-16">
        <h1 class="md:text-9xl text-7xl">{{ $heading }}</h1>
    </div>

    @include('product.partials.view-items')

    <div class="p-5 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>