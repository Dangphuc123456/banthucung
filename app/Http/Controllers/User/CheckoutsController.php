<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CheckoutsController extends Controller
{
    // Hiển thị trang checkout với thông tin giỏ hàng
    public function checkouts(Request $request)
    {
        // Lấy giỏ hàng từ session
        $cart = $request->session()->get('Cart', []);

        // Lấy thông tin danh mục sản phẩm nếu cần
        $lsp = Category::all();

        // Tính tổng giá trị giỏ hàng
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Trả về view checkout với dữ liệu giỏ hàng
        return view('User.checkouts', compact('cart', 'totalPrice', 'lsp'));
    }
    public function storeCheckouts(Request $request)
    {
        // Kiểm tra xem khách hàng đã đăng nhập chưa
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('User.userslogin')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }
        // Lấy thông tin khách hàng đã đăng nhập
        $user = Auth::guard('customer')->user();
        $customerId = $user->id;
        // Lưu thông tin đơn hàng
        $order = new Order();
        $order->customer_id = $customerId;
        $order->customer_name = $request->customer_name;
        $order->email = $request->email;
        $order->country = $request->country;
        $order->postal_code = $request->postal_code;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->payment = $request->payment;
        $order->total_amount = $request->total_amount;
        $order->status = 'pending'; // Trạng thái mặc định là pending
        $order->save();

        // Lưu chi tiết đơn hàng
        foreach ($request->order_items as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->order_id;
            $orderItem->pet_id = $item['pet_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->description = $item['description'];
            $orderItem->image_url = $item['image_url'];
            $orderItem->save();

            // Trừ số lượng thú cưng trong kho
            $product = Pets::find($item['pet_id']);
            if ($product && $product->quantity_in_stock >= $item['quantity']) {
                $product->quantity_in_stock -= $item['quantity'];
                $product->save();
            }
        }
        // Lưu thông tin thanh toán nếu là thẻ tín dụng
        if ($request->payment === 'credit') {
            $payment = new Payment();
            $payment->order_id = $order->order_id;
            $payment->payment_method = $request->payment;
            $payment->card_holder = encrypt($request->card_holder);
            $payment->card_number = encrypt($request->card_number);
            $expiryDate = $request->expiry_date;
            if (strlen($expiryDate) === 7) { // Kiểm tra nếu định dạng là YYYY-MM
                $expiryDate .= '-01'; // Thêm ngày mặc định
            }
            $payment->expiry_date = $expiryDate; 
            $payment->cvv = encrypt($request->cvv);
            $payment->status = 'pending'; // Giả định thanh toán thành công
            $payment->save();
        }
        // Xóa giỏ hàng trong session
        $request->session()->forget(['Cart', 'Cart_TotalQuantity', 'Cart_TotalPrice']);

        // Chuyển hướng về trang chủ với thông báo thành công
        return redirect()->route('User.information', $order->order_id)->with('success', 'Đặt hàng thành công vui lòng kiểm tra đơn hàng!');
    }
    public function show($orderId)
    {
        // Lấy thông tin danh mục sản phẩm nếu cần
        $lsp = Category::all();
        $order = Order::with('orderItems')->findOrFail($orderId);

        return view('User.information', compact('order', 'lsp'));
    }
}
