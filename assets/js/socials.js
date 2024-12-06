document.addEventListener("DOMContentLoaded", () => {
    let hidden = true;

    const socials_toggler = document.querySelector('.socials-toggler');
    const socials_container = document.querySelector('.social-container');

    socials_toggler.addEventListener('click', (e) => {
        if (hidden) {
            socials_container.style.transform = 'translateY(0)';
            socials_toggler.style.transform = 'translateY(0)';
        } else {
            socials_container.style.transform = 'translateY(-40px)';
            socials_toggler.style.transform = 'translateY(-40px)';
        }

        hidden = !hidden;
    })
});
