// Services page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation links
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
    
    // Service card hover effects
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // View All button functionality
    const viewAllBtn = document.querySelector('.view-all-btn');
    if (viewAllBtn) {
        viewAllBtn.addEventListener('click', function() {
            // Scroll to projects section or show all services
            const projectsSection = document.querySelector('#projects');
            if (projectsSection) {
                projectsSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }
    
    // Contact Me button functionality
    const contactBtn = document.querySelector('.cta-button');
    if (contactBtn) {
        contactBtn.addEventListener('click', function() {
            // You can add contact form modal or redirect to contact page
            alert('Contact functionality would be implemented here!');
        });
    }
    
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
    const animatedElements = document.querySelectorAll('.service-card, .logo-item, .cta-circle');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // Company logos hover effect
    const logoItems = document.querySelectorAll('.logo-item');
    
    logoItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            const shape = this.querySelector('.logo-icon-shape');
            shape.style.transform = 'scale(1.1)';
            shape.style.transition = 'transform 0.3s ease';
        });
        
        item.addEventListener('mouseleave', function() {
            const shape = this.querySelector('.logo-icon-shape');
            shape.style.transform = 'scale(1)';
        });
    });
    
    // CTA circle animation
    const ctaCircle = document.querySelector('.cta-circle');
    if (ctaCircle) {
        ctaCircle.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        ctaCircle.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }
    
    // Parallax effect for CTA section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const ctaSection = document.querySelector('.cta-section');
        
        if (ctaSection) {
            const rect = ctaSection.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                const parallaxSpeed = 0.3;
                const yPos = -(scrolled * parallaxSpeed);
                ctaSection.style.transform = `translateY(${yPos}px)`;
            }
        }
    });
    
    // Mobile menu toggle (if needed)
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const nav = document.querySelector('.nav');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
    }
    
    // Close mobile menu when clicking on a link
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (nav && nav.classList.contains('active')) {
                nav.classList.remove('active');
            }
        });
    });
});
