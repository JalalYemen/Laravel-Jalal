@extends('layouts.app')

@section('content')

{{-- Success Message --}}
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<h1 class="h3 mb-3">User Management</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Registered Users List</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{-- Display the role in a styled badge --}}
                                @if($user->role == 'admin')
                                <span class="badge bg-primary">Admin</span>
                                @else
                                <span class="badge bg-secondary">Customer</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.users.toggleStatus', $user->id) }}" method="POST" data-prevent-double-submit="true">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $user->status == 'active' ? 'btn-success' : 'btn-secondary' }}">
                                        {{ ucfirst($user->status) }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection