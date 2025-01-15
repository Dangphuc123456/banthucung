@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')
<div class="table-container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="table-title">List of room</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Service_id</th>
                <th>Description</th>
                <th>Price</th>
                <th>service_type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($service as $sv)
            <tr>
                <td>{{ $sv->service_id }}</td>
                <td>{{ $sv->service_name }}</td>
                <td>{{ $sv->description }}</td>
                <td>{{ number_format($sv->price, 0, ',', '.') }}đ</td>
                <td>{{ $sv->status }}</td>
                <td>
                    <a href="{{ route('admin.servicee.edit', $sv->service_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:yellow">Edit</button></a>
                    <a href="{{ route('admin.servicee.detail', $sv->service_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:green">Show</button></a>
                    <form action="{{ route('servicee.destroy', $sv->service_id) }}" method="POST" class="form-inline">
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