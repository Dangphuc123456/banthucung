
    // Lắng nghe sự kiện thay đổi phương thức thanh toán
    const paymentSelect = document.getElementById('payment');
    const creditCardForm = document.getElementById('credit-card-form');

    paymentSelect.addEventListener('change', () => {
        if (paymentSelect.value === 'credit') {
            creditCardForm.classList.remove('hidden'); // Hiển thị form thanh toán
        } else {
            creditCardForm.classList.add('hidden'); // Ẩn form thanh toán
        }
    });
