<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::all();
        return view('admin.servicee.index', compact('service'));
    }
    public function create()
    {
        return view('admin.servicee.create');
    }
    public function store(Request $request)
    {

        // Prepare data to insert
        $data = [
            'service_name' => $request->input('service_name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image_sv' => $request->input('image_sv'),
            'service_type' => $request->input('service_type'),
            'status' => $request->input('status', 'Active'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert data into the database
        Service::create($data);

        // Redirect to index with a success message
        return redirect()->route('admin.servicee.index')->with('success', 'Thêm thành công servicee!');
    }

    public function edit(int $service_id)
    {
        $service = Service::find($service_id);

        if (!$service) {
            return abort(404); // Trả về trang lỗi 404 nếu không tìm thấy dịch vụ
        }

        return view('admin.servicee.edit', compact('service'));
    }
    

    public function show(int $service_id)
    {
        $service = Service::find($service_id);

        if (!$service) {
            return abort(404); // Trả về lỗi nếu không tìm thấy dịch vụ
        }

        return view('admin.servicee.detail', compact('service'));
    }
}
