@extends('layouts.public-layout')

@section('content')
    <h1 class="mb-4">My Order History</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($orders as $order)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between">
                <span><strong>Order ID:</strong> #{{ $order->id }}</span>
                <span><strong>Status:</strong> <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span></span>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                            <span>${{ number_format($item->price, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer text-end">
                <strong>Total: ${{ number_format($order->total_price, 2) }}</strong>
            </div>
        </div>
    @empty
        <div class="alert alert-info">You have not placed any orders yet.</div>
    @endforelse
@endsection