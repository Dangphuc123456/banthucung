@extends('Admin.admin')
@section('title', 'Add New service')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h2 class="text-center mb-0">Add New service</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.servicee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="service_name" class="form-label">service_name</label>
                    <input type="text" class="form-control" name="service_name" id="service_name" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input type="text" class="form-control" name="description" id="description" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">price</label>
                    <input type="text" class="form-control" name="price" id="price">
                </div>

                <div class="mb-3">
                    <label for="image_sv" class="form-label">Image_sv </label>
                    <input type="file" class="form-control" name="image_sv" id="image_sv">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" id="status">
                        <label class="form-check-label" for="status">Available</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Add service</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
