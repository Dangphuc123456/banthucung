<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'username' => 'required', // Đổi tên thành 'email' nếu bạn dùng email
            'password' => 'required',
        ]);

        // Tìm người dùng theo email (trường username là email)
        $user = Employee::where('email', $request->username)->first();

        // Kiểm tra xem người dùng có tồn tại không và so sánh mật khẩu
        if ($user && Hash::check($request->password, $user->password_hash)) {
            // Nếu thành công, đăng nhập người dùng và chuyển hướng
            $remember = $request->has('remember'); 

            Auth::guard('admin')->login($user, $remember);
            return redirect()->route('Admin.admin')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu đăng nhập thất bại, trả về lỗi
        return back()->withErrors(['login_error' => 'Tên đăng nhập hoặc mật khẩu không chính xác.']);
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Bạn đã đăng xuất thành công.');
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:employees,username|max:50',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|unique:employees,email',
            'name' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.register')
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo tài khoản mới
        $employee = new Employee();
        $employee->username = $request->username;
        $employee->password_hash = Hash::make($request->password); // Mã hóa mật khẩu
        $employee->email = $request->email;
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->role = 'admin'; // Hoặc có thể lấy từ $request nếu cần
        $employee->save();

        return redirect()->route('admin.login')->with('success', 'Đăng ký thành công! Hãy đăng nhập.');
    }
}
