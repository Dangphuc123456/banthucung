@extends('Admin.admin')  
@section('title', 'List Pets')  
@section('main')  
<div class="container">  
    <h1>Chi tiết đơn hàng</h1>  

    <!-- Form chọn khoảng thời gian -->  
    <form method="GET" action="{{ route('admin.statistical.detail') }}">  
        <label for="period">Chọn khoảng thời gian:</label>  
        <select name="period" id="period" onchange="this.form.submit()">  
            <option value="monthly" {{ $period === 'monthly' ? 'selected' : '' }}>Theo tháng</option>  
            <option value="quarterly" {{ $period === 'quarterly' ? 'selected' : '' }}>Theo quý</option>  
            <option value="yearly" {{ $period === 'yearly' ? 'selected' : '' }}>Theo năm</option>  
        </select>  
    </form>  
  
    <h2>Thời gian: {{ ucfirst($period) }} (Từ {{ $startDate->toDateString() }} đến {{ $endDate->toDateString() }})</h2>  

    @if($orderDetails->isEmpty())  
        <p>Không có đơn hàng nào trong khoảng thời gian này.</p>  
    @else  
        <table class="table table-striped">  
            <thead>  
                <tr>  
                    <th>ID Thú Cưng</th>  
                    <th>Số lượng</th>  
                    <th>Giá</th>  
                    <th>Trạng thái</th>  
                    <th>Ngày đặt hàng</th>  
                </tr>  
            </thead>  
            <tbody>  
                @foreach($orderDetails as $detail)  
                    <tr>  
                        <td>{{ $detail->pet_id }}</td>  
                        <td>{{ $detail->quantity }}</td>  
                        <td>{{ number_format($detail->price, 2) }} VNĐ</td>  
                        <td>{{ $detail->status }}</td>  
                        <td>{{ \Carbon\Carbon::parse($detail->order_date)->format('d/m/Y H:i') }}</td>  
                    </tr>  
                @endforeach  
            </tbody>  
        </table>  
    @endif  
</div>  
@endsection