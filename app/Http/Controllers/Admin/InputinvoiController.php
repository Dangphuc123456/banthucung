<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pets;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputinvoiController extends Controller
{
    public function index()
    {
        $Purchase_Orders = PurchaseOrder::all();
        return view('admin.inputinvoi.index', compact('Purchase_Orders'));
    }
    public function create()
    {
        $suppliers = Suppliers::all();  // Lấy tất cả các nhà cung cấp
        $pets = Pets::all();  // Lấy tất cả các pet
        return view('admin.inputinvoi.create', compact('suppliers', 'pets'));
    }
    public function store(Request $request)
    {
        // Bắt đầu giao dịch
        DB::beginTransaction();

        try {
            // Bước 1: Thêm đơn hàng vào bảng Purchase_Orders
            $purchaseOrderData = [
                'supplier_id' => $request->input('supplier_id'),
                'order_date' => $request->input('order_date'),
                'total_amount' => 0, // Số tiền tạm thời là 0, sẽ tính lại sau khi thêm chi tiết đơn hàng
            ];
            $purchaseOrder = PurchaseOrder::create($purchaseOrderData);

            // Bước 2: Thêm chi tiết đơn hàng vào bảng Purchase_Order_Items
            $purchaseOrderItemData = [
                'purchase_order_id' => $purchaseOrder->purchase_order_id,
                'pet_id' => $request->input('pet_id'),
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price'),
            ];
            $purchaseOrderItem = PurchaseOrderItem::create($purchaseOrderItemData);

            // Bước 3: Tính tổng giá trị đơn hàng
            $totalAmount = 0;
            $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $purchaseOrder->purchase_order_id)->get();
            foreach ($purchaseOrderItems as $item) {
                $totalAmount += $item->quantity * $item->price;
            }

            // Bước 4: Cập nhật lại tổng tiền vào bảng Purchase_Orders
            $purchaseOrder->total_amount = $totalAmount;
            $purchaseOrder->save();

            // Bước 5: Commit giao dịch
            DB::commit();

            // Redirect về trang danh sách đơn hàng với thông báo thành công
            return redirect()->route('admin.inputinvoi.index')->with('success', 'Thêm đơn hàng mua thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi, rollback giao dịch
            DB::rollback();

            // Trả về thông báo lỗi
            return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại!');
        }
    }
    public function show($purchase_order_id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($purchase_order_id);

        // Lấy tất cả chi tiết đơn hàng dựa trên purchase_order_id
        $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $purchase_order_id)->get();

        // Trả về view với dữ liệu cần thiết
        return view('admin.inputinvoi.detail', compact('purchaseOrder', 'purchaseOrderItems'));
    }
}
