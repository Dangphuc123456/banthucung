@extends('Admin.admin')
@section('title', 'Add New Supplier')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h2 class="text-center mb-0">Add New Supplier</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.suppliers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier ID</label>
                    <input type="text" class="form-control" name="supplier_id" id="supplier_id" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>

                <div class="mb-3">
                    <label for="contact_person" class="form-label">Contact_person</label>
                    <input type="text" class="form-control" name="contact_person" id="contact_person" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" class="form-control" name="phone" id="phone" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="number" class="form-control" name="email" id="email" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Add Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
