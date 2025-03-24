<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai&display=swap" rel="stylesheet">
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
    <div class="products-container">
        <h2>SẢN PHẨM MỚI</h2>
        <div class="product-list">
            @foreach($spm as $item)
            <div class="product-card">
                <div class="image-container">
                    <a href="{{ route('User.detail', $item->pet_id) }}">
                        @if(isset($item->image_url))
                        <img style="width:230px; height:210px;" class="img_SP" src="anh/{{$item->image_url}}" alt="Product image">
                        @else
                        <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                        @endif
                        <span class="new-label">New</span>
                    </a>
                </div>
                <div class="product-info">
                    <p>Mã ID: {{ Hashids::encode($item->pet_id) }}</p>
                    <h3>{{ $item->description }}</h3>
                    <p class="price">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                </div>
                <!-- Nút "Xem chi tiết" ẩn đi, chỉ hiển thị khi hover vào sản phẩm -->
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
        <a href="{{ route('User.products') }}"><button class="view-more">Xem Thêm <i class='fas fa-angle-right'></i></button></a>
    </div>
    <div class="products-container">
        <h2>SẢN PHẨM NỔI BẬT</h2>
        <div class="product-list">
            @foreach($sellingProducts as $item)
            <div class="product-card">
                <div class="image-container">
                    @if(isset($item->image_url))
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/{{$item->image_url}}" alt="Product image">
                    @else
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                    @endif
                </div>
                <div class="product-info">
                    <p>Mã ID: {{ Hashids::encode($item->pet_id) }}</p>
                    <h3>{{ $item->description }}</h3>
                    <p class="price">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                </div>
                <!-- Nút "Xem chi tiết" ẩn đi, chỉ hiển thị khi hover vào sản phẩm -->
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
        <a href="{{ route('User.products') }}"><button class="view-more">Xem Thêm <i class='fas fa-angle-right'></i></button></a>
    </div>
    <div class="products-container">
        <h2>SHOP BÁN CHÓ MÈO</h2>
        <div class="product-list">
            @foreach($randomPets as $item)
            <div class="product-card">
                <div class="image-container">
                    @if(isset($item->image_url))
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/{{$item->image_url}}" alt="Product image">
                    @else
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                    @endif
                    <span class="new-label">New</span>
                </div>
                <div class="product-info">
                    <p>Mã ID: {{ Hashids::encode($item->pet_id) }}</p>
                    <h3>{{ $item->description }}</h3>
                    <p class="price">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                </div>
                <!-- Nút "Xem chi tiết" ẩn đi, chỉ hiển thị khi hover vào sản phẩm -->
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
        <a href="{{ route('User.products') }}"><button class="view-more">Xem Thêm <i class='fas fa-angle-right'></i></button></a>
    </div>
    <div class="products-container">
        <h2>PHỤ KIỆN-ĐỒ ĂN</h2>
        <div class="product-list">
            @foreach($accessories as $item)
            <div class="product-card">
                <div class="image-container">
                    @if(isset($item->image_url))
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/{{$item->image_url}}" alt="Product image">
                    @else
                    <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                    @endif
                </div>
                <div class="product-info">
                    <p>Mã ID: {{ Hashids::encode($item->pet_id) }}</p>
                    <h3>{{ $item->description }}</h3>
                    <p class="price">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                </div>
                <!-- Nút "Xem chi tiết" ẩn đi, chỉ hiển thị khi hover vào sản phẩm -->
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
    <a href="{{ route('User.accessory') }}"><button class="view-more">Xem Thêm <i class='fas fa-angle-right'></i></button></a>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>