// Category filter functionality
const categoryButtons = document.querySelectorAll('.category-btn');
const newsCards = document.querySelectorAll('.news-card');
const featuredCards = document.querySelectorAll('.featured-news-card');

categoryButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove active class from all buttons
        categoryButtons.forEach(b => b.classList.remove('active'));
        
        // Add active class to clicked button
        this.classList.add('active');
        
        const category = this.dataset.category;
        
        // Filter news cards
        filterCards(newsCards, category);
        filterCards(featuredCards, category);
    });
});

function filterCards(cards, category) {
    cards.forEach(card => {
        if (category === 'all') {
            card.classList.remove('hidden');
            card.style.display = '';
        } else {
            if (card.dataset.category === category) {
                card.classList.remove('hidden');
                card.style.display = '';
            } else {
                card.classList.add('hidden');
            }
        }
    });
}

// Load more functionality
const loadMoreBtn = document.querySelector('.btn-load-more');
let newsToShow = 9;

if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', function() {
        // Simulate loading more news
        this.textContent = 'กำลังโหลด...';
        
        setTimeout(() => {
            this.textContent = 'โหลดข่าวเพิ่มเติม';
            
            // Show success message
            const message = document.createElement('div');
            message.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                background: linear-gradient(135deg, #10b981, #059669);
                color: #fff;
                padding: 1rem 2rem;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
                z-index: 9999;
                animation: slideInRight 0.5s ease;
            `;
            message.textContent = '✓ โหลดข่าวเพิ่มเติมเรียบร้อย';
            document.body.appendChild(message);
            
            setTimeout(() => {
                message.remove();
            }, 3000);
        }, 1000);
    });
}

// Smooth scroll for featured news container
const featuredContainer = document.querySelector('.featured-news-container');
let isDown = false;
let startX;
let scrollLeft;

if (featuredContainer) {
    featuredContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        featuredContainer.style.cursor = 'grabbing';
        startX = e.pageX - featuredContainer.offsetLeft;
        scrollLeft = featuredContainer.scrollLeft;
    });

    featuredContainer.addEventListener('mouseleave', () => {
        isDown = false;
        featuredContainer.style.cursor = 'grab';
    });

    featuredContainer.addEventListener('mouseup', () => {
        isDown = false;
        featuredContainer.style.cursor = 'grab';
    });

    featuredContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - featuredContainer.offsetLeft;
        const walk = (x - startX) * 2;
        featuredContainer.scrollLeft = scrollLeft - walk;
    });
}

// Add CSS for slide in animation
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
document.head.appendChild(style);