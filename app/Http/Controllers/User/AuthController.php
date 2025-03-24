<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $lsp = Category::all();
        return view('User.userslogin', compact('lsp'));
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // xác nhận đầu vào 
        $request->validate([
            'email' => 'required|email', // Email validation  
            'password' => 'required',
        ]);

        // Tìm khách hàng qua email
        $customer = Customer::where('email', $request->email)->first();

        // Kiểm tra xem khách hàng có tồn tại và khớp mật khẩu không
        if ($customer && Hash::check($request->password, $customer->password)) {
            // Đăng nhập khách hàng
            Auth::guard('customer')->login($customer);

            // Chuyển hướng đến trang chủ với thông báo thành công  
            return redirect()->route('User.home')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu đăng nhập không thành công, hãy trả về với lỗi
        return back()->withErrors(['login_error' => 'Email hoặc mật khẩu không chính xác.']);
    }

    // Đăng xuất
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('User.home')->with('success', 'Đăng xuất thành công!');
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        $lsp = Category::all();
        return view('User.usersregister', compact('lsp'));
    }
    public function register(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:customers,username|max:50',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|unique:customers,email|max:100',
            'name' => 'required|max:100',
            'phone' => 'required|regex:/^\d{10,15}$/',
            'address' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('User.usersregister')
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo tài khoản mới
        $customer = new Customer();
        $customer->username = $request->username;
        $customer->password = Hash::make($request->password); // Mã hóa mật khẩu
        $customer->email = $request->email;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        return redirect()->route('User.userslogin')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
    }
}
