// -------------------------------
// DATA
// -------------------------------
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
    ]
    // เพิ่มเกมอื่น ๆ ตามต้องการ
};

let selectedGame = null;
let selectedPackage = null;

// -------------------------------
// SELECT GAME
// -------------------------------
document.querySelectorAll('.game-select-card').forEach(card => {
    card.addEventListener('click', function() {
        const gameName = this.dataset.game;
        selectGame(gameName);
    });
});

function selectGame(gameName) {
    selectedGame = gameName;
    const gameTitle = document.querySelector(`[data-game="${gameName}"] h3`).textContent;

    document.getElementById('gamesGrid').style.display = 'none';
    document.getElementById('topupForm').style.display = 'block';

    document.getElementById('selectedGameTitle').textContent = `เติม ${gameTitle}`;
    document.getElementById('summaryGame').textContent = gameTitle;

    // แสดง field server สำหรับบางเกม
    document.getElementById('serverGroup').style.display = ['genshin', 'honkai'].includes(gameName) ? 'block' : 'none';

    loadPackages(gameName);

    document.getElementById('topupForm').scrollIntoView({ behavior: 'smooth' });
}

// -------------------------------
// LOAD PACKAGES
// -------------------------------
function loadPackages(gameName) {
    const packages = gamePackages[gameName] || [];
    const packageGrid = document.getElementById('packageGrid');
    packageGrid.innerHTML = '';

    packages.forEach((pkg, index) => {
        const card = document.createElement('div');
        card.className = 'package-card';
        card.dataset.index = index;
        card.dataset.amount = pkg.amount;
        card.dataset.price = pkg.price;

        card.innerHTML = `
            <div class="package-amount">${pkg.amount}</div>
            <div class="package-price">฿${pkg.price}</div>
            ${pkg.discount ? `<div class="package-discount">-${pkg.discount}</div>` : ''}
        `;

        card.addEventListener('click', () => selectPackage(card));
        packageGrid.appendChild(card);
    });
}

// -------------------------------
// SELECT PACKAGE
// -------------------------------
function selectPackage(card) {
    document.querySelectorAll('.package-card').forEach(c => c.classList.remove('selected'));
    card.classList.add('selected');

    selectedPackage = {
        amount: card.dataset.amount,
        price: parseInt(card.dataset.price)
    };

    document.getElementById('summaryPackage').textContent = selectedPackage.amount;
    document.getElementById('summaryTotal').textContent = `${selectedPackage.price} บาท`;

    document.getElementById('tmAmount').textContent = selectedPackage.price;
    document.getElementById('ppAmount').textContent = selectedPackage.price;
}

// -------------------------------
// BACK TO GAMES
// -------------------------------
function backToGames() {
    document.getElementById('gamesGrid').style.display = 'grid';
    document.getElementById('topupForm').style.display = 'none';

    document.getElementById('orderForm').reset();
    selectedGame = null;
    selectedPackage = null;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// -------------------------------
// PAYMENT METHOD
// -------------------------------
document.querySelectorAll('input[name="payment"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('paymentDetails').style.display = 'block';
        document.getElementById('trueMoneyDetails').style.display = this.value === 'truemoney' ? 'block' : 'none';
        document.getElementById('promptPayDetails').style.display = this.value === 'promptpay' ? 'block' : 'none';
    });
});

// -------------------------------
// SHOW ERROR
// -------------------------------
function showError(msg) {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: #ef4444;
        color: #fff;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        z-index: 9999;
    `;
    toast.innerHTML = `<strong>❌ ${msg}</strong>`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

// -------------------------------
// SHOW SUCCESS MODAL
// -------------------------------
function showSuccessModal(orderId, orderData) {
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed; top:0; left:0; width:100%; height:100%;
        background: rgba(0,0,0,0.8); display:flex; justify-content:center; align-items:center; z-index:10000;
    `;
    modal.innerHTML = `
        <div style="background:#1e3a8a; color:#fff; padding:2rem; border-radius:20px; text-align:center; max-width:500px;">
            <h2>✅ ส่งคำสั่งซื้อสำเร็จ!</h2>
            <p>หมายเลขออเดอร์: <strong>${orderId}</strong></p>
            <p>เกม: ${orderData.game}<br>แพ็กเกจ: ${orderData.package}<br>ราคา: ${orderData.price} บาท</p>
            <button style="margin-top:1rem;padding:0.5rem 1rem;" onclick="this.parentElement.parentElement.remove()">ปิด</button>
        </div>
    `;
    document.body.appendChild(modal);
}

// -------------------------------
// SUBMIT FORM
// -------------------------------
document.getElementById('orderForm').addEventListener('submit', function(e) {
    e.preventDefault();

    if (!selectedPackage) { showError('กรุณาเลือกแพ็กเกจ'); return; }
    const paymentMethod = document.querySelector('input[name="payment"]:checked');
    if (!paymentMethod) { showError('กรุณาเลือกช่องทางชำระเงิน'); return; }

    const uid = document.getElementById('uid').value.trim();
    if (!uid) { showError('กรุณากรอก UID/ไอดีเกม'); return; }

    const slipInput = paymentMethod.value === 'truemoney' ? document.getElementById('tmSlip') : document.getElementById('ppSlip');
    if (!slipInput.files.length) { showError('กรุณาแนบสลิป'); return; }

    const submitBtn = this.querySelector('.btn-submit');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    submitBtn.disabled = true;
    btnText.style.display = 'none';
    btnLoading.style.display = 'flex';

    const formData = new FormData(this);
    formData.append('game', selectedGame);
    formData.append('package', selectedPackage.amount);
    formData.append('price', selectedPackage.price);

    fetch('process_order.php', { method: 'POST', body: formData })
    .then(res => res.json())
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
            setTimeout(() => { this.reset(); backToGames(); }, 2000);
        } else {
            showError(data.message || 'เกิดข้อผิดพลาด กรุณาลองใหม่');
        }
    })
    .catch(err => {
        submitBtn.disabled = false;
        btnText.style.display = 'block';
        btnLoading.style.display = 'none';
        console.error(err);
        showError('ไม่สามารถเชื่อมต่อเซิร์ฟเวอร์ได้');
    });
});
