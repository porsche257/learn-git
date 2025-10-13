document.addEventListener("DOMContentLoaded", () => {
    const payments = document.querySelectorAll("input[name='payment']");
    const qrImage = document.getElementById("qrImage");
    const qrText = document.getElementById("qrText");

    payments.forEach(radio => {
        radio.addEventListener("change", () => {
            if (radio.value === "truemoney") {
                qrImage.src = "im/true.jpg";
                qrImage.style.display = "block";
                qrText.textContent = "สแกนเพื่อชำระผ่าน TrueMoney Wallet";
            } else if (radio.value === "promptpay") {
                qrImage.src = "im/promptpay.jpg";
                qrImage.style.display = "block";
                qrText.textContent = "สแกนเพื่อชำระผ่าน PromptPay";
            }
        });
    });
});
