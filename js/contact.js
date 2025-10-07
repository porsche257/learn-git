// FAQ Toggle
const faqCards = document.querySelectorAll('.faq-card');

faqCards.forEach(card => {
    const question = card.querySelector('.faq-question');
    
    question.addEventListener('click', () => {
        // Close all other FAQs
        faqCards.forEach(otherCard => {
            if (otherCard !== card) {
                otherCard.classList.remove('active');
            }
        });
        
        // Toggle current FAQ
        card.classList.toggle('active');
    });
});

// Contact Form Submission
const contactForm = document.getElementById('contactForm');

if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const name = formData.get('name');
        
        // Show loading
        const submitBtn = this.querySelector('.btn-submit-contact');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'กำลังส่ง...';
        submitBtn.disabled = true;
        
        // Simulate form submission
        setTimeout(() => {
            // Show success modal
            showSuccessModal(name);
            
            // Reset form
            this.reset();
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 1500);
    });
}

function showSuccessModal(name) {
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
            <div style="font-size: 5rem; margin-bottom: 1rem;">✉️</div>
            <h2 style="font-size: 2rem; margin-bottom: 1rem;">ส่งข้อความสำเร็จ!</h2>
            <p style="font-size: 1.2rem; margin-bottom: 1.5rem; opacity: 0.9;">
                ขอบคุณคุณ <strong>${name}</strong><br>
                ที่ติดต่อเรา
            </p>
            <p style="opacity: 0.8;">
                ทีมงานจะติดต่อกลับภายใน 24 ชั่วโมง<br>
                โปรดตรวจสอบอีเมลของคุณ
            </p>
            <button onclick="this.parentElement.parentElement.remove()" style="
                margin-top: 2rem;
                background: #10b981;
                color: #fff;
                border: none;
                padding: 0.8rem 2rem;
                border-radius: 15px;
                font-size: 1.1rem;
                font-weight: bold;
                cursor: pointer;
            ">ตกลง</button>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Auto close after 5 seconds
    setTimeout(() => {
        modal.remove();
    }, 5000);
}