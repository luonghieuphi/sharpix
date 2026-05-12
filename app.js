const products = [
    {
        id: 'nova',
        title: 'Nova AI Assistant',
        subtitle: 'AI-powered browser productivity toolkit.',
        icon: '🧠',
        version: 'v2.1.0',
        updated: 'May 2026',
        size: '4.2MB',
        mockup: 'assets/nova_ai_mockup.png',
        features: [
            { icon: '⚡', label: 'Fast' },
            { icon: '🔒', label: 'Secure' },
            { icon: '🧠', label: 'AI Powered' },
            { icon: '☁', label: 'Cloud Sync' }
        ],
        screenshots: ['assets/nova_ai_mockup.png', 'assets/nova_ai_mockup.png', 'assets/nova_ai_mockup.png']
    },
    {
        id: 'productivity',
        title: 'Productivity Tool',
        subtitle: 'Organize your workflow with smart tabs and focus mode.',
        icon: '🚀',
        version: 'v1.5.2',
        updated: 'April 2026',
        size: '2.8MB',
        mockup: 'assets/nova_ai_mockup.png', // Reusing for demo, ideally different
        features: [
            { icon: '📁', label: 'Tab Manager' },
            { icon: '⏱', label: 'Focus Timer' },
            { icon: '📊', label: 'Stats' },
            { icon: '🛠', label: 'Customizable' }
        ],
        screenshots: ['assets/nova_ai_mockup.png', 'assets/nova_ai_mockup.png']
    },
    {
        id: 'security',
        title: 'SafeGuard Pro',
        subtitle: 'Ultimate privacy and security extension.',
        icon: '🛡',
        version: 'v3.0.1',
        updated: 'May 2026',
        size: '5.1MB',
        mockup: 'assets/nova_ai_mockup.png',
        features: [
            { icon: '🕵️', label: 'Anti-Tracker' },
            { icon: '🔐', label: 'Encryption' },
            { icon: '🚫', label: 'Ad-Blocker' },
            { icon: '📡', label: 'VPN Ready' }
        ],
        screenshots: ['assets/nova_ai_mockup.png']
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
                <p>${product.id === 'nova' ? 'AI Productivity' : 'Utility'}</p>
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
