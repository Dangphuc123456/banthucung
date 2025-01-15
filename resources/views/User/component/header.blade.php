 <!-- Header -->
 <header class="header">
     <div class="container">
         <div class="logo">
             <img style="height: 100px;width:180px" src="{{ asset('anh/pet.jpg') }}" alt="Pet">
         </div>
         <nav class="navbar">
             <ul>
                 <li><a href="{{ route('User.home') }}">Trang Chủ</a></li>
                 <li><a href="{{ route('User.products') }}">Thú Cưng</a></li>
                 <li><a href="{{ route('User.accessory') }}">Phụ Kiện</a></li>
                 <li><a href="{{ route('User.service') }}">Dịch Vụ</a></li>
                 <li><a href="{{ route('User.introduction') }}">Giới Thiệu</a></li>
                 <li><a href="{{ route('User.contact') }}">Liên Hệ</a></li>
             </ul>
         </nav>
         <div class="group">
             <div class="user-auth">
                 @if (Auth::guard('customer')->check())
                 <!-- Hiển thị tên và ảnh khi khách hàng đã đăng nhập -->
                 <div class="user-info">
                     <img src="{{ asset('anh/user.png') }}" alt="Avatar" class="user-avatar" style="width:30px;height:30px;margin-left:40px" id="userAvatar" data-bs-toggle="dropdown" aria-expanded="false">
                     <span style="margin-left:8px" class="user-name">{{ Auth::guard('customer')->user()->name }}</span>

                     <!-- Dropdown menu -->
                     <ul class="dropdown-menu" aria-labelledby="userAvatar">
                         <li><a class="dropdown-item" href="{{ route('User.orders.historical') }}">Lịch sử đơn hàng</a></li>
                         <li><a class="dropdown-item" href="{{ route('User.orders.bookings') }}">Lịch sử đặt phòng</a></li>
                         <li><a class="dropdown-item" href="{{ route('User.orders.guarantee') }}">Bảo hành</a></li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                         <li><a class="dropdown-item" href="{{ route('User.logout') }}">Đăng xuất</a></li>
                     </ul>
                 </div>
                 @else
                 <!-- Hiển thị liên kết đăng ký và đăng nhập nếu chưa đăng nhập -->
                 <a href="{{ route('User.usersregister') }}" class="register-link"><i class="fas fa-user-plus"></i>Đăng Ký</a>
                 <a href="{{ route('User.userslogin') }}" class="login-link"><i class="fas fa-user"></i>Đăng Nhập</a>
                 @endif
             </div>
             <div class="cart">
                 <a href="{{ route('User.cart') }}">
                     <span class="shopping-cart"></span> Shopping Cart
                 </a>
                 @if(session('Cart_TotalQuantity', 0) > 0)
                 <div class="cart-details">
                     <span class="cart-count" style="color: #fff;">{{ session('Cart_TotalQuantity', 0) }} sản phẩm -</span>
                     <span class="cart-total" style="color: #fff;">{{ number_format(session('Cart_TotalPrice', 0), 0, ',', '.') }}đ</span>
                 </div>
                 @endif
             </div>
         </div>
     </div>
 </header>

 <div class="slideshow-container">
     <!-- Slides -->
     <div class="mySlides fade">
         <img src="{{ asset('anh/petshop.png') }}" style="width:100%;height:575px">
         <div class="text"></div>
     </div>

     <div class="mySlides fade">
         <img src="{{ asset('anh/petshop1.png') }}" style="width:100%;height:575px">
         <div class="text"></div>
     </div>
     <div class="mySlides fade">
         <img src="{{ asset('anh/hh.png') }}" style="width:100%;height:575px">
         <div class="text"></div>
     </div>

     <div class="mySlides fade">
         <img src="{{ asset('anh/sh.png') }}" style="width:100%;height:575px">
         <div class="text"></div>
     </div>

     <div class="mySlides fade">
         <img src="{{ asset('anh/KC.png') }}" style="width:100%;height:575px">
         <div class="text"></div>
     </div>

     <!-- Navigation dots -->
     <div class="dot-container">
         <span class="dot"></span>
         <span class="dot"></span>
         <span class="dot"></span>
         <span class="dot"></span>
         <span class="dot"></span>
     </div>
 </div>

 <!-- Search Bar -->
 <section class="search-bar">
     <div class="container">
         <!-- Dropdown -->
         <select class="categories" id="category-select">
             <option value="">All categoris</option>
             @foreach($lsp as $category)
             <option value="{{ route('User.category', [
            'category' => Hashids::encode($category->category_id),  // Mã hóa category_id
             ]) }}">
                 {{ $category->category_name }}
             </option>
             @endforeach
         </select>
         <!-- Form tìm kiếm -->
         <form action="{{ route('User.search') }}" method="GET">
             <input type="text" class="search-input" name="key" placeholder="Tìm kiếm theo mô tả..." value="{{ request()->input('key') }}">
             <button type="submit" class="search-btn">🔍</button>
         </form>
     </div>
 </section>
 <hr style="height: 1px;background-color:hotpink;padding:0px">
 <script>
     document.getElementById('category-select').addEventListener('change', function() {
         if (this.value) {
             window.location.href = this.value; // Chuyển hướng đến route
         }
     });
 </script>
 <script>
     document.getElementById('userAvatar').addEventListener('click', function() {
         var dropdownMenu = document.getElementById('dropdownMenu');
         // Chuyển đổi trạng thái hiển thị/ẩn của dropdown menu
         dropdownMenu.classList.toggle('show');
     });

     // Đóng dropdown nếu người dùng nhấn bên ngoài
     window.addEventListener('click', function(event) {
         var dropdownMenu = document.getElementById('dropdownMenu');
         var userAvatar = document.getElementById('userAvatar');

         if (!userAvatar.contains(event.target)) {
             dropdownMenu.classList.remove('show');
         }
     });
 </script>


 <style>
     .dropdown-menu {
         display: none;
     }

     .dropdown-menu.show {
         display: block;
     }

     .user-info {
         position: relative;
         display: inline-block;
         cursor: pointer;
     }

     .user-avatar {
         border-radius: 50%;
         cursor: pointer;
     }

     .user-name {
         margin-left: 8px;
         font-size: 14px;
     }

     .dropdown-menu {
         display: none;
         /* Ẩn menu dropdown mặc định */
         position: absolute;
         top: 100%;
         left: 0;
         background-color: #fff;
         border: 1px solid #ddd;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         list-style-type: none;
         padding: 10px 0;
         margin: 0;
         width: 200px;
         border-radius: 4px;
     }

     .dropdown-menu li {
         padding: 10px;
     }

     .dropdown-menu li a {
         color: #333;
         text-decoration: none;
         display: block;
     }

     .dropdown-menu li a:hover {
         background-color: #f1f1f1;
     }

     .dropdown-divider {
         border-top: 1px solid #ddd;
         margin: 5px 0;
     }
 </style>

 <style>
     .user-auth {

         align-items: center;
         gap: 10px;
         margin-right: 20px;
         margin-left: 30px;
     }

     .register-link,
     .login-link {
         text-decoration: none;
         color: #000;
         /* Hoặc màu phù hợp */
         font-size: 14px;
         margin-left: 10px;
     }

     .register-link:hover,
     .login-link:hover {
         color: #007bff;
         /* Hoặc màu hover mong muốn */
     }
 </style>
 <!-- Thêm JS của Bootstrap (để dropdown hoạt động) -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>