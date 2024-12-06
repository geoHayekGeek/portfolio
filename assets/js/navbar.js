document.addEventListener("DOMContentLoaded", () => {
    const toggler = document.querySelector(".navbar-toggler");
    const line1 = toggler.querySelector(".custom-toggler-1 svg line");
    const line2 = toggler.querySelector(".custom-toggler-2 svg line");

    toggler.addEventListener("click", () => {
        toggler.classList.toggle("active");

        if (toggler.classList.contains("active")) {
            gsap.to(line1, { duration: 0.3, attr: { x1: 8, y1: 0, x2: 32, y2: 24 } });
            gsap.to(line2, { duration: 0.3, attr: { x1: 8, y1: 24, x2: 32, y2: 0 } });
        } else {
            gsap.to(line1, { duration: 0.3, attr: { x1: 3, y1: 12, x2: 21, y2: 12 } });
            gsap.to(line2, { duration: 0.3, attr: { x1: 3, y1: 12, x2: 21, y2: 12 } });
        }
    });

    const currentPage = window.location.pathname.split('/').pop() || 'index';  // Default to 'index' if empty

    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

    navLinks.forEach(link => {
        if (link.getAttribute('href').includes(currentPage)) {

            const current = document.querySelector('.navbar-nav .nav-link.active');
            if (current) {
                current.classList.remove('active');
            }

            link.classList.add('active');
        }
    });
});
