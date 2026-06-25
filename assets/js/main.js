/**
 * Atlas Invencível 2026 — front-end interactions
 * Mobile menu, smooth in-page scrolling, active nav highlight, reveal-on-scroll.
 */
document.addEventListener('DOMContentLoaded', function () {
    var header = document.querySelector('.site-header');

    /* ---- Smooth scroll for same-page anchor links ---- */
    document.querySelectorAll('a[href*="#"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            var href = this.getAttribute('href') || '';
            var hashIndex = href.indexOf('#');
            if (hashIndex < 0) { return; }

            var hash = href.slice(hashIndex);
            if (hash === '#' || hash.length < 2) { return; }

            // Only intercept links that point to the current page.
            var path = href.slice(0, hashIndex);
            if (path && path !== window.location.pathname && path.indexOf(window.location.pathname) === -1 && href.charAt(0) !== '#') {
                // Allow cross-page links (e.g. home_url('/#contacto')) to navigate normally
                // unless we are already on that page.
            }

            var target = document.querySelector(hash);
            if (!target) { return; }

            e.preventDefault();
            var offset = header ? header.offsetHeight : 0;
            var top = target.getBoundingClientRect().top + window.pageYOffset - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        });
    });

    /* ---- Active nav highlight ---- */
    var sections = document.querySelectorAll('section[id], header[id]');
    var navLinks = document.querySelectorAll('.primary-nav .menu a');

    function updateActiveNav() {
        var scrollPos = window.scrollY + (header ? header.offsetHeight : 0) + 40;
        sections.forEach(function (section) {
            var top = section.offsetTop;
            var bottom = top + section.offsetHeight;
            var id = section.getAttribute('id');
            if (scrollPos >= top && scrollPos < bottom) {
                navLinks.forEach(function (link) {
                    link.classList.toggle('active', link.getAttribute('href') === '#' + id);
                });
            }
        });
    }

    if (sections.length && navLinks.length) {
        window.addEventListener('scroll', updateActiveNav, { passive: true });
        updateActiveNav();
    }

    /* ---- Mobile menu ---- */
    var toggle = document.querySelector('.nav-toggle');
    var overlay = document.querySelector('.mobile-menu-overlay');
    var closeBtn = document.querySelector('.mobile-menu-close');
    var body = document.body;

    function openMenu() {
        if (!overlay) { return; }
        toggle.classList.add('active');
        overlay.classList.add('active');
        toggle.setAttribute('aria-expanded', 'true');
        body.style.overflow = 'hidden';
    }

    function closeMenu() {
        if (!overlay) { return; }
        toggle.classList.remove('active');
        overlay.classList.remove('active');
        toggle.setAttribute('aria-expanded', 'false');
        body.style.overflow = '';
    }

    if (toggle && overlay) {
        toggle.addEventListener('click', function () {
            overlay.classList.contains('active') ? closeMenu() : openMenu();
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closeMenu);
        }

        overlay.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && overlay.classList.contains('active')) {
                closeMenu();
            }
        });
    }

    /* ---- Reveal on scroll ---- */
    var revealEls = document.querySelectorAll('.ai-section, .ai-work-row, .cs-section, .brand-sec');
    if ('IntersectionObserver' in window && revealEls.length) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'none';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

        revealEls.forEach(function (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity .6s ease, transform .6s ease';
            observer.observe(el);
        });
    }
});
