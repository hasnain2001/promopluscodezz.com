    document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('header');
    let lastScroll = window.scrollY;
    let ticking = false;

    function handleScroll() {
        const currentScroll = window.scrollY;

        if (currentScroll > lastScroll && currentScroll > 100) {
        // Scrolling down
        header.style.transform = 'translateY(-100%)';
        } else if (currentScroll < lastScroll) {
        // Scrolling up
        header.style.transform = 'translateY(0)';
        }

        lastScroll = currentScroll;
        ticking = false;
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
        window.requestAnimationFrame(handleScroll);
        ticking = true;
        }
    });
    });
