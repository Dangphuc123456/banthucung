<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function historical()
    {
        $lsp = Category::all();

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.userslogin')->with('error', 'Vui lòng đăng nhập để xem lịch sử đơn hàng.');
        }

        // Lấy thông tin khách hàng hiện tại từ Auth
        $customer = Auth::guard('customer')->user();

        // Lấy danh sách đơn hàng của khách hàng dựa trên tên
        $orders = Order::where('customer_name', $customer->name)
            ->where('customer_id', $customer->id) // Bổ sung điều kiện này
            ->orderBy('order_date', 'desc')
            ->get();

        // Gắn thêm thông tin chi tiết (order_items) cho từng đơn hàng
        foreach ($orders as $order) {
            $order->items = OrderItem::where('order_id', $order->order_id)->get();
        }

        return view('User.orders.historical', compact('orders', 'lsp'));
    }

    public function bookings()
    {
        $lsp = Category::all();
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.userslogin')->with('error', 'Vui lòng đăng nhập để xem lịch sử đơn hàng.');
        }
        // Lấy thông tin khách hàng hiện tại từ Auth
        $customer = Auth::guard('customer')->user();
        $booking = Booking::where('customer_name', $customer->name)
            ->get();
        $appointments = Appointments::where('CustomerName', $customer->name)
            ->orderBy('AppointmentDate', 'desc')
            ->get();
        return view('User.orders.bookings', compact('booking','appointments', 'lsp'));
    }

    public function guarantee()
    {
        $lsp = Category::all();
        return view('User.orders.guarantee', compact('lsp'));
    }
}
