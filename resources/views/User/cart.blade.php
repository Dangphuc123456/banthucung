<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Cart.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <!-- Giỏ hàng -->
    <h2>Giỏ hàng</h2>
    <div class="cart-content">
        @if(session('success'))
        <div class="alert alert-success custom-alert" id="success-alert">
            {{ session('success') }}
        </div>
        @endif
        @if(empty($cart))
        <p style="margin-left:400px">Giỏ hàng của bạn đang trống.<a href="{{ route('User.products') }}">
                <button style="width:200px;height:60px;border-radius:10px;margin-left:30px"> Mua hàng</button>
            </a></p>
        @else
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Mã</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tạm tính</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $pet_id => $item)
                <tr>
                    <td>
                        <img src="{{ asset($item['image_url'] ? 'anh/' . $item['image_url'] : 'anh/default.jpg') }}" alt="{{ $item['name'] ?? 'Không có mô tả' }}" width="100">
                    </td>
                    <td>00{{ $pet_id }}</td>
                    <td>{{ $item['description'] ?? 'Không có mô tả' }}</td>
                    <td>{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td id="total-price-{{ $pet_id }}">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</td>
                    <td>
                        <form action="{{ route('removeFromCart', $pet_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <!-- Tóm tắt giỏ hàng -->
    @if(session('Cart') && count(session('Cart')) > 0)
    <div class="cart-summary">
        <h3>Cộng Giỏ Hàng</h3>
        <hr />
        <div class="summary-row">
            <h3>Tạm tính:</h3>
            <p id="cart-total">{{ number_format($total, 0, ',', '.') }}đ</p>
        </div>
        <hr />
        <div class="summary-row">
            <h3>Tổng tiền:</h3>
            <p id="cart-total">{{ number_format($total, 0, ',', '.') }}đ</p>
        </div>
        <hr />
        <div class="summary">
            <h3>Giao hàng:</h3>
            <p>Đồng giá<br>Tùy chọn giao hàng sẽ được cập nhật trong quá trình thanh toán.<br>Tính phí giao hàng</p>
        </div>
    </div>
    @endif

    <!-- Tiến hành đặt hàng -->
    <div class="button-container">
        <div class="ttmuahang">
            <a href="{{ route('User.products') }}" class="blink">
                <button style="cursor: pointer;" class="blink">
                    <span class="button-content">
                        <i class="fas fa-sign-out-alt fa-flip-horizontal"></i>
                        <h4>Tiếp tục mua hàng</h4>
                    </span>
                </button>
            </a>
        </div>
        @if (Auth::guard('customer')->check())
        <!-- Nếu người dùng đã đăng nhập -->
        <form action="{{ route('User.checkouts') }}" method="GET">
            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
            <button class="checkoutBtn" id="checkoutBtn">Tiến Hành Đặt Hàng</button>
        </form>
        @else
        <!-- Nếu người dùng chưa đăng nhập -->
        <button class="checkoutBtn" id="checkoutBtn" disabled>Tiến Hành Đặt Hàng</button>
        <p class="login-prompt">Vui lòng <a href="{{ route('User.userslogin') }}">đăng nhập</a> để tiến hành đặt hàng.</p>
        @endif
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Cart.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>