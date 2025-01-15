@extends('Admin.admin')
@section('title', 'List Purchase Order')
@section('main')
<div class="table-container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="table-title">List of Purchase Order</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Purchase_order_id</th>
                <th>Supplier_id</th>
                <th>order_date</th>
                <th>total_amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Purchase_Orders as $PurchaseOrders)
            <tr>
                <td>{{ $PurchaseOrders->purchase_order_id }}</td>
                <td>{{ $PurchaseOrders->supplier_id }}</td>
                <td>{{ $PurchaseOrders->order_date }}</td>
                <td>{{ number_format($PurchaseOrders->total_amount, 0, ',', '.') }}đ</td>
                <td>
                    <!--  -->
                    <a href="{{ route('admin.inputinvoi.detail', $PurchaseOrders->purchase_order_id) }}" class="btn-edit"><button class="btn-delete" style="background-color:green">Show</button></a>
                    <form action="{{ route('inputinvoi.destroy', $PurchaseOrders->purchase_order_id) }}" method="POST" class="form-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" style="background-color:red;margin-top:10px">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection