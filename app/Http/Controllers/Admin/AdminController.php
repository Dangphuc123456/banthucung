<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pets;
use App\Models\PurchaseOrder;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // public function index(){
    //     return view('Admin.admin');
    // }
    public function index()
    {
        return view('Admin.index');
    }
    public function showdashboard()
    {
        return view('dashboard');
    }
    public function fetchNewOrders()
    {
        // Fetch the latest pending orders
        $newOrders = Order::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5) // Limit the number of orders displayed
            ->get();

        return response()->json($newOrders);
    }
    public function search(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->withErrors('Bạn cần đăng nhập để truy cập.');
        }
        $query = $request->input('query');

        $pets = Pets::where('description', 'LIKE', "%{$query}%")
            ->orWhere('species', 'LIKE', "%{$query}%")
            ->orWhere('breed', 'LIKE', "%{$query}%")
            ->get();

        $orders = Order::where('order_id', 'LIKE', "%{$query}%")
            ->orWhere('status', 'LIKE', "%{$query}%")
            ->orWhere('total_amount', 'LIKE', "%{$query}%")
            ->get();

        $purchaseOrders = PurchaseOrder::where('purchase_order_id', 'LIKE', "%{$query}%")
            ->orWhere('total_amount', 'LIKE', "%{$query}%")
            ->get();

        $room = Room::where('status', 'like', "%{$query}%")->get();

        return view('admin.search.index', compact('pets', 'orders', 'purchaseOrders', 'query','room'));
    }
}
