<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Products.css') }}">
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
        <div class="products-container">
            <h2>THÚ CƯNG</h2>
            <div class="product-list">
                @foreach($pets as $pet)
                <div class="product-card">
                    <div class="image-container">
                        @if(isset($pet->image_url))
                        <img style="width:210px; height:200px;" class="img_SP" src="anh/{{$pet->image_url}}" alt="Product image">
                        @else
                        <img style="width:210px; height:200px;" class="img_SP" src="anh/default.jpg" alt="Product image">
                        @endif
                        <span class="new-label">New</span>
                    </div>
                    <div class="product-info">
                        <p>ID: {{ Hashids::encode($pet->pet_id) }}</p>
                        <h3>{{ $pet->description }}</h3>
                        <p class="price">{{ number_format($pet->price, 0, ',', '.') }}đ</p>
                    </div>
                    <div class="view_order">
                        <div class="detail-button-container">
                            <a href="{{ route('User.detail', $pet->pet_id) }}" class="add-to-cart-btn">
                                Xem chi tiết
                            </a>
                        </div>
                        <div class="detail-button-container">
                            @if($pet->quantity_in_stock > 0)
                            <form action="{{ route('addToCart', $pet->pet_id) }}" method="POST">
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
    <div class="pagination">
        <!-- Nút "Previous" -->
        @if($pets->onFirstPage())
        <a href="#" class="disabled">&laquo; Previous</a>
        @else
        <a href="{{ $pets->previousPageUrl() }}">&laquo; Previous</a>
        @endif
        <!-- Hiển thị số trang rút gọn -->
        @php
        $start = max($pets->currentPage() - 2, 1);
        $end = min($pets->currentPage() + 2, $pets->lastPage());
        @endphp
        @if($start > 1)
        <a href="{{ $pets->url(1) }}">1</a>
        @if($start > 2)
        <span>...</span>
        @endif
        @endif
        @for($i = $start; $i <= $end; $i++)
            <a href="{{ $pets->url($i) }}" class="{{ $i == $pets->currentPage() ? 'active' : '' }}">
            {{ $i }}
            </a>
            @endfor

            @if($end < $pets->lastPage())
                @if($end < $pets->lastPage() - 1)
                    <span>...</span>
                    @endif
                    <a href="{{ $pets->url($pets->lastPage()) }}">{{ $pets->lastPage() }}</a>
                    @endif

                    <!-- Nút "Next" -->
                    @if($pets->hasMorePages())
                    <a href="{{ $pets->nextPageUrl() }}">Next &raquo;</a>
                    @else
                    <a href="#" class="disabled">Next &raquo;</a>
                    @endif
    </div>

    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>