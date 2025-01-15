<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function showservice($ServiceID)
    {
        $service = Service::findOrFail($ServiceID);
        $lsp = Category::all(); // Lấy danh mục (nếu cần)
        $appointments = Appointments::where('ServiceID', $ServiceID)->get();

        return view('User.appointment', compact('service', 'lsp', 'appointments'));
    }

    public function storeAppointment(Request $request)
    {
        $validatedData = $request->validate([
            'ServiceID' => 'required|exists:services,ServiceID',
            'CustomerName' => 'required|string|max:100',
            'CustomerContact' => 'required|string|max:100',
            'AppointmentDate' => 'required|date',
        ]);
    
        // Lấy dịch vụ từ CSDL
        $service = Service::find($validatedData['ServiceID']);
    
        // Kiểm tra nếu còn slot
        if ($service->AvailableSlots > 0) {
            // Trừ đi 1 slot
            $service->AvailableSlots -= 1;
            $service->save();
    
            // Tạo lịch hẹn
            Appointments::create([
                'ServiceID' => $validatedData['ServiceID'],
                'CustomerName' => $validatedData['CustomerName'],
                'CustomerContact' => $validatedData['CustomerContact'],
                'AppointmentDate' => $validatedData['AppointmentDate'],
                'Status' => 'Pending',
            ]);
    
            return redirect()->back()->with('success', 'Lịch hẹn của bạn đã được đặt thành công!');
        } else {
            // Nếu không còn slot
            return redirect()->back()->with('error', 'Dịch vụ này hiện không còn slot khả dụng!');
        }
    }    
}
