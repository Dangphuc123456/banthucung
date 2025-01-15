<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval';">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Checkouts.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <form action="{{ route('User.checkouts.store') }}" method="POST" class="order-form">
        @csrf
        <div class="customer-info">
            <h2>Thông tin khách hàng</h2>
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="customer_name" placeholder="Nhập họ tên" required class="form-input">
            </div>
            <div class="form-group">
                <label for="country">Quốc Gia:</label>
                <input style="border: 0px;" type="text" id="country" name="country" value="Việt Nam" readonly class="form-input">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Nhập email" required class="form-input">
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required class="form-input">
            </div>
            <div class="form-group">
                <label for="postal-code">Mã bưu điện: (tùy chọn)</label>
                <input type="text" id="postal-code" name="postal_code" placeholder="Nhập mã bưu điện" class="form-input">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required class="form-input">
            </div>
            <div class="form-group">
                <label for="payment">Phương thức thanh toán:</label>
                <select id="payment" name="payment" required class="form-input">
                    <option disabled selected>Chọn phương thức thanh toán</option>
                    <option value="cod">Thanh toán khi nhận hàng</option>
                    <option value="credit">Thẻ tín dụng</option>
                </select>
            </div>

            <!-- Form thanh toán thẻ tín dụng -->
            <div id="credit-card-form" class="hidden">
                <h3>Thông tin thẻ tín dụng</h3>
                <div class="form-group">
                    <label for="card-number">Số thẻ:</label>
                    <input type="text" id="card-number" name="card_number" placeholder="Nhập số thẻ" class="form-input">
                </div>
                <div class="form-group">
                    <label for="card-holder">Tên chủ thẻ:</label>
                    <input type="text" id="card-holder" name="card_holder" placeholder="Nhập tên chủ thẻ" class="form-input">
                </div>
                <div class="form-group">
                    <label for="expiry-date">Ngày hết hạn:</label>
                    <input type="month" id="expiry-date" name="expiry_date" class="form-input">
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" placeholder="CVV" class="form-input">
                </div>
            </div>
        </div>

        <div class="order-summary">
            <h2>Đơn Hàng Của Bạn</h2>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Mã</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                    <tr>
                        <td> <img src="{{ asset($item['image_url'] ? 'anh/' . $item['image_url'] : 'anh/default.jpg') }}" alt="{{ $item['name'] ?? 'Không có mô tả' }}" width="100"></td>
                        <td>00{{ $id }}</td>
                        <td>{{ $item['description'] ?? 'Không có mô tả' }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</td>
                        <!-- Các input hidden cho bảng order_items -->
                        <input type="hidden" name="order_items[{{ $id }}][pet_id]" value="{{ $id }}">

                        <input type="hidden" name="order_items[{{ $id }}][quantity]" value="{{ $item['quantity'] ?? 1 }}">

                        <input type="hidden" name="order_items[{{ $id }}][price]" value="{{ $item['price'] ?? 0 }}">

                        <input type="hidden" name="order_items[{{ $id }}][description]" value="{{ $item['description'] ?? 'Không có mô tả' }}">

                        <input type="hidden" name="order_items[{{ $id }}][image_url]" value="{{ $item['image_url'] ?? 'default.jpg' }}">
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="total-price"><strong>Tổng tiền:</strong> {{ number_format($totalPrice, 0, ',', '.') }}đ</p>
            <input type="hidden" name="total_amount" value="{{ $totalPrice }}">
        </div>
        <button type="submit" class="submit-btn">Đặt Hàng</button>
    </form>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
    <script src="{{ asset('js/Checkout.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
</body>

</html>