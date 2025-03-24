<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<hr style="height: 2px;width:100%;background-color:palevioletred">
<div class="pet" style="height: 130px;">
    <!-- Con chó 1 -->
    <div class="dog">
        <div class="tooltip">Pit Bull
        <span class="arrow"></span>
        </div>
        <img src="{{ asset('anh/dog1.png') }}" alt="Chó Pug">
    </div>
    <!-- Con chó 2 -->
    <div class="dog">
        <div class="tooltip">Jack Russell Terrier
        <span class="arrow"></span>
        </div>
        <img src="{{ asset('anh/dog2.png') }}" alt="Golden Retriever">
    </div>
    <!-- Con chó 3 -->
    <div class="dog">
        <div class="tooltip">Golden Retriever
        <span class="arrow"></span>
        </div>
        <img src="{{ asset('anh/dog3.png') }}" alt="Phốc Sóc">
    </div>
    <!-- Con chó 4 -->
    <div class="dog">
        <div class="tooltip">Cairn Terrier
        <span class="arrow"></span>
        </div>
        <img src="{{ asset('anh/dog4.png') }}" alt="Bulldog Pháp">
    </div>
    <!-- Con chó 5 -->
    <div class="dog">
        <div class="tooltip">French Bulldog
        <span class="arrow"></span>
        </div>
        <img src="{{ asset('anh/dog5.png') }}" alt="Phốc Sóc">
    </div>
    <!-- Con chó 6 -->
    <div class="dog">
        <div class="tooltip">Beagle
        <span class="arrow"></span>
        </div>
        <img src="{{ asset('anh/dog6.png') }}" alt="Bulldog Pháp">
    </div>
    <!-- Con chó 7 -->
    <div class="dog">
        <div class="tooltip">Boston Terrier
        <span class="arrow"></span>
        </div>
        <img src="{{ asset('anh/dog7.png') }}" alt="Bulldog Pháp">
    </div>
    <!-- Con chó 8 -->
    <div class="dog">
        <div class="tooltip">Pug
        <span class="arrow"></span>
        </div>
        <img src="{{ asset('anh/dog8.png') }}" alt="Bulldog Pháp">
    </div>
</div>
<div class="footer">
    <div class="we">
        <h3>Về chúng tôi</h3>
        <p style=" color: pink;">Pet Shop của chúng tôi cung cấp mọi thứ bạn cần cho thú cưng, từ thức ăn, phụ kiện, đến dịch vụ chăm sóc chuyên nghiệp. Chúng tôi cam kết mang lại hạnh phúc cho thú cưng của bạn!</p>
    </div>
    <div class="contact">
        <h3>Liên hệ</h3>
        <p style=" color: pink;"><i style="margin-right: 10px;" class="fas fa-phone"></i><strong>Số điện thoại:</strong> <a href="tel:+84964505836">(+84) 96 4505 836</a></p>
        <p style=" color: pink;"><i style="margin-right: 10px;" class="fas fa-envelope"></i><strong>Email:</strong> <a href="mailto:dangphucvghy195@gmail.com">dangphucvghy195@gmail.com</a></p>
        <p style=" color: pink;"><i style="margin-right: 10px;" class="fa fa-facebook-square"></i><strong>Facebook:</strong> <a href="https://www.facebook.com/profile.php?id=100010380312096">Văn Phúc</a></p>
    </div>
    <div class="links">
        <h3>Địa chỉ chi nhánh</h3>
        <ul style=" color: pink;">
            <li><i style="margin-right: 10px;" class='fas fa-map-marked'></i><span>Số 168 Thượng Đình - Thanh Xuân - Hà Nội</span></li>
            <li><i style="margin-right: 10px;" class='fas fa-map-marked'></i><span>294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh</span></li>
            <li><i style="margin-right: 10px;" class='fas fa-map-marked'></i><span>149-150 Thảo Nguyên- Ecopark -Hưng Yên</span></li>
        </ul>
    </div>
    <div>
    <div class="social">
        <h3>Follow Us</h3>
        <p style=" color: pink;">
            <a href="#">Facebook</a> |
            <a href="#">Twitter</a> |
            <a href="#">Instagram</a>
        </p>
    </div>
    <div class="banking">
        <h3>Ngân hàng</h3>
        <p style=" color: pink;display:flex;">
            <img src="{{ asset('anh/mb.jpg') }}" alt="" style="width:80px;height:50px;margin-left:5px">
            <img src="{{ asset('anh/vcb.jpg') }}" alt=""style="width:80px;height:50px;margin-left:5px">
            <img src="{{ asset('anh/tcb.jpg') }}" alt=""style="width:80px;height:50px;margin-left:5px">
        </p>
    </div>
    </div>
</div>
<style>
   .pet {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.dog {
    position: relative;
    text-align: center;
    cursor: pointer;
}

.dog img {
    width: 120px;
    height: auto;
    transition: transform 0.3s ease-in-out;
}

.dog:hover img {
    transform: scale(1.1);
}

.tooltip {
    position: absolute;
    top: -60px; /* Đưa tooltip lên trên */
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease-in-out;
}

/* Mũi tên cong sử dụng ::after */
.tooltip::after {
    content: "";
    position: absolute;
    width: 25px;
    height: 15px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='40' height='40' fill='black'%3E%3Cpath d='M12 0 Q15 10, 10 20' stroke='%23000' stroke-width='2' fill='none'/%3E%3Cpath d='M10 20l-2-3 3 1' stroke='%23000' stroke-width='2' fill='none'/%3E%3C/svg%3E");
    background-size: contain;
    background-repeat: no-repeat;
    bottom: -15px;  /* Kéo mũi tên xuống */
    left: 50%;
    transform: translateX(-50%) rotate(20deg);
    opacity: 1;
}


.dog:hover .tooltip {
    opacity: 1;
    visibility: visible;
}

</style>