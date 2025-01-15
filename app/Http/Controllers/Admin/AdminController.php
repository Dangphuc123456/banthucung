<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function index(){
    //     return view('Admin.admin');
    // }
    public function index()
    {
        return view('Admin.index');
    }
    public function showdashboard(){
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
}
