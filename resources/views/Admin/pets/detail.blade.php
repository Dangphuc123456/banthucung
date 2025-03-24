@extends('Admin.admin')
@section('title', 'Detail Pet')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-0">Detail Pet Information {{$pet_id }}</h2>
        </div>
        <div class="card-body">
            <form action="#" method="#">
                <div class="mb-3">
                    <label for="name" class="form-label">Pet Name :<span> {{ $pets->name }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="species" class="form-label">Species :<span>{{ $pets->species }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="breed" class="form-label">Breed :<span> {{ $pets->breed }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age :<span>{{ $pets->age }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price :<span>{{ number_format($pets->price, 0, ',', '.') }}đ</span></label>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description :<span>{{ $pets->description }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label">Image:</label>
                    <div>
                        <a href="{{ asset('anh/' . $pets->image_url) }}" target="_blank">
                            <img src="{{ asset('anh/' . $pets->image_url) }}"
                                alt="Pet Image"
                                class="img-thumbnail"
                                style="max-width: 200px; max-height: 200px;">
                        </a>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status :<span>{{ $pets->status }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category ID :<span>{{ $pets->category_id }}</span></label>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender :<span>{{ $pets->gender }}</span></label>
                </div>
                <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">Back to Pets</a>
            </form>
        </div>
    </div>
</div>
@endsection