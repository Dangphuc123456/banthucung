@extends('Admin.admin')
@section('title', 'List Pets')
@section('main') 
<div class="container">  
    <h1>Room Details</h1>  
    <p><strong>Room ID:</strong> {{ $room->RoomID }}</p>  
    <p><strong>Price Per Night:</strong> {{ number_format($room->PricePerNight, 0, ',', '.') }}đ</p>  
    <p><strong>Status:</strong> {{ $room->Status }}</p>  

    <h2>Bookings</h2>  
    <table class="table">  
        <thead>  
            <tr>  
                <th>Booking ID</th>  
                <th>Customer Name</th>  
                <th>Check-In Date</th>  
                <th>Check-Out Date</th>  
                <th>TotalPrice</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach ($bookings as $booking)  
                <tr>  
                    <td>Lần{{ $booking->BookingID }}</td>  
                    <td>{{ $booking->customer_name }}</td>  
                    <td>{{ $booking->CheckInDate }}</td>  
                    <td>{{ $booking->CheckOutDate }}</td>  
                    <td>{{ number_format($booking->TotalPrice, 0, ',', '.') }}đ</td>  
                </tr>  
            @endforeach  
        </tbody>  
    </table>  

    <a href="{{ route('admin.room.index') }}" class="btn btn-secondary">Back to Rooms</a>  
</div>  
@endsection