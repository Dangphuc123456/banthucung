<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-pet</title>
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
  
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>
<!-- Kiểm tra nếu có đơn hàng -->  
@if($orders->count() > 0)  
        @foreach($orders as $order)  
            <div class="order-item mb-4 p-3 border rounded">  
                <div class="row">  
                    <!-- Hiển thị thông tin mỗi sản phẩm -->  
                    @foreach($order->items as $item)  
                        <div class="col-md-4">  
                            <div class="product-card">  
                                <img src="{{ asset('anh/' . $item->image_url) }}" alt="Product Image" class="order-item-img" style="width:300px;height:300px">  
                                <div class="product-details">  
                                    <h5>{{ $item->description }}</h5>  
                                    <p>Số lượng: {{ $item->quantity }}</p>  
                                    <p>Giá: {{ number_format($item->price, 0, ',', '.') }}đ</p>  
                                    <p>Tổng: {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</p>  
                                </div>  
                            </div>  
                        </div>  
                    @endforeach  
                </div>  

                <!-- Thông tin đơn hàng -->  
                <div class="row mt-3">  
                    <div class="col-6">  
                        <p><strong>Trạng thái: </strong>  
                            @if($order->status == 'completed')  
                                <span class="badge bg-success">Đã hoàn thành</span>  
                            @elseif($order->status == 'pending')  
                                <span class="badge bg-warning">Đang chờ</span>  
                            @elseif($order->status == 'canceled')  
                                <span class="badge bg-danger">Đã hủy</span>  
                            @endif  
                        </p>  
                    </div>  
                    <div class="col-6 text-right">  
                        <p><strong>Thành tiền: </strong>{{ number_format($order->total_amount, 0, ',', '.') }} VND</p>  
                    </div>  
                </div>  

                <!-- Các nút hành động -->  
                <div class="row mt-3">  
                    <div class="col-6">  
                        <a href="#" class="btn btn-primary btn-sm">Mua Lại</a>  
                    </div>  
                    <div class="col-6 text-right">  
                        <a href="#" class="btn btn-secondary btn-sm">Liên Hệ Người Bán</a>  
                    </div>  
                </div>  
            </div>  
        @endforeach  
    @else  
        <p>Bạn chưa có đơn hàng nào.</p>  
    @endif  
</div>
<div class="container">  
    <h2>Lịch sử đơn hàng</h2>  

    <!-- Hiển thị thông báo nếu người dùng chưa đăng nhập -->  
    @if(session('error'))  
        <div class="alert alert-danger">  
            {{ session('error') }}  
        </div>  
    @endif  

    <div class="">

    </div>