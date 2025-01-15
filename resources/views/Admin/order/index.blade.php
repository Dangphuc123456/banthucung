@extends('Admin.admin')
@section('title', 'List Pets')
@section('main')
<div class="table-container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="table-title">List of order</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order_id</th>
                <th>customer_name</th>
                <th>Order_date</th>
                <th>Total_amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                <td>{{ $order->status }}</td>
                <td>
                    @if($order->status != 'Đã hủy' && $order->status != 'Hoàn thành')
                    <form action="{{ route('admin.order.confirm', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" {{ $order->status == 'Đã xác nhận' ? 'disabled' : '' }}>Xác nhận</button>
                    </form>
                    <form action="{{ route('admin.order.delivery', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning" {{ $order->status == 'Đang giao hàng' || $order->status == 'Hoàn thành' ? 'disabled' : '' }}>Đang giao hàng</button>
                    </form>
                    <form action="{{ route('admin.order.delivered', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" {{ $order->status == 'Hoàn thành' ? 'disabled' : '' }}>Hoàn thành</button>
                    </form>
                    <form action="{{ route('admin.order.cancel', ['order_id' => $order->order_id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">Hủy</button>
                    </form>
                    @else
                    @if($order->status == 'Đã hủy')
                    <span class="badge bg-danger">Đã hủy</span>
                    @elseif($order->status == 'Hoàn thành')
                    <span class="badge bg-success">Hoàn thành</span>
                    @endif
                    @endif
                    <a href="{{ route('admin.order.detail', ['order_id' => $order->order_id]) }}">
                        <button style="border:0;border-radius: 5px;;background-color:cornflowerblue;height:40px">Chi Tiết Đơn Hàng</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection