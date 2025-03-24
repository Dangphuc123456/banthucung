<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historicalbooking-pet</title>
    <link rel="stylesheet" href="{{ asset('css/Checking.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <div class="about">
        <h2 class="mb-4">Lịch Sử Đặt Phòng vs Dịch vụ</h2>

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($booking->isEmpty())
        <div class="alert alert-info" style="text-align: center;">Bạn chưa có lịch sử đặt phòng nào.</div>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Đặt Phòng</th>
                    <th>Ngày Nhận Phòng</th>
                    <th>Ngày Trả Phòng</th>
                    <th>Tổng Giá (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($booking as $b)
                <tr>
                    <td>{{ $b->BookingID }}</td>
                    <td>{{ \Carbon\Carbon::parse($b->CheckInDate)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($b->CheckOutDate)->format('d/m/Y') }}</td>
                    <td>{{ number_format($b->TotalPrice, 0, ',', '.') }}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        <!-- dịch vụ -->
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dịch vụ</th>
                    <th>Địa điểm</th>
                    <th>Ngày hẹn</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $index => $appointment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $appointment->ServiceName }}</td>
                    <td>{{ $appointment->LocationName }}</td>
                    <td>{{ date('d/m/Y H:i', strtotime($appointment->AppointmentDate)) }}</td>
                    <td>{{ $appointment->Status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Bạn chưa có lịch hẹn nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            <a href="{{ route('User.home') }}" class="btn btn-primary">Quay lại trang chủ</a>
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>