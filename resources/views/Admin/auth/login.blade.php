@extends('Admin.admin')
@section('title', 'Admin Login')
@section('main')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="login-container">
        <h2 class="text-center mb-4">Admin Login</h2>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="username">Email</label> <!-- Đổi label thành Email -->
                <input type="email" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
            </div>
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection

<style>
    .login-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
</style>