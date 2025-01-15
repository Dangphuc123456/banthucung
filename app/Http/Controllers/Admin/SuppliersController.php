<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Suppliers::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }
    public function create()
    {
        return view('admin.suppliers.create');
    }
    public function store(Request $request)
    {
        $data = [
            'supplier_id' => $request->input('supplier_id'),
            'name' => $request->input('name'),
            'contact_person' => $request->input('contact_person'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data into the database
        Suppliers::create($data);

        // Redirect to index with a success message
        return redirect()->route('admin.suppliers.index')->with('success', 'Thêm thành công thú cưng!');
    }

    public function edit(String $supplier_id)
    {
        $suppliers = Suppliers::where('supplier_id', $supplier_id)->first();

        if (!$suppliers) {
            return abort(404); // Trả về trang lỗi 404 nếu không tìm thấy sản phẩm
        }
        return view('admin.suppliers.edit', compact('suppliers'));
    }
    public function update(Request $request, string $supplier_id)
    {
        $suppliers = Suppliers::find($supplier_id);
        if (!$suppliers) {
            // Xử lý khi không tìm thấy thú cưng
            return abort(404); // Trả về trang lỗi 404
        }
    
        $request->validate([
            // Định nghĩa các quy tắc kiểm tra dữ liệu nếu cần
            // Ví dụ: 'name' => 'required|max:255',
        ]);
    
        // Cập nhật các thuộc tính của thú cưng từ dữ liệu gửi từ form
        $suppliers->name = $request->name;
        $suppliers->contact_person = $request->contact_person;
        $suppliers->address = $request->address;
        $suppliers->phone = $request->phone;
        $suppliers->email = $request->email;
        $suppliers->updated_at = date("Y-m-d H:i:s"); // Cập nhật thời gian sửa đổi
    
        // Lưu các thay đổi vào cơ sở dữ liệu
        $suppliers->save();
    
        // Chuyển hướng về trang danh sách thú cưng với thông báo thành công
        return redirect()->route('admin.suppliers.index', ['supplier_id' => $supplier_id])->with('success', 'Thú cưng đã được cập nhật thành công.');
    }    
    public function show(string $supplier_id)
    {
        $suppliers = Suppliers::where('supplier_id', $supplier_id)->first();

        if (!$suppliers) {
            // Handle the case where no pet is found with the given pet_id
            return abort(404); // Return a 404 error page
        }

        // Extract individual attributes
        $supplier_id = $suppliers->supplier_id;
        $name = $suppliers->name;
        $contact_person = $suppliers->contact_person;
        $address = $suppliers->address;
        $phone = $suppliers->phone;
        $email = $suppliers->email;
        $created_at = $suppliers->created_at;
        $updated_at = $suppliers->updated_at;
        
        // Pass data to the view
        return view('admin.suppliers.detail', compact('suppliers', 'supplier_id', 'name', 'contact_person', 'address', 'phone'));
    }
}
