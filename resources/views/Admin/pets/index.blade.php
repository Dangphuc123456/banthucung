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
<div class="pagination">
    <ul class="pagination">
        <!-- Nút "Previous" -->
        <li class="page-item {{ $pets->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $pets->previousPageUrl() }}">&laquo; Previous</a>
        </li>

        <!-- Hiển thị số trang rút gọn -->
        @php
            $start = max($pets->currentPage() - 2, 1);
            $end = min($pets->currentPage() + 2, $pets->lastPage());
        @endphp

        @if ($start > 1)
            <li class="page-item"><a class="page-link" href="{{ $pets->url(1) }}">1</a></li>
            @if ($start > 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item {{ $i == $pets->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $pets->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($end < $pets->lastPage())
            @if ($end < $pets->lastPage() - 1)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
            <li class="page-item"><a class="page-link" href="{{ $pets->url($pets->lastPage()) }}">{{ $pets->lastPage() }}</a></li>
        @endif

        <!-- Nút "Next" -->
        <li class="page-item {{ $pets->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $pets->nextPageUrl() }}">Next &raquo;</a>
        </li>
    </ul>
</div>

@endsection