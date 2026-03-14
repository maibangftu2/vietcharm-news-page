/**
 * VietCharm Tin Tức – JavaScript
 * File: public/js/tin-tuc.js
 */

document.addEventListener('DOMContentLoaded', function () {

    // ── Search Functionality ──
    var searchInput = document.getElementById('newsSearchInput');
    var newsCards = document.querySelectorAll('.news-card');
    var monthGroups = document.querySelectorAll('.news-month-group');
    var monthDividers = document.querySelectorAll('.news-month-divider');
    var noResults = document.getElementById('newsNoResults');

    if (searchInput) {
        var debounceTimer;
        searchInput.addEventListener('input', function (e) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                filterNews(e.target.value.trim().toLowerCase());
            }, 200);
        });
    }

    function filterNews(query) {
        var totalVisible = 0;

        monthGroups.forEach(function (group) {
            var cards = group.querySelectorAll('.news-card');
            var groupVisible = 0;

            cards.forEach(function (card) {
                var title = card.querySelector('.news-card-title');
                var desc = card.querySelector('.news-card-desc');
                var source = card.querySelector('.news-card-source');
                var tags = card.dataset.tags || '';

                var titleText = title ? title.textContent.toLowerCase() : '';
                var descText = desc ? desc.textContent.toLowerCase() : '';
                var sourceText = source ? source.textContent.toLowerCase() : '';
                var tagsText = tags.toLowerCase();

                var matches = !query ||
                    titleText.indexOf(query) !== -1 ||
                    descText.indexOf(query) !== -1 ||
                    sourceText.indexOf(query) !== -1 ||
                    tagsText.indexOf(query) !== -1;

                card.style.display = matches ? '' : 'none';
                if (matches) groupVisible++;
            });

            group.style.display = groupVisible > 0 ? '' : 'none';
            totalVisible += groupVisible;
        });

        // Show/hide dividers
        monthDividers.forEach(function (d) {
            d.style.display = totalVisible > 0 && !query ? '' : 'none';
        });

        // Show no results message
        if (noResults) {
            if (totalVisible === 0 && query) {
                noResults.classList.add('visible');
            } else {
                noResults.classList.remove('visible');
            }
        }
    }

    // ── Intersection Observer for card animations ──
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('news-card-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.05,
            rootMargin: '50px 0px 0px 0px'
        });

        newsCards.forEach(function (card, index) {
            card.classList.add('news-card-animate');
            card.style.transitionDelay = (index * 0.06) + 's';
            observer.observe(card);
        });
    }
});
