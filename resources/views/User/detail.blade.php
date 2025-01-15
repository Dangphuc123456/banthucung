<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Detail.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    <div class="tab">
        <a href="{{ route('User.home') }}">
            <div class="home">
                <h4>
                    Trang chủ
                </h4>
            </div>
        </a>
        <span class="separator">|</span>
        <div class="category">
            <h4>
                Danh mục sản phẩm
            </h4>
        </div>
        <span class="separator">|</span>
        <div class="category">
            <h4>
                <span>{{ $sp->species }}</span>-<span>{{ $sp->breed }}</span>
            </h4>
        </div>
    </div>
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success custom-alert" id="success-alert">
            {{ session('success') }}
        </div>
        @endif
    </div>
    <div class="about">
        <div class="menu-vertical">
            <h3>DANH MỤC SẢN PHẨM</h3>
            <hr style="color:gray">
            <ul>
                @foreach($lsp as $category)
                <li>
                    <a href="{{ route('User.category', ['category' => Hashids::encode($category->category_id)]) }}">
                        {{$category->category_name}} <span>({{ $category->pets_count }})</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="product-details">
            <h2>CHI TIẾT SẢN PHẨM</h2>
            <form action="{{ route('addToCart', ['pet_id' => $sp->pet_id]) }}" method="POST">
                @csrf
                <div class="detail">
                    <div class="product-image">
                        <!-- Kiểm tra và sử dụng đúng hình ảnh sản phẩm -->
                        @if(isset($sp->image_url) && !empty($sp->image_url))
                        <img src="{{ asset('anh/' . $sp->image_url) }}" alt="{{ $sp->name }}">
                        @else
                        <img src="{{ asset('anh/default.jpg') }}" alt="Hình ảnh sản phẩm">
                        @endif
                    </div>
                    <div class="product-info">
                        <h3>{{ $sp->description }}</h3>
                        <p class="price">{{ number_format($sp->price, 0, ',', '.') }}đ</p>
                        <h4>Giới tính: <span style="color: black; margin-left:10px;">{{ $sp->gender }}</span><span style="margin-left: 30px;">Mã ID:{{ Hashids::encode($sp->pet_id) }}</span></h4>
                        <div class="category">
                            <label for="category">Danh mục: <span>{{ $sp->species }}</span>-<span>{{ $sp->breed }}</span></label>
                        </div>
                        <div class="status">
                            <label for="status">Tình trạng: <span style="color: #696969; margin-left:10px;">{{ $sp->status ?? 'Chưa xác định' }}</span></label>
                        </div>
                        <div class="quantity">
                            <label for="quantity">Số lượng:{{ $sp->quantity_in_stock }} <strong style="margin-left: 10px;">Đã bán:{{ $sp->quantity_sold }}</strong> </label>
                        </div>
                        @if($sp->quantity_in_stock > 0)
                        <div class="quantity" style="margin-top:10px;">
                            <label for="quantity">Số lượng:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $sp->quantity_in_stock }}" required>
                        </div>
                        <button type="submit" class="btn-buy">MUA HÀNG</button>
                        @else
                        <button style="margin-top: 10px;" type="button" class="btn-buy" disabled>HẾT HÀNG</button>
                        @endif
                    </div>
                </div>
            </form>

            <div class="products-container">
                <h2>THÚ CƯNG TƯƠNG TỰ</h2>
                <div class="product-list">
                    @php $count = 0; @endphp
                    @forelse($similarProducts as $pet)
                    @if($count < 3 && $pet)
                        <div class="product-card">
                        <div class="image-container">
                            @if(isset($pet->image_url))
                            <img style="width:210px; height:200px" class="img_SP" src="{{ asset('anh/' . $pet->image_url) }}" alt="Product image">
                            @else
                            <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                            @endif
                            <span class="new-label">New</span>
                        </div>
                        <div class="product-infos">
                            <p>ID: {{ Hashids::encode($pet->pet_id) }}</p>
                            <h3>{{ $pet->description }}</h3>
                            <p class="price" style="color: #d677a1;">{{ number_format($pet->price, 0, ',', '.') }}đ</p>
                        </div>
                        <div class="view_order">
                            <div class="detail-button-container">
                                <a href="{{ route('User.detail', $pet->pet_id) }}" class="add-to-cart-btn">Xem chi tiết</a>
                            </div>
                            <div class="detail-button-container">
                                <a href="{{ route('addToCart', $pet->pet_id) }}" class="add-to-cart-btn" style="width:80px">Mua ngay</a>
                            </div>
                        </div>
                </div>
                @php $count++; @endphp
                @endif
                @empty
                <p>Không có thú cưng tương tự.</p>
                @endforelse
            </div>
        </div>

    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>