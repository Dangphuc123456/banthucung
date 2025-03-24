<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetShop</title>
    <link rel="stylesheet" href="{{ asset('css/Contact.css') }}">
    <link rel="icon" href="{{ asset('anh/pet.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('User.component.header')
    @include('User.component.tab')
    <h2>Liên hệ - Địa chỉ</h2>
    <div class="about">
        <div class="contact">
            <form action="{{ route('User.store') }}" method="POST">
                @csrf <!-- Đừng quên thêm token CSRF -->
                <p style="font-size: 25px;font-weight:700;margin-left:130px">Contact Form</p>
                <input class="email" type="text" id="lname" name="lastname" placeholder="Email...">
                <textarea id="subject" name="subject" placeholder="Message?" style="height:200px;font-size: 20px;"></textarea>
                <button style="width:90px;height:30px; border-radius: 8px;border:0px;background-color:hotpink;display:block;margin-left:130px" type="submit">
                    Gửi</button>
            </form>
        </div>
    </div>
    <div class="map">
        <div class="map1" style=" margin-top: 30px;">
            <label for="lname" style="margin-bottom: 10px;"> <i style="margin-right: 10px;color: pink;" class='fas fa-map-marked'></i><span>Số 168 Thượng Đình - Thanh Xuân - Hà Nội</span> </label>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3414.464629078714!2d105.81365407486162!3d20.997827380643788!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac91775cf503%3A0x251a0575fd25c6d0!2zMTY4IFAuIFRoxrDhu6NuZyDEkMOsbmgsIFRoxrDhu6NuZyDEkMOsbmgsIFRoYW5oIFh1w6JuLCBIw6AgTuG7mWksIFZpZXRuYW0!5e1!3m2!1sfr!2s!4v1732378077707!5m2!1sfr!2s" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="map2" style=" margin-top: 30px;">
            <label for="lname" style="margin-bottom: 10px;"><i style="margin-right: 10px;color: pink;" class='fas fa-map-marked'></i><span>294 - 296 Đồng Đen - Quận Tân Bình - Hồ Chí Minh</span></label>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.7251226403064!2d106.64022197462738!3d10.78551898936382!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752eb19607682d%3A0x25b7b73a2e907a0e!2zMjk0LzI5NiwgMjk0IMSQ4buTbmcgxJBlbiwgUGjGsOG7nW5nIDEwLCBUw6JuIELDrG5oLCBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e1!3m2!1sfr!2s!4v1732378051469!5m2!1sfr!2s" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="map3" style=" margin-top: 30px;">
            <label for="lname" style="margin-bottom: 10px;"><i style="margin-right: 10px;color: pink;" class='fas fa-map-marked'></i><span>149-150 Thảo Nguyên- Ecopark -Hưng Yên</span> </label>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3415.5442365826852!2d105.94028147486016!3d20.95057708067931!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135af3447fb0ad9%3A0x2c9061ddc5276524!2sTr%C3%A2u%20Ngon%20Qu%C3%A1%20-%20Ecopark!5e1!3m2!1sfr!2s!4v1732377985666!5m2!1sfr!2s" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    @include('User.component.scroll')
    @include('User.component.chat')
    @include('User.component.footer')
    <script src="{{ asset('js/Home.js') }}"></script>
</body>

</html>