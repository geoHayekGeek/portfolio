<style>
    :root {
        --color-p: #f7e5eb;
        --color-s: black;
        --color-t: #E1DFF1;
        --color-q: white;
        --color-gray: #282931;
        --color-pink: #ff77a4;
        --color-white-2: #d8d8d8b3;

        --font-p: Oswald, sans-serif;
        --font-s: Open Sans, sans-serif;
    }

    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1000;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .popup {
        background-color: var(--color-t);
        font-family: Arial, sans-serif;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 60px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: center;
    }

    .popup-content {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        width: 90%;
    }

    .popup .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
        color: #333;
    }

    .popup #emailInput {
        width: 80%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .popup .wp-link-btn {
        text-align: left;
        text-transform: uppercase;
        background-color: var(--color-pink);
        color: var(--color-p);
        border-radius: 10px;
        padding: 8px 40px;
        font-size: 18px;
        font-weight: 300;
        line-height: 20px;
        box-shadow: none;
        border: none;
        font-family: var(--font-p);
        cursor: pointer;
        text-decoration: none;
    }
</style>

<div class="popup-overlay" id="popupOverlay">

    <div class="popup" id="popup">

        <span class="close" id="closePopup">&times;</span>

        <div class="popup-content">

            <h3>Let’s Elevate Your Social Media!</h3>

            <h6>Book a Free Consultation with a social media specialist today. Let’s discuss how we can enhance your
                online presence!</h6>

            <p>Chat with me on WhatsApp now!</p>

            <a target="_blank" href="https://wa.me/96176884670?text=Can%20we%20book%20a%20free%20consultation?" class="wp-link-btn">Book Now</a>

        </div>

    </div>

</div>

<script src="./assets/js/popup.js"></script>