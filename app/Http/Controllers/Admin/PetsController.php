<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pets;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    public function index()
    {
        $pets = Pets::all();
        $pets = Pets::paginate(12);
        return view('admin.pets.index', compact('pets'));
    }
    public function create()
    {
        return view('admin.pets.create');
    }
    public function store(Request $request)
    {
        $data = [
            'pet_id' => $request->input('pet_id'),
            'name' => $request->input('name'),
            'species' => $request->input('species'),
            'breed' => $request->input('breed'),
            'age' => $request->input('age'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image_url' => $request->input('image_url'),
            'status' => $request->input('status') ? 1 : 0,
            'category_id' => $request->input('category_id'),
            'gender' => $request->input('gender'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data into the database
        Pets::create($data);

        // Redirect to index with a success message
        return redirect()->route('admin.pets.index')->with('success', 'Thêm thành công thú cưng!');
    }

    public function edit(String $pet_id)
    {
        $pets = Pets::where('pet_id', $pet_id)->first();

        if (!$pets) {
            return abort(404); // Trả về trang lỗi 404 nếu không tìm thấy sản phẩm
        }
        return view('admin.pets.edit', compact('pets'));
    }
    public function update(Request $request, string $pet_id)
    {
        $pets = Pets::find($pet_id);
        if (!$pets) {
            // Xử lý khi không tìm thấy thú cưng
            return abort(404); // Trả về trang lỗi 404
        }
    
        $request->validate([
            // Định nghĩa các quy tắc kiểm tra dữ liệu nếu cần
            // Ví dụ: 'name' => 'required|max:255',
        ]);
    
        // Cập nhật các thuộc tính của thú cưng từ dữ liệu gửi từ form
        $pets->name = $request->name;
        $pets->species = $request->species;
        $pets->breed = $request->breed;
        $pets->age = $request->age;
        $pets->price = $request->price;
        $pets->description = $request->description;
        $pets->image_url = $request->image_url;
        $pets->status = $request->status;
        $pets->category_id = $request->category_id;
        $pets->gender = $request->gender;
        $pets->updated_at = date("Y-m-d H:i:s"); // Cập nhật thời gian sửa đổi
    
        // Lưu các thay đổi vào cơ sở dữ liệu
        $pets->save();
    
        // Chuyển hướng về trang danh sách thú cưng với thông báo thành công
        return redirect()->route('admin.pets.index', ['pet_id' => $pet_id])->with('success', 'Thú cưng đã được cập nhật thành công.');
    }
    
    public function show(string $pet_id)
    {
        $pets = Pets::where('pet_id', $pet_id)->first();

        if (!$pets) {
            // Handle the case where no pet is found with the given pet_id
            return abort(404); // Return a 404 error page
        }

        // Extract individual attributes
        $pet_id = $pets->pet_id;
        $name = $pets->name;
        $species = $pets->species;
        $breed = $pets->breed;
        $age = $pets->age;
        $price = $pets->price;
        $description = $pets->description;
        $image_url = $pets->image_url;
        $status = $pets->status;
        $category_id = $pets->category_id;
        $created_at = $pets->created_at;
        $updated_at = $pets->updated_at;
        $gender = $pets->gender;

        // Pass data to the view
        return view('admin.pets.detail', compact('pets', 'pet_id', 'name', 'species', 'breed', 'age', 'price', 'description', 'image_url', 'status', 'category_id', 'created_at', 'updated_at', 'gender'));
    }
}
