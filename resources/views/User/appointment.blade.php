<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Appointment.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <div class="container">
        <!-- Kiểm tra thông báo đăng nhập thành công -->
        @if (session('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <h2>Đặt lịch hẹn</h2>
    <div class="about">
        <div class="service">
            <h2>Dịch vụ: {{ $service->ServiceName }}</h2>
            <p>Mô tả: {{ $service->Description }}</p>
            <p>Giá: {{ number_format($service->Price, 0, ',', '.') }}đ</p>
            <p>Thời gian dịch vụ: {{ $service->ServiceDuration }} phút</p>
        </div>
        <!-- Form đặt lịch hẹn -->
        <div class="appointment">
            <form action="{{ route('User.appointments.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="ServiceID" value="{{ $service->ServiceID }}">

                <div class="information">
                    <label for="CustomerName">Tên khách hàng:</label>
                    <input type="text" id="CustomerName" name="CustomerName" class="form-input" required>
                </div>

                <div class="information">
                    <label for="CustomerContact">Thông tin liên lạc:</label>
                    <input type="text" id="CustomerContact" name="CustomerContact" class="form-input" required>
                </div>

                <div class="information">
                    <label for="AppointmentDate">Ngày hẹn:</label>
                    <input style="width:300px" type="datetime-local" id="AppointmentDate" name="AppointmentDate" class="form-input" required>
                </div>

                <button type="submit" class="form-button">Đặt lịch</button>
            </form>
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>