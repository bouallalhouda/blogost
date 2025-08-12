document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                requestAnimationFrame(() => {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                });
            }
        });
    }, {
        threshold: 0.05,
        rootMargin: "0px 0px -100px 0px"
    });

    document.querySelectorAll('.blog-card').forEach(card => {
        card.style.opacity = 0;
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 400ms ease-out, transform 400ms ease-out';
        observer.observe(card);
    });
});