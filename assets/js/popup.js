document.addEventListener('DOMContentLoaded', function () {
    const popupOverlay = document.getElementById('popupOverlay');
    const popup = document.getElementById('popup');
    const closePopup = document.getElementById('closePopup');
    const emailInput = document.getElementById('emailInput');

    function shouldShowPopup() {
        const lastShown = localStorage.getItem('popupLastShown');
        if (!lastShown) return true;

        const elapsedTime = Date.now() - parseInt(lastShown, 10);
        return elapsedTime > 5 * 60 * 1000;
    }

    function openPopup() {
        if (shouldShowPopup()) {
            popupOverlay.style.display = 'block';
            localStorage.setItem('popupLastShown', Date.now().toString());
        }
    }

    function closePopupFunc() {
        popupOverlay.style.display = 'none';
    }

    function submitForm() {
        const email = emailInput.value;
        console.log(`Email submitted: ${email}`);
        closePopupFunc();
    }

    openPopup();

    closePopup.addEventListener('click', closePopupFunc);

    popupOverlay.addEventListener('click', function (event) {
        if (event.target === popupOverlay) {
            closePopupFunc();
        }
    });
});
