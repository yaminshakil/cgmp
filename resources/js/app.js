import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!prefersReducedMotion && 'IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
        // Cards entering together (a row of a grid) reveal one after another.
        let index = 0;

        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;

                if (index > 0 && !el.parentElement?.classList.contains('reveal-stagger')) {
                    el.style.transitionDelay = `${Math.min(index, 5) * 90}ms`;
                    // Drop the delay afterwards so hover effects on the card stay instant.
                    setTimeout(() => { el.style.transitionDelay = ''; }, 1400);
                }

                index += 1;
                el.classList.add('is-visible');
                revealObserver.unobserve(el);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

    document.querySelectorAll('[data-reveal]').forEach((el) => revealObserver.observe(el));
} else {
    document.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('is-visible'));
}

// Thin reading-progress bar along the top of public pages.
if (!prefersReducedMotion && document.getElementById('site-header')) {
    const bar = document.createElement('div');
    bar.className = 'scroll-progress';
    bar.setAttribute('aria-hidden', 'true');
    document.body.appendChild(bar);

    let ticking = false;
    const update = () => {
        const max = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.transform = `scaleX(${max > 0 ? Math.min(window.scrollY / max, 1) : 0})`;
        ticking = false;
    };

    window.addEventListener('scroll', () => {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(update);
        }
    }, { passive: true });
    update();
}

if (!prefersReducedMotion && 'IntersectionObserver' in window) {
    const countUp = (el) => {
        const target = parseInt(el.dataset.countTo, 10) || 0;
        const duration = 900;
        const start = performance.now();

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            el.textContent = Math.round(progress * target) + (el.dataset.countSuffix || '');
            if (progress < 1) requestAnimationFrame(step);
        };

        requestAnimationFrame(step);
    };

    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                countUp(entry.target);
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.4 });

    document.querySelectorAll('[data-count-to]').forEach((el) => statsObserver.observe(el));
}

// Every "Book Appointment" button opens the HealthEngine popup instead of navigating away.
// Without a HealthEngine ID (no modal on the page) the link works normally.
document.addEventListener('click', (event) => {
    const trigger = event.target.closest('[data-book-appointment]');

    if (!trigger || !document.querySelector('[aria-label="Book an appointment"]')) {
        return;
    }

    event.preventDefault();
    window.dispatchEvent(new CustomEvent('open-booking'));
});
