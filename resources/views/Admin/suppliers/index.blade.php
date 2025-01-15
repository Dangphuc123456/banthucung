@extends('Admin.admin')
@section('title', 'List Supplier')
@section('main')
<div class="table-container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="table-title">List of Supplier</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Supplier_id</th>
                <th>Name</th>
                <th>Contact Person</th>
                <th>address</th>
                <th>phone</th>
                <th>email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->supplier_id }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->contact_person }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>{{ $supplier->email }}</td>
                <td>
                    <a href="{{ route('admin.suppliers.edit', $supplier->supplier_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:yellow">Edit</button></a>
                    <a href="{{ route('admin.suppliers.detail', $supplier->supplier_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:green">Show</button></a>
                    <form action="{{ route('suppliers.destroy', $supplier->supplier_id) }}" method="POST" class="form-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" style="background-color:red;margin-top:10px">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection