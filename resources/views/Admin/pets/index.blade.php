@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')
<div class="table-container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="table-title">List of Pets and accessory</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Pet ID</th>
                <th>Species</th>
                <th>Breed</th>
                <th>Description</th>
                <th>Age</th>
                <th>Price</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td>{{ $pet->pet_id }}</td>
                <td>{{ $pet->species }}</td>
                <td>{{ $pet->breed }}</td>
                <td>{{ $pet->description }}</td>
                <td>{{ $pet->age }}</td>
                <td>{{ number_format($pet->price, 0, ',', '.') }}đ</td>
                <td>{{ ucfirst($pet->gender) }}</td>
                <td>{{ $pet->status ? 'Available' : 'Not Available' }}</td>
                <td>
                    <a href="{{ route('admin.pets.edit', $pet->pet_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:yellow">Edit</button></a>
                    <a href="{{ route('admin.pets.detail', $pet->pet_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:green">Show</button></a>
                    <form action="{{ route('pets.destroy', $pet->pet_id) }}" method="POST" class="form-inline">
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