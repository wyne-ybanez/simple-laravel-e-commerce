<x-app-layout>
    <div class="w-full mx-auto bg-emerald-500 py-2 px-3 text-white text-center">
        Thank you {{$customer->name}}!
        <br>
        Your payment was successful.
    </div>

    <div class="py-16 px-16">
        <h1 class="md:text-7xl text-5xl font-crimson-text">{{ $heading }}</h1>
    </div>

    @include('product.partials.view-items')

    <div class="px-16 pt-12 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>