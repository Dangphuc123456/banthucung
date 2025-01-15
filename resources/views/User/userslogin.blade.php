<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Userslogin.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
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
    <form action="{{ route('User.userslogin.submit') }}" method="post" class="login">
        @csrf
        <div class="form-container">
            <h2>Đăng Nhập</h2>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" placeholder="Nhập email của bạn" name="email" required style="width:90%">
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" placeholder="Nhập mật khẩu" name="password" required style="width:90%">
            </div>
            <div class="remember-me">
                <input type="checkbox" name="remember"> <span>Nhớ tôi</span>
            </div>
            <button type="submit" class="btn-btn">Đăng Nhập</button>
            <div class="bottom-links">
                <a href="#">Quên mật khẩu?</a> | <a href="{{ route('User.usersregister') }}">Đăng ký</a>
            </div>
        </div>
    </form>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>