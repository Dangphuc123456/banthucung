@extends('Admin.admin')
@section('title', 'Add New Pet')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h2 class="text-center mb-0">Add New Pet</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="pet_id" class="form-label">Pet ID</label>
                    <input type="text" class="form-control" name="pet_id" id="pet_id" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>

                <div class="mb-3">
                    <label for="species" class="form-label">Species</label>
                    <input type="text" class="form-control" name="species" id="species" required>
                </div>

                <div class="mb-3">
                    <label for="breed" class="form-label">Breed</label>
                    <input type="text" class="form-control" name="breed" id="breed">
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" name="age" id="age" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (in USD)</label>
                    <input type="number" class="form-control" name="price" id="price" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="file" class="form-control" name="image_url" id="image_url">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" id="status">
                        <label class="form-check-label" for="status">Available</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category ID</label>
                    <input type="number" class="form-control" name="category_id" id="category_id" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" name="gender" id="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Add Pet</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
