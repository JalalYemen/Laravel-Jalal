@extends('layouts.public-layout')

@section('content')
    <div class="text-center mb-5">
        <h1>Our Products</h1>
        <p class="lead text-muted">Browse our collection of high-quality products.</p>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @forelse ($products as $product)
        <div class="col">
            <div class="card shadow-sm product-card h-100">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 225px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted">{{ $product->category->name }}</p>
                    <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <h4 class="text-success mb-0">${{ number_format($product->price, 2) }}</h4>
                        {{-- UPDATED FORM --}}
                        <form action="{{ route('buy-now', $product->id) }}" method="POST" data-prevent-double-submit="true">
                            @csrf
                            <button type="submit" class="btn btn-primary" {{ $product->quantity < 1 ? 'disabled' : '' }}>
                                {{ $product->quantity < 1 ? 'Out of Stock' : 'Buy Now' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No products are available at the moment. Please check back later!
            </div>
        </div>
        @endforelse
    </div>
@endsection