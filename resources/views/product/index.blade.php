<x-app-layout>
    
    @include('product.partials.view-extras')

    <div class="p-5 product-pagination">
        {{ $products->links() }}
    </div>
</x-app-layout>