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
        // Validate input data  
        $request->validate([
            'email' => 'required|email', // Email validation  
            'password' => 'required',
        ]);

        // Find customer by email  
        $customer = Customer::where('email', $request->email)->first();

        // Check if customer exists and password matches  
        if ($customer && Hash::check($request->password, $customer->password)) {
            // Log in the customer  
            Auth::guard('customer')->login($customer);

            // Redirect to home page with success message  
            return redirect()->route('User.home')->with('success', 'Đăng nhập thành công!');
        }

        // If login fails, return with error  
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
