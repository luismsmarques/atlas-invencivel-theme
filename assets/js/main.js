// Smooth scrolling for navigation links
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Active navigation highlighting
    const sections = document.querySelectorAll('section[id]');
    const navLinksArray = Array.from(navLinks);
    
    function updateActiveNav() {
        const scrollPosition = window.scrollY + 100;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                navLinksArray.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }
    
    window.addEventListener('scroll', updateActiveNav);
    updateActiveNav(); // Initial call
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animatedElements = document.querySelectorAll('.skill-card, .project-card, .timeline-item, .logo-item');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Mobile menu toggle functionality
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const body = document.body;
    
    if (mobileMenuToggle && mobileMenuOverlay) {
        mobileMenuToggle.addEventListener('click', function() {
            const isOpen = mobileMenuOverlay.classList.contains('active');
            
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
        
        // Close button functionality
        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', function() {
                closeMobileMenu();
            });
        }
        
        // Close mobile menu when clicking on a navigation link
        const mobileNavLinks = document.querySelectorAll('.mobile-menu-nav a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeMobileMenu();
            });
        });
        
        // Close mobile menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenuOverlay.classList.contains('active')) {
                closeMobileMenu();
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenuOverlay.classList.contains('active') && 
                !mobileMenuOverlay.contains(e.target) && 
                !mobileMenuToggle.contains(e.target) &&
                !mobileMenuClose.contains(e.target)) {
                closeMobileMenu();
            }
        });
        
        function openMobileMenu() {
            mobileMenuToggle.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            mobileMenuToggle.setAttribute('aria-expanded', 'true');
            body.style.overflow = 'hidden';
        }
        
        function closeMobileMenu() {
            mobileMenuToggle.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            body.style.overflow = '';
        }
    }
    
    // Parallax effect for hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero');
        const heroHeight = hero.offsetHeight;
        
        if (scrolled < heroHeight) {
            const parallaxSpeed = 0.5;
            const maxTranslateY = 100; // Maximum translateY to prevent overlapping
            const translateY = Math.min(scrolled * parallaxSpeed, maxTranslateY);
            hero.style.transform = `translateY(${translateY}px)`;
        }
    });
    
});
