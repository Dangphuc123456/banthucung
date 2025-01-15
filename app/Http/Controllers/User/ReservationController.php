<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function showForm()
    {
        $lsp = Category::all();
        $rooms = DB::table('Room')->where('Status', 'Available')->get();
        $bookings = DB::table('Booking')
            ->join('Room', 'Booking.RoomID', '=', 'Room.RoomID')  // Join với bảng Room để lấy thông tin phòng
            ->select('Booking.*', 'Room.PricePerNight', 'Room.Status as RoomStatus')
            ->get();
        return view('User.booking', compact('rooms', 'lsp', 'bookings'));
    }
    
    public function store(Request $request)  
    {  
        // Xác thực dữ liệu đầu vào từ yêu cầu  
        $request->validate([  
            'RoomID' => 'required|exists:room,RoomID', 
            'customer_name' => 'required|string|max:100', 
            'PhoneNumber' => 'required|string|max:15',
            'Email' => 'nullable|email|max:100', 
            'CheckInDate' => 'required|date', 
            'CheckOutDate' => 'required|date|after:CheckInDate',  
        ]);  
    
        // Lấy thông tin phòng từ cơ sở dữ liệu  
        $room = Room::find($request->RoomID);  
        if (!$room) {  
            return redirect()->back()->withErrors(['RoomID' => 'Room not found.']); 
        }  
    
        // Tính số đêm giữa ngày nhận phòng và ngày trả phòng  
        $checkInDate = Carbon::parse($request->CheckInDate);  
        $checkOutDate = Carbon::parse($request->CheckOutDate);  
        $numberOfNights = $checkInDate->diffInDays($checkOutDate); // Số đêm là sự chênh lệch giữa ngày trả phòng và ngày nhận phòng  
    
        // Định nghĩa giá mỗi đêm là 200,000  
        $pricePerNight = 200000; 
        $totalPrice = $pricePerNight * $numberOfNights; // Tính tổng số tiền bằng cách nhân giá mỗi đêm với số đêm lưu trú  
    
        // Tạo một bản đặt phòng mới  
        $booking = new Booking();  
        $booking->RoomID = $request->RoomID;  
        $booking->customer_name = $request->customer_name; 
        $booking->PhoneNumber = $request->PhoneNumber; 
        $booking->Email = $request->Email; 
        $booking->CheckInDate = $request->CheckInDate;
        $booking->CheckOutDate = $request->CheckOutDate; 
        $booking->TotalPrice = $totalPrice; 
        $booking->save(); 
    
        // Cập nhật trạng thái phòng thành 'Occupied'  
        $room->Status = 'Occupied'; 
        $room->save(); 
    
      
        return redirect()->route('User.booking')->with('message', 'Booking successful!');
    }
}
