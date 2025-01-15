<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Booking.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <!-- Form đặt phòng -->
    <form action="{{ route('User.booking.submit') }}" method="POST">  
    @csrf  
    <h2>Book a Room</h2>  
    <div class="about">  
        <div class="room-section">  
            <div class="room-list">  
                @foreach($rooms as $room)  
                <div class="room-item">  
                    <h2>Room ID: {{ $room->RoomID }}</h2>  
                    <p>Gía: {{ number_format($room->PricePerNight, 0, ',', '.') }}đ/ngày</p>  
                    <p>Trạng thái: {{ $room->Status }}</p>  
                    <input type="radio" id="room_{{ $room->RoomID }}" name="RoomID" value="{{ $room->RoomID }}" required>  
                    <label for="room_{{ $room->RoomID }}" class="book-room">Book this Room</label>  
                </div>  
                @endforeach  
            </div>  
        </div>  

        <div class="user-section"> 
            <h2>Thông tin người đặt</h2> 
            <div class="booking-info">  
                <label for="customer_name" class="booking-label">Customer Name</label>  
                <input type="text" id="customer_name" name="customer_name" class="booking-input" required>  
            </div>  

            <div class="booking-info">  
                <label for="phoneNumber" class="booking-label">Phone Number</label>  
                <input type="text" id="phoneNumber" name="PhoneNumber" class="booking-input" required>  
            </div>  

            <div class="booking-info">  
                <label for="email" class="booking-label">Email</label>  
                <input type="email" id="email" name="Email" class="booking-input">  
            </div>  

            <div class="booking-info">  
                <label for="checkInDate" class="booking-label">Check-In Date</label>  
                <input type="date" id="checkInDate" name="CheckInDate" class="booking-input" required>  
            </div>  

            <div class="booking-info">  
                <label for="checkOutDate" class="booking-label">Check-Out Date</label>  
                <input type="date" id="checkOutDate" name="CheckOutDate" class="booking-input" required>  
            </div>  

            <div class="booking-info">  
                <label for="totalPrice" class="booking-label">Total Price</label>  
                <input type="text" id="totalPrice" name="TotalPrice" class="booking-input" readonly>  
            </div>  

            <button class="booking-button" type="submit">Submit Booking</button>  
        </div>  
    </div>  
</form>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>