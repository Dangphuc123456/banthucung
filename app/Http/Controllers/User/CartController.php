<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $pet_id)
    {
        // Lấy thông tin thú cưng từ cơ sở dữ liệu
        $pet = Pets::findOrFail($pet_id);

        // Lấy giỏ hàng từ session
        $cart = $request->session()->get('Cart', []);

        // Kiểm tra xem thú cưng đã có trong giỏ hàng chưa
        if (isset($cart[$pet_id])) {
            $cart[$pet_id]['quantity'] += $request->input('quantity', 1);
        } else {
            // Nếu chưa có, thêm thú cưng vào giỏ
            $cart[$pet_id] = [
                'name' => $pet->name ?? 'Không có mô tả',
                'description' => $pet->description ?? 'Không có mô tả',
                'price' => $pet->price,
                'quantity' => $request->input('quantity', 1),
                'image_url' => $pet->image_url,
            ];
        }

        // Cập nhật lại giỏ hàng trong session
        $request->session()->put('Cart', $cart);
        // Tính tổng số lượng và tổng giá trị
        $totalQuantity = array_sum(array_column($cart, 'quantity'));
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Gửi dữ liệu tổng số lượng và tổng giá trị sang session (tuỳ chọn)
        $request->session()->put('Cart_TotalQuantity', $totalQuantity);
        $request->session()->put('Cart_TotalPrice', $totalPrice);

        return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
    }

    public function cart(Request $request)
    {
        // Lấy giỏ hàng từ session
        $lsp = Category::all();
        $cart = $request->session()->get('Cart', []);
        $total = 0;

        foreach ($cart as $pet_id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('User.cart', compact('cart', 'lsp', 'total'));
    }
    public function removeFromCart(Request $request, $pet_id)
    {
        $cart = $request->session()->get('Cart', []);

        if (isset($cart[$pet_id])) {
            unset($cart[$pet_id]);
        }
        // Cập nhật lại tổng số lượng và giá
        $totalQuantity = array_sum(array_column($cart, 'quantity'));
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Lưu lại giỏ hàng và các thông tin liên quan trong session
        $request->session()->put('Cart', $cart);
        $request->session()->put('Cart_TotalQuantity', $totalQuantity);
        $request->session()->put('Cart_TotalPrice', $totalPrice);
        return redirect()->route('User.cart')->with('success', 'Xóa thú cưng khỏi giỏ hàng thành công!');
    }
}
