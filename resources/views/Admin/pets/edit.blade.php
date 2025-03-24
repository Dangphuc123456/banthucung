@extends('Admin.admin')
@section('title', 'Edit Pet')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-0">Edit Pet Information</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pets.update', $pets->pet_id) }}" method="POST" >
                @csrf
                @method('PUT') <!-- For update requests -->

                <div class="mb-3">
                    <label for="name" class="form-label">Pet Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $pets->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="species" class="form-label">Species</label>
                    <input type="text" class="form-control" name="species" id="species" value="{{ $pets->species }}" required>
                </div>

                <div class="mb-3">
                    <label for="breed" class="form-label">Breed</label>
                    <input type="text" class="form-control" name="breed" id="breed" value="{{ $pets->breed }}">
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" name="age" id="age" value="{{ $pets->age }}" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (in USD)</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{ $pets->price }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="4">{{ $pets->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="file" class="form-control" name="image_url" id="image_url" value="{{ $pets->image_url }}">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" id="status" {{ $pets->status ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Available</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category ID</label>
                    <input type="number" class="form-control" name="category_id" id="category_id" value="{{ $pets->category_id }}" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" name="gender" id="gender">
                        <option value="">Select Gender</option> <!-- Lựa chọn mặc định -->
                        <option value="male" {{ $pets->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $pets->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="0" {{ $pets->gender == '0' ? 'selected' : '' }}>0</option> <!-- Lựa chọn "0" -->
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Update Pet</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection