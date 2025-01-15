<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Information.css') }}">
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
    <div class="invoice-container">
        <header>
            <h1>Hóa đơn thanh toán</h1>
            <p>Cảm ơn bạn đã mua hàng!</p>
        </header>

        <section class="customer-details">
            <h2>Thông tin khách hàng</h2>
            <p><strong>Tên khách hàng:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
            <p><strong>Điện thoại:</strong> {{ $order->phone }}</p>
        </section>

        <section class="order-details">
            <h2>Chi tiết đơn hàng</h2>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>
                            <img src="{{ asset($item['image_url'] ? 'anh/' . $item['image_url'] : 'anh/default.jpg') }}" alt="{{ $item['name'] ?? 'Không có mô tả' }}" width="100"" width=" 100">
                        </td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="total">
            <a href="{{ route('User.home') }}"><button class="home-button">Về Trang Chủ</button></a>
            <p class="total-amount"><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }}đ</p>
        </section>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>