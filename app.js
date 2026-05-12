const products = [
    {
        id: 'image-ai',
        title: 'Render Kiến Trúc',
        subtitle: 'Render ảnh kiến trúc 3D siêu thực với trí tuệ nhân tạo.',
        icon: '🏠',
        version: 'v1.0.0',
        updated: 'May 2026',
        size: '134 KB',
        mockup: 'assets/sharpix_image_mockup.png',
        features: [
            { icon: '🏠', label: 'Render Ngoại Thất' },
            { icon: '🛋️', label: 'Render Nội Thất' },
            { icon: '🏗️', label: 'Quy Hoạch' },
            { icon: '📷', label: 'Góc Camera' }
        ],
        screenshots: ['assets/sharpix_image_mockup.png'],
        downloadLink: 'downloads/tool_anh_kientruc.rar'
    },
    {
        id: 'video-ai',
        title: 'Video AI Kiến Trúc',
        subtitle: 'Tạo video diễn họa kiến trúc từ ảnh chụp hoặc bản vẽ.',
        icon: '🎬',
        version: 'v1.0.0',
        updated: 'May 2026',
        size: '159 KB',
        mockup: 'assets/sharpix_video_mockup.png',
        features: [
            { icon: '🎥', label: 'Video Cinematic' },
            { icon: '🌪️', label: 'Hiệu Ứng Động' },
            { icon: '🎵', label: 'Chèn Nhạc AI' },
            { icon: '✨', label: 'Chất Lượng 4K' }
        ],
        screenshots: ['assets/sharpix_video_mockup.png'],
        downloadLink: 'downloads/tool_video_kientruc.rar'
    },
    {
        id: 'restore-ai',
        title: 'Phục Chế Ảnh',
        subtitle: 'Phục chế và nâng cấp chất lượng ảnh kiến trúc cũ, mờ.',
        icon: '✨',
        version: 'v1.0.0',
        updated: 'May 2026',
        size: '149 KB',
        mockup: 'assets/sharpix_restore_mockup.png',
        features: [
            { icon: '🖼️', label: 'Nâng Cấp Độ Phân Giải' },
            { icon: '🎨', label: 'Khử Nhiễu Ảnh' },
            { icon: '🌈', label: 'Phục Hồi Màu Sắc' },
            { icon: '📐', label: 'Làm Nét Chi Tiết' }
        ],
        screenshots: ['assets/sharpix_restore_mockup.png'],
        downloadLink: 'downloads/phucche.rar'
    }
];

function init() {
    const productList = document.getElementById('productList');
    const previewPanel = document.getElementById('previewPanel');

    // Render product list
    products.forEach((product, index) => {
        const card = document.createElement('div');
        card.className = `product-card ${index === 0 ? 'active' : ''}`;
        card.innerHTML = `
            <div class="card-icon">${product.icon}</div>
            <div class="card-info">
                <h4>${product.title}</h4>
            </div>
            <div class="card-version">${product.version}</div>
        `;
        card.onclick = () => selectProduct(product, card);
        productList.appendChild(card);
    });

    // Initial load
    selectProduct(products[0], productList.firstChild);

    // Spotlight effect for cards
    document.addEventListener('mousemove', (e) => {
        const cards = document.querySelectorAll('.product-card, .feature-card');
        cards.forEach(card => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
}

function selectProduct(product, cardElement) {
    // Update active state in sidebar
    document.querySelectorAll('.product-card').forEach(c => c.classList.remove('active'));
    cardElement.classList.add('active');

    // Update preview panel with animation
    const content = document.querySelector('.preview-content');
    content.classList.remove('fade-in');
    void content.offsetWidth; // Trigger reflow
    content.classList.add('fade-in');

    document.getElementById('productTitle').textContent = product.title;
    document.getElementById('productSubtitle').textContent = product.subtitle;
    document.getElementById('mainMockup').src = product.mockup;
    document.getElementById('ver').textContent = product.version;
    document.getElementById('updated').textContent = product.updated;
    document.getElementById('size').textContent = product.size;

    const ctaBtn = document.querySelector('.cta-button');
    if (ctaBtn && product.downloadLink) {
        ctaBtn.href = product.downloadLink;
    }

    // Update features
    const featuresGrid = document.querySelector('.features-grid');
    featuresGrid.innerHTML = product.features.map(f => `
        <div class="feature-card">
            <span class="feature-icon">${f.icon}</span>
            <span class="feature-label">${f.label}</span>
        </div>
    `).join('');

    // Update screenshots
    const strip = document.getElementById('screenshotStrip');
    strip.innerHTML = product.screenshots.map((s, i) => `
        <div class="thumb ${i === 0 ? 'active' : ''}" onclick="changeMockup('${s}', this)">
            <img src="${s}" alt="Screenshot">
        </div>
    `).join('');
}

function changeMockup(src, thumbElement) {
    const mainMockup = document.getElementById('mainMockup');
    mainMockup.style.opacity = '0';

    setTimeout(() => {
        mainMockup.src = src;
        mainMockup.style.opacity = '1';

        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        thumbElement.classList.add('active');
    }, 300);
}

// Initialize on load
window.onload = init;
