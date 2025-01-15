<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Service.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <div class="about">
        <div class="service">
            <h1 class="Service-pet">Pet Services</h1>
            <div class="services-list">
                <!-- Ô Room Booking -->
                <div class="service-item booking">
                    <h2>Khách sạn thú cưng</h2>
                    <img src="{{ asset('anh/ks.webp') }}" style="height:300px;width:500px">
                    <div class="room-button">
                        <a href="{{ route('User.booking') }}"><button id="viewRooms" class="room-action">View Available Rooms</button></a>
                    </div>
                </div>
                @foreach($services as $service)
                <div class="service-item">
                    <h2>{{ $service->Description }}</h2>
                    <img src="{{ asset('anh/dv.webp') }}" style="height:300px;width:500px;margin-bottom:10px">
                    <!-- Đường dẫn truyền ServiceID -->
                    <div class="room-button">
                        <a class="room-action" href="{{ route('User.appointment', ['ServiceID' => $service->ServiceID]) }}">Xem chi tiết</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>