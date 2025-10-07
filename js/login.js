// Tab Switching (สลับระหว่าง Login กับ Register)
const tabButtons = document.querySelectorAll('.tab-btn');
const formContents = document.querySelectorAll('.form-content');

tabButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        const targetTab = this.dataset.tab;
        
        // ลบ class 'active' จากทุก tab และ form
        tabButtons.forEach(b => b.classList.remove('active'));
        formContents.forEach(f => f.classList.remove('active'));
        
        // เพิ่ม class 'active' ให้ tab และ form ที่ถูกคลิก
        this.classList.add('active');
        document.getElementById(targetTab + 'Form').classList.add('active');
    });
});

// Toggle Password Visibility (สำหรับ input password)
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const toggleBtn = input.nextElementSibling;
    
    if (input.type === 'password') {
        input.type = 'text';
        toggleBtn.textContent = '👁️‍🗨️';
    } else {
        input.type = 'password';
        toggleBtn.textContent = '👁️';
    }
}
