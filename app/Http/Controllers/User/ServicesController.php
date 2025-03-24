<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function showservice()
    {
        $service = Service::all();
        $lsp = Category::all(); // Lấy danh mục (nếu cần)
        $appointments = Appointments::all();

        return view('User.appointment', compact('service', 'lsp', 'appointments'));
    }

    public function storeAppointment(Request $request)
    {
        $validatedData = $request->validate([
            'ServiceID' => 'required|exists:services,ServiceID',
            'CustomerName' => 'required|string|max:100',
            'CustomerContact' => 'required|string|max:100',
            'AppointmentDate' => 'required|date',
            'LocationName' => 'required|string|max:255', // Lấy trực tiếp từ form
        ]);

        try {
            // Lấy dịch vụ từ CSDL
            $service = Service::find($validatedData['ServiceID']);

            // Kiểm tra nếu dịch vụ không tồn tại
            if (!$service) {
                return redirect()->back()->with('error', 'Dịch vụ không tồn tại!');
            }

            // Tạo lịch hẹn
            $appointment = Appointments::create([
                'ServiceID' => $validatedData['ServiceID'],
                'ServiceName' => $service->ServiceName,
                'CustomerName' => $validatedData['CustomerName'],
                'CustomerContact' => $validatedData['CustomerContact'],
                'AppointmentDate' => $validatedData['AppointmentDate'],
                'LocationName' => $validatedData['LocationName'],
                'Status' => 'Pending',
            ]);

            // Kiểm tra nếu tạo thất bại
            if (!$appointment) {
                return redirect()->back()->with('error', 'Đặt lịch không thành công, vui lòng thử lại!');
            }

            return redirect()->back()->with('success', 'Lịch hẹn của bạn đã được đặt thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }
}
