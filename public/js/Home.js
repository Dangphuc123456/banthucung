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


//cuộn trang
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
  
 

//   // Kiểm tra nếu có thông báo thành công
//   window.onload = function() {
//     var successMessage = document.getElementById('successMessage');
    
//     // Nếu có thông báo, hiển thị và ẩn sau 1 giây
//     if (successMessage) {
//         successMessage.style.display = 'block'; // Hiển thị thông báo
//         setTimeout(function() {
//             successMessage.style.opacity = 0; // Dần dần ẩn thông báo
//             setTimeout(function() {
//                 successMessage.style.display = 'none'; // Ẩn hoàn toàn sau khi hiệu ứng kết thúc
//             }, 1000); // Thời gian chờ sau khi ẩn
//         }, 1000); // Hiển thị thông báo trong 1 giây
//     }
// }

setTimeout(function() {
    let alert = document.getElementById('success-alert');
    if (alert) {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = 0;
        setTimeout(() => alert.remove(), 500); // Xóa hoàn toàn sau 0.5 giây
    }
}, 3000); // Thời gian chờ 3 giây trước khi ẩn
