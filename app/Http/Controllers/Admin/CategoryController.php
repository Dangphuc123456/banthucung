<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('category_id', 'asc')->get();
        return view('admin.category.index', compact('category'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $data = [
            'category_id' => $request->input('category_id'),
            'category_name' => $request->input('category_name'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data into the database
        Category::create($data);

        // Redirect to index with a success message
        return redirect()->route('admin.category.index')->with('success', 'Thêm thành công thú cưng!');
    }

    public function edit(String $category_id)
    {
        $category = Category::where('category_id', $category_id)->first();

        if (!$category) {
            return abort(404); // Trả về trang lỗi 404 nếu không tìm thấy sản phẩm
        }
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, string $category_id)
    {
        $category = Category::find($category_id);
        if (!$category) {
            // Xử lý khi không tìm thấy thú cưng
            return abort(404); // Trả về trang lỗi 404
        }
    
        $request->validate([
            // Định nghĩa các quy tắc kiểm tra dữ liệu nếu cần
            // Ví dụ: 'name' => 'required|max:255',
        ]);
    
        // Cập nhật các thuộc tính của thú cưng từ dữ liệu gửi từ form
        $category->name = $request->name;
        $category->species = $request->species;
        $category->updated_at = date("Y-m-d H:i:s"); // Cập nhật thời gian sửa đổi
    
        // Lưu các thay đổi vào cơ sở dữ liệu
        $category->save();
    
        // Chuyển hướng về trang danh sách thú cưng với thông báo thành công
        return redirect()->route('admin.category.index', ['category_id' => $category_id])->with('success', 'Categoris đã được cập nhật thành công.');
    }
    
    public function show(string $category_id)
    {
        $category = Category::where('category_id', $category_id)->first();

        if (!$category) {
            // Handle the case where no pet is found with the given pet_id
            return abort(404); // Return a 404 error page
        }

        // Extract individual attributes
        $category_id = $category->category_id;
        $category_name = $category->category_name;
        $created_at = $category->created_at;
        $updated_at = $category->updated_at;
        // Pass data to the view
        return view('admin.category.detail', compact('category', 'category_id', 'category_name',  'created_at', 'updated_at',));
    }
}
