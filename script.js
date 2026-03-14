/* ============================================================
   VIETCHARM TIN TỨC – JavaScript
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

    // ── Mobile Menu Toggle ──
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const nav = document.getElementById('nav');

    if (mobileMenuBtn && nav) {
        mobileMenuBtn.addEventListener('click', () => {
            nav.classList.toggle('open');
            mobileMenuBtn.classList.toggle('open');
        });

        // Close menu when clicking a link
        nav.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                nav.classList.remove('open');
                mobileMenuBtn.classList.remove('open');
            });
        });
    }

    // ── Search Functionality ──
    const searchInput = document.getElementById('searchInput');
    const newsCards = document.querySelectorAll('.news-card');
    const monthGroups = document.querySelectorAll('.month-group');
    const monthDividers = document.querySelectorAll('.month-divider');

    // Create no-results element
    const noResults = document.createElement('div');
    noResults.className = 'no-results';
    noResults.textContent = 'Không tìm thấy bài viết nào phù hợp.';
    document.querySelector('.news-section')?.appendChild(noResults);

    if (searchInput) {
        let debounceTimer;
        searchInput.addEventListener('input', (e) => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                filterNews(e.target.value.trim().toLowerCase());
            }, 200);
        });
    }

    function filterNews(query) {
        let totalVisible = 0;

        monthGroups.forEach(group => {
            const cards = group.querySelectorAll('.news-card');
            let groupVisible = 0;

            cards.forEach(card => {
                const title = card.querySelector('.news-title')?.textContent.toLowerCase() || '';
                const desc = card.querySelector('.news-desc')?.textContent.toLowerCase() || '';
                const tags = card.dataset.tags?.toLowerCase() || '';
                const source = card.querySelector('.news-source')?.textContent.toLowerCase() || '';

                const matches = !query || 
                    title.includes(query) || 
                    desc.includes(query) || 
                    tags.includes(query) ||
                    source.includes(query);

                card.style.display = matches ? '' : 'none';
                if (matches) groupVisible++;
            });

            // Hide month badge if no cards visible in this group
            group.style.display = groupVisible > 0 ? '' : 'none';
            totalVisible += groupVisible;
        });

        // Show/hide dividers
        monthDividers.forEach(d => {
            d.style.display = totalVisible > 0 && !query ? '' : 'none';
        });

        // Show no results message
        noResults.classList.toggle('visible', totalVisible === 0 && !!query);
    }

    // ── Smooth scroll header effect ──
    const header = document.getElementById('header');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.15)';
        } else {
            header.style.boxShadow = 'none';
        }

        lastScroll = currentScroll;
    }, { passive: true });
});

