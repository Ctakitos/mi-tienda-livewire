import 'bootstrap';
import '../css/app.css';
import './theme';
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            const el = entry.target;

            if (entry.isIntersecting) {
                el.classList.add('animate__animated');

                // Establece duración y delay
                el.style.setProperty('--animate-duration', '0.8s');
                const delay = el.style.getPropertyValue('--animate-delay') || '0s';
                el.style.setProperty('--animate-delay', delay);

                // Vuelve a observar para permitir re-animación en scroll
                observer.unobserve(el);
                observer.observe(el);
            } else {
                el.classList.remove('animate__animated');
            }
        });
    }, {
        threshold: 0.3
    });

    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
});

