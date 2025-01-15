@extends('Admin.admin')
@section('title', 'Edit Categoris')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-0">Edit Categoris Information</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.category.update', $category->category_id) }}" method="POST">
                @csrf
                @method('PUT') <!-- For update requests -->

                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoris ID</label>
                    <input type="text" class="form-control" name="category_id" id="category_id" value="{{ $category->category_id }}" required>
                </div>

                <div class="mb-3">
                    <label for="category_name" class="form-label">Categoris Name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" value="{{ $category->category_name }}" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Update Categoris</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
