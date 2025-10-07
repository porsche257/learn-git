document.addEventListener("DOMContentLoaded", () => {
    const qrDisplay = document.getElementById("qrDisplay");
    const qrImage = document.getElementById("qrImage");
    const qrText = document.getElementById("qrText");
    const payments = document.querySelectorAll("input[name='payment']");

    payments.forEach((radio) => {
        radio.addEventListener("change", () => {
            qrDisplay.style.opacity = "1";
            qrDisplay.style.transform = "translateY(0)";
            qrImage.style.display = "block"; // แสดงภาพ

            if (radio.value === "truemoney") {
                qrImage.src = "im/true.jpg";
                qrText.textContent = "สแกนเพื่อชำระด้วย TrueMoney Wallet";
            } else if (radio.value === "promptpay") {
                qrImage.src = "im/promtpay.jpg";
                qrText.textContent = "สแกนเพื่อชำระด้วย PromptPay";
            }
        });
    });
});
