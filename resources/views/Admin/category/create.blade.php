@extends('Admin.admin')
@section('title', 'Add New Categoris')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h2 class="text-center mb-0">Add New Categoris</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="pet_id" class="form-label">Pet ID</label>
                    <input type="text" class="form-control" name="pet_id" id="pet_id" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Add Categoris</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
