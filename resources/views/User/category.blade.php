<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Category.css') }}">
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
                {{ $loaisp->category_name }}
            </h4>
        </div>
    </div>
    <div class="about">
        <div class="menu-vertical">
            <h4>DANH MỤC SẢN PHẨM</h4>
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
        <div class="products-container">
            <h2>{{ $loaisp->category_name }}</h2>
            <div class="product-list">
                @foreach($product as $item) <!-- Lặp qua các sản phẩm của danh mục -->
                <div class="product-card">
                    <div class="image-container">
                        @if(isset($item->image_url)) <!-- Kiểm tra nếu có ảnh sản phẩm -->
                        <img style="width:210px; height:200px;" class="img_SP" src="{{ asset('anh/' . $item->image_url) }}" alt="Product image">
                        @else
                        <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                        @endif
                        <span class="new-label">New</span>
                    </div>
                    <div class="product-info">
                        <p>ID: {{ Hashids::encode($item->pet_id) }}</p>
                        <h3>{{ $item->description }}</h3>
                        <p class="price">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                    </div>
                    <div class="view_order">
                        <div class="detail-button-container">
                            <a href="{{ route('User.detail', $item->pet_id) }}" class="add-to-cart-btn">
                                Xem chi tiết
                            </a>
                        </div>
                        <div class="detail-button-container">
                            @if($item->quantity_in_stock > 0)
                            <form action="{{ route('addToCart', $item->pet_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-to-cart-btn">
                                    Mua ngay
                                </button>
                            </form>
                            @else
                            <button class="out-of-stock-btn" disabled>
                                Hết hàng
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>