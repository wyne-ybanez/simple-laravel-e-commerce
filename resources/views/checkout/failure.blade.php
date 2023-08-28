<x-app-layout>
    <div class="w-full mx-auto bg-red-500 py-2 px-3 text-white text-center">
        <h1>Your payment was not successful!</h1>
        <p>{{$message ?? 'Oops, there was an issue'}}</p>
    </div>

    <div class="py-16 px-16">
        <h1 class="md:text-7xl text-5xl font-crimson-text">{{ $heading }}</h1>
    </div>

    @include('product.partials.view-items')

    <div class="px-16 pt-12 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>