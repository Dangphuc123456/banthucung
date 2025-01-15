<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalesStatisticsExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StatisticsController extends Controller
{
    protected $monthlyStatistics;
    protected $quarterlyStatistics;
    protected $yearlyStatistics;
    protected $monthlyOrderCount;
    protected $quarterlyOrderCount;
    protected $yearlyOrderCount;
    public function selling()
    {
        // Lấy ngày hiện tại
        $today = Carbon::today();
        // Lấy ngày đầu tuần và cuối tuần hiện tại
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        // Lấy ngày đầu tháng và cuối tháng hiện tại
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        // Lấy ngày đầu quý và cuối quý hiện tại
        $currentMonth = Carbon::now()->month;
        $startOfQuarter = Carbon::createFromDate(null, $currentMonth <= 3 ? 1 : ($currentMonth <= 6 ? 4 : ($currentMonth <= 9 ? 7 : 10)), 1)->startOfMonth();
        $endOfQuarter = $startOfQuarter->copy()->addMonths(3)->subDay()->endOfMonth();
        // Lấy ngày đầu năm và cuối năm hiện tại
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        // Lấy thống kê hàng tháng
        $monthlyStatistics = $this->getStatistics($startOfMonth->startOfDay(), $endOfMonth->endOfDay());
        $quarterlyStatistics = $this->getStatistics($startOfQuarter->startOfDay(), $endOfQuarter->endOfDay());
        $yearlyStatistics = $this->getStatistics($startOfYear->startOfDay(), $endOfYear->endOfDay());
        // Lấy số lượng đơn hàng theo tháng, quý và năm
        $monthlyOrderCount = $this->getOrderCount($startOfMonth, $endOfMonth);
        $quarterlyOrderCount = $this->getOrderCount($startOfQuarter, $endOfQuarter);
        $yearlyOrderCount = $this->getOrderCount($startOfYear, $endOfYear);
        // Trả về view với các dữ liệu thống kê
        return view('admin.statistical.selling', compact(
            'monthlyStatistics',
            'quarterlyStatistics',
            'yearlyStatistics',
            'monthlyOrderCount',
            'quarterlyOrderCount',
            'yearlyOrderCount'
        ));
    }
    // Tính toán số liệu thống kê cho các giai đoạn khác nhau
    private function getStatistics($startDate, $endDate)
    {
        return DB::table('Order_Items')
            ->join('Orders', 'Order_Items.order_id', '=', 'Orders.order_id')
            ->whereBetween('Orders.order_date', [$startDate, $endDate])
            ->select(
                DB::raw('SUM(Order_Items.quantity) as total_products'),
                DB::raw('SUM(Order_Items.price * Order_Items.quantity) as total_revenue')
            )
            ->first();
    }

    private function getOrderCount($startDate, $endDate)
    {
        return DB::table('Orders')
            ->whereBetween('order_date', [$startDate, $endDate])
            ->select(DB::raw('COUNT(order_id) as total_orders'))
            ->first();
    }
    public function exportStatistics(Request $request)
    {
        // Lấy giá trị 'period' từ request (mặc định là 'monthly' nếu không có)
        $period = $request->get('period', 'monthly'); // 'monthly', 'quarterly', 'yearly'
        $startDate = null;
        $endDate = null;

        // Định nghĩa khoảng thời gian dựa trên 'period' được chọn
        if ($period === 'monthly') {
            // Thống kê theo tháng
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($period === 'quarterly') {
            // Thống kê theo quý
            $currentMonth = Carbon::now()->month;
            $startDate = Carbon::createFromDate(null, $currentMonth <= 3 ? 1 : ($currentMonth <= 6 ? 4 : ($currentMonth <= 9 ? 7 : 10)), 1)->startOfMonth();
            $endDate = $startDate->copy()->addMonths(3)->subDay()->endOfMonth();
        } elseif ($period === 'yearly') {
            // Thống kê theo năm
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        }

        // Lấy chi tiết đơn hàng theo khoảng thời gian đã chọn
        $orderDetails = DB::table('Orders')  // Đổi từ 'order' thành 'Orders'
            ->join('Order_Items', 'Orders.order_id', '=', 'Order_Items.order_id')  // Đổi từ 'orderdetail' thành 'Order_Items'
            ->whereBetween('Orders.order_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->whereIn('Orders.status', ['Đã xác nhận', 'Đang chờ xử lý', 'Đã giao hàng thành công'])
            ->get(['Order_Items.pet_id', 'Order_Items.quantity', 'Order_Items.price', 'Orders.status']);
        // Tính tổng số sản phẩm và tổng doanh thu
        $statistics = DB::table('Orders')  // Đổi 'order' thành 'Orders'
            ->join('Order_Items', 'Orders.order_id', '=', 'Order_Items.order_id')  // Đổi 'orderdetail' thành 'Order_Items'
            ->select(DB::raw('SUM(Order_Items.quantity) as total_products'), DB::raw('SUM(Order_Items.quantity * Order_Items.price) as total_revenue'))
            ->whereBetween('Orders.order_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->whereIn('Orders.status', ['Đã xác nhận', 'Đang chờ xử lý', 'Đã giao hàng thành công'])
            ->first();


        // Xuất dữ liệu dưới dạng file Excel
        return Excel::download(new SalesStatisticsExport($statistics, $orderDetails, $period), 'sales_statistics_' . $period . '.xlsx');
    }
    public function detail(Request $request)
    {
        // Lấy giá trị 'period' từ request (mặc định là 'monthly' nếu không có)  
        $period = $request->get('period', 'monthly'); // 'monthly', 'quarterly', 'yearly'  
        $startDate = null;
        $endDate = null;

        // Định nghĩa khoảng thời gian dựa trên 'period' được chọn  
        if ($period === 'monthly') {
            // Thống kê theo tháng  
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($period === 'quarterly') {
            // Thống kê theo quý  
            $currentMonth = Carbon::now()->month;
            $startDate = Carbon::createFromDate(null, $currentMonth <= 3 ? 1 : ($currentMonth <= 6 ? 4 : ($currentMonth <= 9 ? 7 : 10)), 1)->startOfMonth();
            $endDate = $startDate->copy()->addMonths(3)->subDay()->endOfMonth();
        } elseif ($period === 'yearly') {
            // Thống kê theo năm  
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        }

        // Lấy chi tiết đơn hàng theo khoảng thời gian đã chọn  
        $orderDetails = DB::table('Orders')
            ->join('Order_Items', 'Orders.order_id', '=', 'Order_Items.order_id')
            ->whereBetween('Orders.order_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->whereIn('Orders.status', ['Đã xác nhận', 'Đang chờ xử lý', 'Đã giao hàng thành công'])
            ->get(['Order_Items.pet_id', 'Order_Items.quantity', 'Order_Items.price', 'Orders.status', 'Orders.order_date']);

        // Trả về view với các dữ liệu chi tiết đơn hàng  
        return view('admin.statistical.detail', compact('orderDetails', 'period', 'startDate', 'endDate'));
    }
}
