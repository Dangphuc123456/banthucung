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
        @if (session('success'))
        <div class="alert alert-success custom-alert" id="success-alert">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <h2>Đặt lịch hẹn</h2>
    <div class="about" style="display: flex; gap: 20px;">
        <!-- Cột trái: Danh sách dịch vụ -->
        <div class="service-list" style="width: 50%;">
            <h3>Danh sách dịch vụ</h3>
            @if($service->isNotEmpty())
            @foreach($service as $item)
            <div class="service-item" style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;">
                <h4>{{ $item->ServiceID }}.{{ $item->ServiceName }}</h4>
                <p><strong>Mô tả:</strong> {{ $item->Description }}</p>
                <p><strong>Giá:</strong> {{ number_format($item->Price, 0, ',', '.') }}đ</p>
                <p><strong>Thời gian:</strong> {{ $item->ServiceDuration }} phút</p>
            </div>
            @endforeach
            @else
            <p>Không có dịch vụ nào để hiển thị.</p>
            @endif
        </div>

        <!-- Cột phải: Form đặt lịch -->
        <div class="appointment" style="width: 50%;">
            <h3>Chọn dịch vụ và điền thông tin</h3>
            <form action="{{ route('User.appointments.submit') }}" method="POST">
                @csrf

                <div class="information">
                    <label for="ServiceID">Chọn dịch vụ:</label>
                    <select id="ServiceID" name="ServiceID" class="form-input" required>
                        <option value="">-- Chọn dịch vụ --</option>
                        @foreach($service as $item)
                        <option value="{{ $item->ServiceID }}">{{ $item->ServiceName }} - {{ number_format($item->Price, 0, ',', '.') }}đ</option>
                        @endforeach
                    </select>
                </div>

                <div class="information">
                    <label for="LocationName">Chọn địa điểm:</label>
                    <select id="LocationName" name="LocationName" class="form-input" required>
                        <option value="">-- Chọn địa điểm --</option>
                        <option value="Số 168 Thượng Đình - Thanh Xuân - Hà Nội">Số 168 Thượng Đình - Thanh Xuân - Hà Nội</option>
                        <option value="294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh">294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh</option>
                        <option value="149-150 Thảo Nguyên - Ecopark - Hưng Yên">149-150 Thảo Nguyên - Ecopark - Hưng Yên</option>
                    </select>
                </div>

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