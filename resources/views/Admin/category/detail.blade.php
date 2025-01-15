@extends('Admin.admin')
@section('title', 'Detail Categoris')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-0">Detail Categoris Information {{$category_id}}</h2>
        </div>
        <div class="card-body">
            <form action="#" method="#">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoris ID :<span>{{ $category->category_id }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="category_name" class="form-label">Categoris Name :<span>{{ $category->category_name }}</span></label>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
