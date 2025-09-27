@extends('layouts.app')

@section('content')

{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h1 class="h3 mb-3">Order Management</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Customer Orders</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            {{-- We can access the user's name directly because we eager loaded it --}}
                            <td>{{ $order->user->name }}</td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                {{-- Display the status in a styled badge --}}
                                <span class="badge 
                                    @if($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'completed') bg-success
                                    @else bg-secondary @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                {{-- We will add a "View Details" button here later --}}
                                <button class="btn btn-sm btn-info" disabled>View Details</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No orders have been placed yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection