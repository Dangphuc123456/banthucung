<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-pet</title>
    <link rel="stylesheet" href="{{ asset('css/Historical.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success custom-alert" id="success-alert">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="about">
        <h2>Lịch sử đơn hàng</h2>
        @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="historical_detail">
            <div class="status">
                <p>
                    <strong>Trạng thái đơn hàng:</strong>
                    <span class="badge 
                        @if($order->status == 'pending') bg-warning 
                        @elseif($order->status == 'canceled') bg-danger 
                        @elseif($order->status == 'Đang giao hàng') bg-primary 
                        @elseif($order->status == 'Đã xác nhận') bg-info 
                        @elseif($order->status == 'Hoàn thành') bg-success 
                        @endif">
                        {{ $order->status }}
                    </span>
                </p>
            </div>

            <hr style="width:100%;color: rgb(228, 227, 227)">
            <div class="detail-product">
                @foreach($order->items as $item)
                <div class="product-card">
                    <img src="{{ asset('anh/' . $item->image_url) }}" alt="Product Image" class="order-item-img" style="width:200px;height:200px">
                    <div class="product-details">
                        <h3>{{ $item->description }}</h3>
                        <p><strong>Phân loại:</strong> {{ $item->product->category->name ?? '#' }}</p> <!-- Hiển thị phân loại -->
                        <p>Số lượng: {{ $item->quantity }}</p>
                        <p>Tổng: {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</p>
                    </div>
                </div>
                @endforeach
            </div>
            <hr style="width:100%;color: rgb(228, 227, 227)">
            <div class="money-total">
                <p><strong>Thành tiền: </strong>{{ number_format($order->total_amount, 0, ',', '.') }} VND</p>
                <div class="action-buttons">
                    <form action="{{ route('addToCart', $item->pet_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="add-to-cart-btn">
                            Mua lại
                        </button>
                    </form>
                    <a href="#" class="btn btn-secondary btn-sm">Liên Hệ Người Bán</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p style="text-align: center;">Bạn chưa có đơn hàng nào.</p>
        @endif
    </div>





    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>