@extends('Admin.admin')
@section('title', 'Detail suppliers')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-0">Detail Pet Information {{$supplier_id }}</h2>
        </div>
        <div class="card-body">
            <form action="#" method="#">
                <div class="mb-3">
                    <label for="name" class="form-label">Name :<span> {{ $suppliers->name }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="contact_person" class="form-label">Contact_person :<span>{{ $suppliers->contact_person }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address :<span> {{ $suppliers->address }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone :<span>{{ $suppliers->phone }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">email :<span>{{ $suppliers->email }}</span></label>
                </div>
                <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">Back to suppliers</a>
            </form>
        </div>
    </div>
</div>
@endsection