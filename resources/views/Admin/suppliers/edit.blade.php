@extends('Admin.admin')
@section('title', 'Edit Suppliers')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-0">Edit Suppliers Information</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.suppliers.update', $suppliers->supplier_id) }}" method="POST">
                @csrf
                @method('PUT') <!-- For update requests -->

                <div class="mb-3">
                    <label for="name" class="form-label">Pet Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $suppliers->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="contact_person" class="form-label">Contact_person</label>
                    <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{ $suppliers->contact_person }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{ $suppliers->address }}">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" class="form-control" name="phone" id="phone" value="{{ $suppliers->phone }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email </label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $suppliers->email }}" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Update Suppliers</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
