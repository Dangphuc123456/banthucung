<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::all();
        return view('admin.order.index', compact('order'));
    }
    public function confirm($order_id)
    {
        $order = Order::find($order_id);

        if ($order) {
            $order->status = 'Đã xác nhận';
            $order->save();

            return redirect()->route('admin.order.index')->with('success', 'Xác nhận đơn hàng thành công.');
        } else {
            return redirect()->route('admin.order.index')->with('error', 'Không tìm thấy đơn hàng.');
        }
    }

    public function delivered($order_id)
    {
        // Find the order by its ID
        $order = Order::findOrFail($order_id);

        // Update the order status
        $order->update([
            'status' => 'Hoàn thành', // Assuming 'Status' is the field indicating the order status
        ]);

        // Optionally, you can save the order after updating
        // $order->save();

        return redirect()->route('admin.order.index')->with('success', 'Đã giao hàng thành công.');
    }
    public function delivery($order_id)
    {
        // Find the order by its ID
        $order = Order::findOrFail($order_id);

        // Update the order status
        $order->update([
            'status' => 'Đang giao hàng', // Assuming 'Status' is the field indicating the order status
        ]);

        // Optionally, you can save the order after updating
        // $order->save();

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã đang được giao.');
    }

    public function cancel($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->status = 'Đã hủy';
        $order->save();

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã bị hủy.');
    }

    public function detail(string $order_id)
    {
        // Tìm đơn hàng dựa trên order_id  
        $order = Order::where('order_id', $order_id)->first();

        if (!$order) {
            // Xử lý khi không tìm thấy đơn hàng  
            return abort(404); // Trả về trang lỗi 404  
        }

        // Lấy các mục trong đơn hàng (Order Items) cùng với thông tin đơn hàng  
        $order_items = OrderItem::where('order_id', $order_id)->with('order')->get();

        // Trả dữ liệu tới view 'admin.order.detail'  
        return view('admin.order.detail', compact('order', 'order_items'));
    }
}
