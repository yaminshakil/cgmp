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

// Services marquee: auto-scrolls right-to-left and can be grabbed with the mouse to scrub back and forth.
// The list is duplicated once (see x-services-grid), so wrapping at the halfway point of scrollWidth loops seamlessly.
document.querySelectorAll('.services-marquee').forEach((marquee) => {
    const track = marquee.querySelector('.services-marquee-track');
    if (!track) return;

    let isDown = false;
    let dragged = false;
    let hovering = false;
    let touching = false;
    let startX = 0;
    let startScroll = 0;

    const wrap = () => {
        const half = track.scrollWidth / 2;
        if (half <= 0) return;
        if (marquee.scrollLeft >= half) marquee.scrollLeft -= half;
        else if (marquee.scrollLeft < 0) marquee.scrollLeft += half;
    };

    if (!prefersReducedMotion) {
        const pxPerSecond = 45;
        let last = performance.now();

        const tick = (now) => {
            const dt = (now - last) / 1000;
            last = now;
            if (!isDown && !hovering && !touching) {
                marquee.scrollLeft += pxPerSecond * dt;
                wrap();
            }
            requestAnimationFrame(tick);
        };

        requestAnimationFrame(tick);
    }

    marquee.addEventListener('touchstart', () => { touching = true; }, { passive: true });
    marquee.addEventListener('touchend', () => { touching = false; }, { passive: true });
    marquee.addEventListener('touchcancel', () => { touching = false; }, { passive: true });

    marquee.addEventListener('mouseenter', () => { hovering = true; });
    marquee.addEventListener('mouseleave', () => {
        hovering = false;
        isDown = false;
        marquee.classList.remove('is-dragging');
    });

    marquee.addEventListener('mousedown', (event) => {
        isDown = true;
        dragged = false;
        startX = event.pageX;
        startScroll = marquee.scrollLeft;
        marquee.classList.add('is-dragging');
    });

    window.addEventListener('mouseup', () => {
        isDown = false;
        marquee.classList.remove('is-dragging');
    });

    marquee.addEventListener('mousemove', (event) => {
        if (!isDown) return;
        event.preventDefault();
        const delta = event.pageX - startX;
        if (Math.abs(delta) > 3) dragged = true;
        marquee.scrollLeft = startScroll - delta;
        wrap();
    });

    // Swallow the click that follows a drag so it doesn't also navigate the tile the pointer lands on.
    marquee.addEventListener('click', (event) => {
        if (dragged) {
            event.preventDefault();
            event.stopPropagation();
        }
    }, true);

    // Tiles are <a> links around <img> elements, both natively draggable; left-click+drag would
    // otherwise be hijacked into the browser's "drag this link/image" gesture instead of scrolling.
    marquee.addEventListener('dragstart', (event) => event.preventDefault());
});

// Every "Book Appointment" button opens the HealthEngine popup instead of navigating away.
// Without a HealthEngine ID (no modal on the page) the link works normally.
document.addEventListener('click', (event) => {
    const trigger = event.target.closest('[data-book-appointment]');

    if (!trigger || !document.querySelector('[aria-label="Book an appointment"]')) {
        return;
    }

    event.preventDefault();
    window.dispatchEvent(new CustomEvent('open-booking', { detail: { doctor: trigger.dataset.doctorId || '' } }));
});
