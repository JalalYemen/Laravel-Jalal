@extends('layouts.app')

@section('content')

<h1 class="h3 mb-3">Add New Category</h1>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Enter the new category name</h5>
            </div>
            <div class="card-body">
                {{-- Display validation errors if any --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- The Form --}}
                <form action="{{ route('categories.store') }}" method="POST" data-prevent-double-submit="true">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter category name">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Category</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection