///////////////////////////////////////////////////////////
///////////////////showSlides/////////////////////////
let slideIndex = 0;
// Function to show slides  
function showSlides() {
    const slides = document.getElementsByClassName("mySlides");
    const dots = document.getElementsByClassName("dot");

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  // Hide all slides  
    }
    slideIndex++;  // Increment slide index  
    if (slideIndex > slides.length) { slideIndex = 1; }  // Reset to first slide  

    for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");  // Remove active class from all dots  
    }

    slides[slideIndex - 1].style.display = "block";  // Show the current slide  
    dots[slideIndex - 1].className += " active";  // Add active class to the current dot  

    setTimeout(showSlides, 3000);  // Change slide every 3 seconds  
}

// Start showing slides  
showSlides();


///////////////////////////////////////////////////////////
///////////////////cuốn trang/////////////////////////
window.addEventListener('scroll', function () {
    var scrollToTopBtn = document.getElementById('scroll-to-top-btn');
    if (window.pageYOffset > 200) {//đủ 200px hiện nút và ngược lại là k hiện 
        scrollToTopBtn.style.display = 'block';
    } else {
        scrollToTopBtn.style.display = 'none';
    }
});
document.getElementById('scroll-to-top-btn').addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

///////////////////////////////////////////////////////////
///////////////////Hiển thị thông báo/////////////////////////
// Kiểm tra xem có thông báo thành công hay không
window.addEventListener('DOMContentLoaded', (event) => {
    // Nếu có thông báo
    let alert = document.getElementById('success-alert');

    // Kiểm tra xem phần tử có tồn tại không
    if (alert) {
        // Sau 5 giây, ẩn thông báo bằng cách thay đổi độ mờ (opacity)
        setTimeout(() => {
            alert.style.opacity = 0;
            // Sau khi opacity chuyển về 0, ẩn hẳn phần tử
            setTimeout(() => {
                alert.style.display = 'none';
            }, 1000); // Thời gian để opacity mờ dần (1 giây)
        }, 2000); // Hiển thị trong 5 giây
    }
});

///////////////////////////////////////////////////////////
///////////////////Updete số lượng/////////////////////////
// $(document).ready(function () {
//     $('.btn-update-quantity').on('click', function (e) {
//         e.preventDefault();

//         var pet_id = $(this).data('id'); // Lấy pet_id từ data-id
//         var quantity = $('#quantity-' + pet_id).val(); // Lấy giá trị số lượng

//         $.ajax({
//             type: 'POST',
//             url: '/update-cart/' + pet_id,
//             data: {
//                 _token: '{{ csrf_token() }}',
//                 quantity: quantity
//             },
//             success: function (response) {
//                 // Cập nhật giao diện
//                 $('#quantity-' + pet_id).val(response.quantity);
//                 $('#total-price-' + pet_id).text(response.total.toLocaleString() + ' đ');
//                 $('#cart-total').text(response.cartTotal.toLocaleString() + ' đ');
//                 alert('Cập nhật thành công!');
//             },
//             error: function (xhr, status, error) {
//                 alert('Cập nhật không thành công, vui lòng thử lại.');
//             }
//         });
//     });
// });



