@extends('Admin.admin')
@section('title', 'List categoris')
@section('main')
<div class="table-container">
    <h2 class="table-title">List of categoris</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Category id</th>
                <th>category name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $categoris)
            <tr>
                <td>{{ $categoris->category_id }}</td>
                <td>{{ $categoris->category_name }}</td>
                <td>
                    <a href="{{ route('admin.category.edit', $categoris->category_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:yellow">Edit</button></a>
                    <a href="{{ route('admin.category.detail', $categoris->category_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:green">Show</button></a>
                    <form action="{{ route('category.destroy', $categoris->category_id) }}" method="POST" class="form-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" style="background-color:red;margin-top:10px">Delete</button >
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
