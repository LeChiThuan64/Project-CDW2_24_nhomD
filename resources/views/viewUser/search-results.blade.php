<div class="search-popup__results">
    @if (isset($products))
        <h1>Search Results for "{{ $keyword }}"</h1>

        @if ($products->isEmpty())
            <p>No products found.</p>
        @else
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3">
                        <div class="product-card">
                            <img src="{{ asset('assets/img/products/' . $product->image_url) }}" 
                                alt="{{ $product->name }}" class="img-fluid">
                            <h5>{{ $product->name }}</h5>
                            <p>{{ $product->price }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>
