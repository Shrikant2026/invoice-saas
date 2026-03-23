import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {

    const messages = [
        "🚀 Manage your clients efficiently",
        "📄 Create and organize invoices easily",
        "💰 Track your earnings seamlessly",
        "⚡ Fast and simple invoice management"
    ];

    let index = 0;
    const banner = document.getElementById("banner-message");

    if (!banner) return; // safety check

    setInterval(() => {
        index = (index + 1) % messages.length;

        banner.style.opacity = 0;

        setTimeout(() => {
            banner.innerText = messages[index];
            banner.style.opacity = 1;
        }, 300);

    }, 3000);

});