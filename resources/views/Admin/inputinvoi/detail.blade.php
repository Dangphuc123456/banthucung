@extends('Admin.admin')
@section('title', 'Purchase Order Details')
@section('main')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h2 class="text-center mb-0">Purchase Order Details</h2>
        </div>
        <div class="card-body">
            <h4>Order Information</h4>
            <p><strong>Order Date:</strong> {{ $purchaseOrder->order_date }}</p>
            <p><strong>Total Amount:</strong> {{ $purchaseOrder->total_amount }}</p>
            <p><strong>Supplier:</strong> {{ $purchaseOrder->supplier->name }}</p> {{-- Assuming you have a supplier relation set up --}}

            <h4 class="mt-4">Purchase Order Items</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pet ID</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseOrderItems as $item)
                    <tr>
                        <td>{{ $item->pet_id }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity * $item->price }}</td> {{-- Tính tổng giá trị của từng item --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('admin.inputinvoi.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>
</div>
@endsection
