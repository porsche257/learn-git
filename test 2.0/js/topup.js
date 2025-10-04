const gamePackages = {
    freefire: [
        { amount: '50 เพชร', price: 20, discount: null },
        { amount: '100 เพชร', price: 40, discount: '10%' },
        { amount: '310 เพชร', price: 120, discount: '15%' },
        { amount: '520 เพชร', price: 200, discount: '20%' },
        { amount: '1060 เพชร', price: 400, discount: '25%' },
        { amount: '2180 เพชร', price: 800, discount: '30%' }
    ],
    rov: [
        { amount: '90 คูปอง', price: 25, discount: null },
        { amount: '180 คูปอง', price: 50, discount: '10%' },
        { amount: '360 คูปอง', price: 95, discount: '15%' },
        { amount: '720 คูปอง', price: 190, discount: '20%' },
        { amount: '1500 คูปอง', price: 380, discount: '25%' },
        { amount: '3000 คูปอง', price: 750, discount: '30%' }
    ],
    pubg: [
        { amount: '60 UC', price: 30, discount: null },
        { amount: '325 UC', price: 150, discount: '10%' },
        { amount: '660 UC', price: 300, discount: '15%' },
        { amount: '1800 UC', price: 800, discount: '20%' },
        { amount: '3850 UC', price: 1700, discount: '25%' },
        { amount: '8100 UC', price: 3500, discount: '30%' }
    ],
    genshin: [
        { amount: '60 Genesis', price: 35, discount: null },
        { amount: '330 Genesis', price: 180, discount: '10%' },
        { amount: '1090 Genesis', price: 580, discount: '15%' },
        { amount: '2240 Genesis', price: 1150, discount: '20%' },
        { amount: '3880 Genesis', price: 1950, discount: '25%' },
        { amount: '8080 Genesis', price: 3900, discount: '30%' }
    ],
    mobilelegends: [
        { amount: '50 Diamond', price: 20, discount: null },
        { amount: '120 Diamond', price: 45, discount: '10%' },
        { amount: '250 Diamond', price: 90, discount: '15%' },
        { amount: '500 Diamond', price: 180, discount: '20%' },
        { amount: '1000 Diamond', price: 350, discount: '25%' },
        { amount: '2000 Diamond', price: 680, discount: '30%' }
    ],
    ragnarok: [
        { amount: '60 BCC', price: 40, discount: null },
        { amount: '180 BCC', price: 115, discount: '10%' },
        { amount: '360 BCC', price: 225, discount: '15%' },
        { amount: '720 BCC', price: 440, discount: '20%' },
        { amount: '1500 BCC', price: 900, discount: '25%' },
        { amount: '3000 BCC', price: 1750, discount: '30%' }
    ],
    codm: [
        { amount: '80 CP', price: 30, discount: null },
        { amount: '420 CP', price: 150, discount: '10%' },
        { amount: '880 CP', price: 310, discount: '15%' },
        { amount: '1920 CP', price: 650, discount: '20%' },
        { amount: '4000 CP', price: 1300, discount: '25%' },
        { amount: '8400 CP', price: 2600, discount: '30%' }
    ],
    honkai: [
        { amount: '60 Oneiric', price: 35, discount: null },
        { amount: '330 Oneiric', price: 180, discount: '10%' },
        { amount: '1090 Oneiric', price: 580, discount: '15%' },
        { amount: '2240 Oneiric', price: 1150, discount: '20%' },
        { amount: '3880 Oneiric', price: 1950, discount: '25%' },
        { amount: '8080 Oneiric', price: 3900, discount: '30%' }
    ],
    valorant: [
        { amount: '475 VP', price: 50, discount: null },
        { amount: '1000 VP', price: 105, discount: '10%' },
        { amount: '2050 VP', price: 210, discount: '15%' },
        { amount: '3650 VP', price: 370, discount: '20%' },
        { amount: '5350 VP', price: 530, discount: '25%' },
        { amount: '11000 VP', price: 1050, discount: '30%' }
    ],
    lineagem: [
        { amount: '100 Red Diamond', price: 45, discount: null },
        { amount: '300 Red Diamond', price: 130, discount: '10%' },
        { amount: '600 Red Diamond', price: 255, discount: '15%' },
        { amount: '1200 Red Diamond', price: 500, discount: '20%' },
        { amount: '2500 Red Diamond', price: 1000, discount: '25%' },
        { amount: '5000 Red Diamond', price: 1950, discount: '30%' }
    ]
};

let selectedGame = null;
let selectedPackage = null;

// Game card click handler
document.querySelectorAll('.game-select-card').forEach(card => {
    card.addEventListener('click', function() {
        const gameName = this.dataset.game;
        selectGame(gameName);
    });
});

function selectGame(gameName) {
    selectedGame = gameName;
    const gameTitle = document.querySelector(`[data-game="${gameName}"] h3`).textContent;
    
    // Hide games grid, show form
    document.getElementById('gamesGrid').style.display = 'none';
    document.getElementById('topupForm').style.display = 'block';
    
    // Update form title
    document.getElementById('selectedGameTitle').textContent = `เติม ${gameTitle}`;
    document.getElementById('summaryGame').textContent = gameTitle;
    
    // Show server field for specific games
    if (['genshin', 'honkai'].includes(gameName)) {
        document.getElementById('serverGroup').style.display = 'block';
    } else {
        document.getElementById('serverGroup').style.display = 'none';
    }
    
    // Load packages
    loadPackages(gameName);
    
    // Scroll to form
    document.getElementById('topupForm').scrollIntoView({ behavior: 'smooth' });
}

function loadPackages(gameName) {
    const packages = gamePackages[gameName];
    const packageGrid = document.getElementById('packageGrid');
    packageGrid.innerHTML = '';
    
    packages.forEach((pkg, index) => {
        const packageCard = document.createElement('div');
        packageCard.className = 'package-card';
        packageCard.dataset.packageIndex = index;
        packageCard.dataset.amount = pkg.amount;
        packageCard.dataset.price = pkg.price;
        
        packageCard.innerHTML = `
            <div class="package-amount">${pkg.amount}</div>
            <div class="package-price">฿${pkg.price}</div>
            ${pkg.discount ? `<div class="package-discount">-${pkg.discount}</div>` : ''}
        `;
        
        packageCard.addEventListener('click', function() {
            selectPackage(this);
        });
        
        packageGrid.appendChild(packageCard);
    });
}

function selectPackage(packageCard) {
    // Remove previous selection
    document.querySelectorAll('.package-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Add selection
    packageCard.classList.add('selected');
    
    selectedPackage = {
        amount: packageCard.dataset.amount,
        price: parseInt(packageCard.dataset.price)
    };
    
    // Update summary
    document.getElementById('summaryPackage').textContent = selectedPackage.amount;
    document.getElementById('summaryTotal').textContent = `${selectedPackage.price} บาท`;
    
    // Update payment amounts
    document.getElementById('tmAmount').textContent = selectedPackage.price;
    document.getElementById('ppAmount').textContent = selectedPackage.price;
}

function backToGames() {
    document.getElementById('gamesGrid').style.display = 'grid';
    document.getElementById('topupForm').style.display = 'none';
    
    // Reset form
    document.getElementById('orderForm').reset();
    selectedGame = null;
    selectedPackage = null;
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Payment method selection
document.querySelectorAll('input[name="payment"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const method = this.value;
        
        // Show payment details
        document.getElementById('paymentDetails').style.display = 'block';
        
        // Hide all payment details
        document.getElementById('trueMoneyDetails').style.display = 'none';
        document.getElementById('promptPayDetails').style.display = 'none';
        
        // Show selected payment details
        if (method === 'truemoney') {
            document.getElementById('trueMoneyDetails').style.display = 'block';
        } else if (method === 'promptpay') {
            document.getElementById('promptPayDetails').style.display = 'block';
        }
    });
});

// Form submission with REAL PHP integration
document.getElementById('orderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validate selections
    if (!selectedPackage) {
        showError('กรุณาเลือกแพ็กเกจที่ต้องการเติม');
        return;
    }
    
    const paymentMethod = document.querySelector('input[name="payment"]:checked');
    if (!paymentMethod) {
        showError('กรุณาเลือกช่องทางชำระเงิน');
        return;
    }
    
    const uid = document.getElementById('uid').value.trim();
    if (!uid) {
        showError('กรุณากรอก UID/ไอดีเกม');
        return;
    }
    
    const termsCheckbox = document.getElementById('terms');
    if (!termsCheckbox.checked) {
        showError('กรุณายอมรับเงื่อนไขการใช้บริการ');
        return;
    }
    
    // Check if slip is uploaded
    const slipInput = paymentMethod.value === 'truemoney' 
        ? document.getElementById('tmSlip') 
        : document.getElementById('ppSlip');
    
    if (!slipInput.files || slipInput.files.length === 0) {
        showError('กรุณาแนบสลิปการโอนเงิน');
        return;
    }
    
    // Create FormData
    const formData = new FormData(this);
    formData.append('game', selectedGame);
    formData.append('package', selectedPackage.amount);
    formData.append('price', selectedPackage.price);
    
    // Show loading
    const submitBtn = this.querySelector('.btn-submit');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    
    submitBtn.disabled = true;
    btnText.style.display = 'none';
    btnLoading.style.display = 'flex';
    
    // Send to PHP
    fetch('process_order.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        submitBtn.disabled = false;
        btnText.style.display = 'block';
        btnLoading.style.display = 'none';
        
        if (data.success) {
            showSuccessModal(data.order_id, {
                game: selectedGame,
                package: selectedPackage.amount,
                price: selectedPackage.price
            });
            
            // Reset form after 2 seconds
            setTimeout(() => {
                this.reset();
                backToGames();
            }, 2000);
        } else {
            showError(data.message || 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
        }
    })
    .catch(error => {
        submitBtn.disabled = false;
        btnText.style.display = 'block';
        btnLoading.style.display = 'none';
        
        console.error('Error:', error);
        showError('ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้ กรุณาตรวจสอบว่าไฟล์ process_order.php มีอยู่หรือไม่');
    });
});

function showSuccessModal(orderId, orderData) {
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        animation: fadeIn 0.3s ease;
        padding: 20px;
    `;
    
    const gameNames = {
        freefire: 'Free Fire',
        rov: 'ROV',
        pubg: 'PUBG Mobile',
        genshin: 'Genshin Impact',
        mobilelegends: 'Mobile Legends',
        ragnarok: 'Ragnarok M',
        codm: 'Call of Duty Mobile',
        honkai: 'Honkai Star Rail',
        valorant: 'Valorant',
        lineagem: 'Lineage M'
    };
    
    modal.innerHTML = `
        <div style="
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #8b5cf6 100%);
            padding: 3rem;
            border-radius: 25px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            animation: slideIn 0.5s ease;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        ">
            <div style="font-size: 5rem; margin-bottom: 1rem; animation: bounce 0.6s ease;">✅</div>
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: #fff;">ส่งคำสั่งซื้อสำเร็จ!</h2>
            
            <div style="
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                padding: 2rem;
                border-radius: 20px;
                margin: 2rem 0;
                text-align: left;
                border: 2px solid rgba(255, 255, 255, 0.2);
            ">
                <p style="font-size: 1.1rem; margin-bottom: 1rem; text-align: center;">
                    หมายเลขออเดอร์ของคุณ
                </p>
                <p style="
                    font-size: 2rem;
                    font-weight: bold;
                    color: #10b981;
                    text-align: center;
                    background: rgba(16, 185, 129, 0.2);
                    padding: 1rem;
                    border-radius: 15px;
                    margin-bottom: 1.5rem;
                    letter-spacing: 2px;
                ">${orderId}</p>
                
                <div style="display: grid; gap: 0.8rem;">
                    <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                        <span style="opacity: 0.8;">เกม:</span>
                        <strong>${gameNames[orderData.game] || orderData.game}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                        <span style="opacity: 0.8;">แพ็กเกจ:</span>
                        <strong>${orderData.package}</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                        <span style="opacity: 0.8;">ยอดชำระ:</span>
                        <strong style="color: #10b981; font-size: 1.3rem;">${orderData.price} บาท</strong>
                    </div>
                </div>
            </div>
            
            <div style="
                background: rgba(59, 130, 246, 0.2);
                padding: 1.5rem;
                border-radius: 15px;
                margin-bottom: 2rem;
                border: 1px solid rgba(59, 130, 246, 0.3);
            ">
                <p style="font-size: 1.1rem; line-height: 1.8; margin: 0;">
                    <strong>⏱️ ระบบกำลังตรวจสอบการชำระเงิน</strong><br>
                    คุณจะได้รับไอเทมภายใน <strong style="color: #10b981;">5-30 นาที</strong><br>
                    <span style="font-size: 0.95rem; opacity: 0.9;">กรุณาเก็บหมายเลขออเดอร์ไว้เพื่อตรวจสอบสถานะ</span>
                </p>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button onclick="this.parentElement.parentElement.parentElement.remove()" style="
                    flex: 1;
                    background: rgba(255, 255, 255, 0.2);
                    color: #fff;
                    border: 2px solid rgba(255, 255, 255, 0.3);
                    padding: 1rem 2rem;
                    border-radius: 15px;
                    font-size: 1.1rem;
                    font-weight: bold;
                    cursor: pointer;
                    transition: all 0.3s;
                " onmouseover="this.style.background='rgba(255, 255, 255, 0.3)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.2)'">
                    ปิด
                </button>
                <button onclick="window.location.href='topup.html#order-status'" style="
                    flex: 1;
                    background: linear-gradient(135deg, #10b981, #059669);
                    color: #fff;
                    border: none;
                    padding: 1rem 2rem;
                    border-radius: 15px;
                    font-size: 1.1rem;
                    font-weight: bold;
                    cursor: pointer;
                    transition: all 0.3s;
                    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
                " onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 40px rgba(16, 185, 129, 0.6)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(16, 185, 129, 0.4)'">
                    ตรวจสอบสถานะ
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Auto close after 10 seconds
    setTimeout(() => {
        if (modal.parentElement) {
            modal.remove();
        }
    }, 10000);
    
    // Play success sound (if available)
    try {
        const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBSuBzvLZiTYHGGe37eejUBELTqXh8LJnHgU7k9nyzn0xBSp+zPDajz4IFmS58OihUREKTKPf8bVrIAU/ltrzxXYpBSl+zPDajz4IFmS58OihUREKTKPf8bVrIAU/ltrzxXYpBSl+zPDajz4IFmS58OihUREKTKPf8bVrIAU/ltrzxXYpBSl+zPDajz4IFmS58OihUREKTKPf8bVrIAU/ltrzxXYpBSl+zPDajz4IFmS58OihUREKTKPf8bVrIAU/ltrzxXYpBSl+zPDajz4IFmS58OihUREKTKPf8bVrIAU/ltrzxXYpBSl+zPDajz4IFmS58OihUREKTKPf8bVrIAU/ltrzxXYpBSl+zPDajz4IFmS58OihUREKTKPf8bVrIAU/ltrzxXYpBQ==');
        audio.volume = 0.3;
        audio.play().catch(() => {});
    } catch(e) {}
}

function showError(message) {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #fff;
        padding: 1.2rem 1.8rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(239, 68, 68, 0.5);
        z-index: 9999;
        animation: slideInRight 0.5s ease;
        max-width: 350px;
        font-size: 1.05rem;
        border: 2px solid rgba(255, 255, 255, 0.2);
    `;
    toast.innerHTML = `<strong>❌ ${message}</strong>`;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOutRight 0.5s ease';
        setTimeout(() => toast.remove(), 500);
    }, 4000);
}

// Add animations
const animStyle = document.createElement('style');
animStyle.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
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
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(animStyle);

// Check order status - REAL PHP integration
function checkOrderStatus() {
    const orderId = document.getElementById('orderIdCheck').value.trim();
    const statusResult = document.getElementById('statusResult');
    
    if (!orderId) {
        statusResult.innerHTML = '<p style="color: #ef4444;">กรุณากรอกหมายเลขออเดอร์</p>';
        return;
    }
    
    statusResult.innerHTML = '<p>กำลังตรวจสอบ...</p>';
    
    // Call PHP to check real order status
    fetch('check_order.php?order_id=' + encodeURIComponent(orderId))
        .then(response => response.json())
        .then(data => {
            if (data.success && data.order) {
                const order = data.order;
                const statusColors = {
                    'pending': '#f59e0b',
                    'processing': '#3b82f6',
                    'completed': '#10b981',
                    'cancelled': '#ef4444'
                };
                const statusTexts = {
                    'pending': 'รอดำเนินการ',
                    'processing': 'กำลังดำเนินการ',
                    'completed': 'เติมสำเร็จ',
                    'cancelled': 'ยกเลิก'
                };
                
                const statusColor = statusColors[order.status] || '#f59e0b';
                const statusText = statusTexts[order.status] || order.status;
                
                statusResult.innerHTML = `
                    <div style="padding: 1.5rem;">
                        <p style="font-size: 1.2rem; margin-bottom: 0.5rem;">หมายเลขออเดอร์: <strong>${orderId}</strong></p>
                        <p style="font-size: 1.5rem; color: ${statusColor}; font-weight: bold; margin-bottom: 1rem;">สถานะ: ${statusText}</p>
                        <div style="text-align: left; background: rgba(255, 255, 255, 0.1); padding: 1rem; border-radius: 10px;">
                            <p><strong>เกม:</strong> ${order.game_name}</p>
                            <p><strong>แพ็กเกจ:</strong> ${order.package_name}</p>
                            <p><strong>ราคา:</strong> ${order.price} บาท</p>
                            <p><strong>วันที่สั่ง:</strong> ${new Date(order.created_at).toLocaleString('th-TH')}</p>
                        </div>
                        ${order.status === 'completed' ? '<p style="margin-top: 1rem; color: #10b981;">✓ ไอเทมได้ถูกส่งไปยังบัญชีของคุณแล้ว</p>' : ''}
                        ${order.status === 'pending' ? '<p style="margin-top: 1rem; color: #f59e0b;">⏳ กรุณารอระบบตรวจสอบการชำระเงิน</p>' : ''}
                    </div>
                `;
            } else {
                statusResult.innerHTML = `
                    <p style="color: #ef4444;">❌ ไม่พบหมายเลขออเดอร์นี้</p>
                    <p style="font-size: 0.9rem; opacity: 0.8;">กรุณาตรวจสอบหมายเลขออเดอร์อีกครั้ง</p>
                `;
            }
        })
        .catch(error => {
            statusResult.innerHTML = '<p style="color: #ef4444;">เกิดข้อผิดพลาดในการตรวจสอบ</p>';
            console.error('Error:', error);
        });
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
`;
document.head.appendChild(style);now();
    
    // Show success message
    const modal = createSuccessModal(orderId);
    document.body.appendChild(modal);
    
    // Reset form after 3 seconds
    setTimeout(() => {
        modal.remove();
        backToGames();
    }, 5000);

function createSuccessModal(orderId) {
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
            <h2 style="font-size: 2rem; margin-bottom: 1rem;">ส่งคำสั่งซื้อสำเร็จ!</h2>
            <p style="font-size: 1.2rem; margin-bottom: 1.5rem; opacity: 0.9;">
                หมายเลขออเดอร์ของคุณคือ<br>
                <strong style="color: #10b981; font-size: 1.5rem;">${orderId}</strong>
            </p>
            <p style="opacity: 0.8;">
                กรุณารอสักครู่ ระบบกำลังตรวจสอบการชำระเงิน<br>
                จะได้รับไอเทมภายใน 5-30 นาที
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
    
    return modal;
}

// Check order status
function checkOrderStatus() {
    const orderId = document.getElementById('orderIdCheck').value.trim();
    const statusResult = document.getElementById('statusResult');
    
    if (!orderId) {
        statusResult.innerHTML = '<p style="color: #ef4444;">กรุณากรอกหมายเลขออเดอร์</p>';
        return;
    }
    
    // Simulate API call
    statusResult.innerHTML = '<p>กำลังตรวจสอบ...</p>';
    
    setTimeout(() => {
        const statuses = ['รอการชำระเงิน', 'กำลังตรวจสอบ', 'เติมสำเร็จ', 'ยกเลิก'];
        const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];
        
        let statusColor = '#f59e0b';
        if (randomStatus === 'เติมสำเร็จ') statusColor = '#10b981';
        if (randomStatus === 'ยกเลิก') statusColor = '#ef4444';
        
        statusResult.innerHTML = `
            <div style="padding: 1.5rem;">
                <p style="font-size: 1.2rem; margin-bottom: 0.5rem;">หมายเลขออเดอร์: <strong>${orderId}</strong></p>
                <p style="font-size: 1.5rem; color: ${statusColor}; font-weight: bold;">สถานะ: ${randomStatus}</p>
                ${randomStatus === 'เติมสำเร็จ' ? '<p style="margin-top: 1rem; color: #10b981;">✓ ไอเทมได้ถูกส่งไปยังบัญชีของคุณแล้ว</p>' : ''}
            </div>
        `;
    }, 1500);
}