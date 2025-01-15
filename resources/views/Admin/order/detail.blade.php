@extends('Admin.admin')
@section('title', 'Order Detail')
@section('main')

<h2>Order Detail for Order #{{ $order->order_id }}</h2>
<!-- Chi tiết các sản phẩm trong đơn hàng -->
<h3 class="order-items-title">Order Items</h3>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order_items as $item)
        <tr>
            <td><img src="{{ asset('anh/' . $item->image_url) }}" alt="Product Image" class="order-item-img" style="width:200px;height:200px"></td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Back to order</a>
<form action="{{ route('admin.order.confirm', ['order_id' => $order->order_id]) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success" {{ $order->status == 'Đã xác nhận' ? 'disabled' : '' }}>Xác nhận</button>
</form>
@endsection