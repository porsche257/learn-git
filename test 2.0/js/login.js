// Tab Switching
const tabButtons = document.querySelectorAll('.tab-btn');
const formContents = document.querySelectorAll('.form-content');

tabButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        const targetTab = this.dataset.tab;
        
        // Remove active class from all tabs
        tabButtons.forEach(b => b.classList.remove('active'));
        formContents.forEach(f => f.classList.remove('active'));
        
        // Add active class to clicked tab
        this.classList.add('active');
        document.getElementById(targetTab + 'Form').classList.add('active');
    });
});

// Toggle Password Visibility
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

// Login Form Submission
const loginForm = document.querySelector('#loginForm form');
if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;
        const remember = document.getElementById('remember').checked;
        
        // Show loading
        const submitBtn = this.querySelector('.btn-auth');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'กำลังเข้าสู่ระบบ...';
        submitBtn.disabled = true;
        
        // Simulate login
        setTimeout(() => {
            showLoginSuccess(email);
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 1500);
    });
}

// Register Form Submission
const registerForm = document.querySelector('#registerForm form');
if (registerForm) {
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('register-name').value;
        const password = document.getElementById('register-password').value;
        const confirmPassword = document.getElementById('register-confirm-password').value;
        
        // Validate password match
        if (password !== confirmPassword) {
            showError('รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง');
            return;
        }
        
        // Validate password strength
        if (password.length < 8) {
            showError('รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร');
            return;
        }
        
        // Show loading
        const submitBtn = this.querySelector('.btn-auth');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'กำลังสมัครสมาชิก...';
        submitBtn.disabled = true;
        
        // Simulate registration
        setTimeout(() => {
            showRegisterSuccess(name);
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 1500);
    });
}

// Social Login Buttons
document.querySelectorAll('.social-login-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const platform = this.classList.contains('google') ? 'Google' : 
                        this.classList.contains('facebook') ? 'Facebook' : 'Line';
        
        showInfo(`กำลังเชื่อมต่อกับ ${platform}...`);
    });
});

// Show Login Success
function showLoginSuccess(email) {
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        animation: fadeIn 0.3s ease;
    `;
    
    modal.innerHTML = `
        <div style="
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem;
            border-radius: 25px;
            text-align: center;
            max-width: 500px;
            animation: slideIn 0.5s ease;
        ">
            <div style="font-size: 5rem; margin-bottom: 1rem;">✅</div>
            <h2 style="font-size: 2rem; margin-bottom: 1rem;">เข้าสู่ระบบสำเร็จ!</h2>
            <p style="font-size: 1.2rem; margin-bottom: 1.5rem; opacity: 0.9;">
                ยินดีต้อนรับ<br>
                <strong style="color: #10b981;">${email}</strong>
            </p>
            <p style="opacity: 0.8;">
                กำลังนำคุณไปยังหน้าหลัก...
            </p>
            <button onclick="this.parentElement.parentElement.remove(); window.location.href='index.html'" style="
                margin-top: 2rem;
                background: #10b981;
                color: #fff;
                border: none;
                padding: 0.8rem 2rem;
                border-radius: 15px;
                font-size: 1.1rem;
                font-weight: bold;
                cursor: pointer;
            ">ไปหน้าหลัก</button>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Auto redirect after 3 seconds
    setTimeout(() => {
        modal.remove();
        window.location.href = 'index.html';
    }, 3000);
}

// Show Register Success
function showRegisterSuccess(name) {
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        animation: fadeIn 0.3s ease;
    `;
    
    modal.innerHTML = `
        <div style="
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem;
            border-radius: 25px;
            text-align: center;
            max-width: 500px;
            animation: slideIn 0.5s ease;
        ">
            <div style="font-size: 5rem; margin-bottom: 1rem;">🎉</div>
            <h2 style="font-size: 2rem; margin-bottom: 1rem;">สมัครสมาชิกสำเร็จ!</h2>
            <p style="font-size: 1.2rem; margin-bottom: 1.5rem; opacity: 0.9;">
                ยินดีต้อนรับ <strong style="color: #10b981;">${name}</strong><br>
                คุณได้เป็นสมาชิกแล้ว
            </p>
            <div style="background: rgba(16, 185, 129, 0.2); padding: 1rem; border-radius: 15px; margin-bottom: 1rem;">
                <p style="font-size: 1.1rem; font-weight: bold; color: #10b981;">
                    🎁 รับส่วนลด 15% ทันที!
                </p>
                <p style="opacity: 0.9;">สำหรับการเติมครั้งแรก</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove(); window.location.href='topup.html'" style="
                margin-top: 1rem;
                background: #10b981;
                color: #fff;
                border: none;
                padding: 0.8rem 2rem;
                border-radius: 15px;
                font-size: 1.1rem;
                font-weight: bold;
                cursor: pointer;
            ">เริ่มเติมเกมเลย</button>
        </div>
    `;
    
    document.body.appendChild(modal);
}

// Show Error Message
function showError(message) {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #fff;
        padding: 1rem 1.5rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(239, 68, 68, 0.4);
        z-index: 9999;
        animation: slideInRight 0.5s ease;
        max-width: 300px;
    `;
    toast.textContent = '❌ ' + message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Show Info Message
function showInfo(message) {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        padding: 1rem 1.5rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        z-index: 9999;
        animation: slideInRight 0.5s ease;
        max-width: 300px;
    `;
    toast.textContent = 'ℹ️ ' + message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Add animation styles
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);