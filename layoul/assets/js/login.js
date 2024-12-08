document.addEventListener("DOMContentLoaded", () => {
    // Create floating particles
    function createParticles() {
        const container = document.getElementById('particles');
        const particleCount = 50;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';

            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 8 + 's';
            particle.style.opacity = Math.random() * 0.5 + 0.2;

            container.appendChild(particle);
        }
    }

    // Validate input fields
    function validateInputs() {
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const passwordError = document.getElementById('passwordError');

        // Basic validation
        if (!username.value.trim()) {
            showError(username, 'Username cannot be empty');
            return false;
        }

        if (!password.value) {
            showError(password, 'Password cannot be empty');
            return false;
        }

        // Clear previous error messages
        passwordError.style.display = 'none';
        passwordError.textContent = '';
        return true;
    }

    // Show error message
    function showError(inputElement, message) {
        const passwordError = document.getElementById('passwordError');
        passwordError.textContent = message;
        passwordError.style.display = 'block';
        inputElement.focus();
    }

    // Handle form submission
    function handleLogin(event) {
        event.preventDefault();

        // Validate inputs first
        if (!validateInputs()) {
            return;
        }

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Get CSRF token from hidden input field
        const csrf_token = document.getElementById('csrf_token').value;

        // Disable submit button to prevent multiple submissions
        const submitButton = event.target.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Signing In...';

        // Send POST request with CSRF token
        fetch('./backend/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                username,
                password,
                csrf_token,
            }),
        })
            .then(response => {
                // Check if the response is OK
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.success); // Add this line to log the response
                if (data.success) {
                    window.location.href = data.redirect || './index';
                } else {
                    // Show error message
                    const passwordError = document.getElementById('passwordError');
                    passwordError.textContent = data.message || 'Login failed';
                    passwordError.style.display = 'block';
                    submitButton.disabled = false;
                    submitButton.textContent = 'Sign In';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const passwordError = document.getElementById('passwordError');
                passwordError.textContent = 'Network error. Please try again.';
                passwordError.style.display = 'block';

                // Re-enable submit button
                submitButton.disabled = false;
                submitButton.textContent = 'Sign In';
            });
    }

    // Handle social login buttons
    function handleSocialLogin(provider) {
        alert(`${provider} login would be implemented here`);
    }

    // Handle forgot password
    function handleForgotPassword() {
        alert('Password reset would be implemented here');
    }

    // Add mouse move effect for gradient spheres
    document.addEventListener('mousemove', (e) => {
        const spheres = document.querySelectorAll('.gradient-sphere');
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;

        spheres.forEach((sphere, index) => {
            const speed = (index + 1) * 20;
            const xOffset = (0.5 - x) * speed;
            const yOffset = (0.5 - y) * speed;

            sphere.style.transform = `translate(${xOffset}px, ${yOffset}px) scale(${1 + (index * 0.1)})`;
        });
    });

    // Initialize page elements
    function initializePage() {
        // Initialize particles
        createParticles();

        // Attach form submission event
        const loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', handleLogin);
        }

        // Animate form elements
        const elements = document.querySelectorAll('.form-group, .submit-button, .divider, .social-login, .additional-options');
        elements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            setTimeout(() => {
                element.style.transition = 'all 0.6s ease-out';
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, 100 * index);
        });

        // Add input focus effects
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', () => {
                if (!input.value) {
                    input.parentElement.classList.remove('focused');
                }
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.submit-button, .social-button').forEach(button => {
            button.addEventListener('click', function (e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.width = '0';
                ripple.style.height = '0';
                ripple.style.background = 'rgba(255, 255, 255, 0.4)';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'translate(-50%, -50%)';
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                ripple.style.animation = 'ripple 0.6s ease-out';

                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);

                setTimeout(() => ripple.remove(), 600);
            });
        });
    }

    // Call initialization function
    initializePage();
});

// Global function to handle login for inline onsubmit attribute compatibility
function handleLogin(event) {
    event.preventDefault();
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        const submitEvent = new Event('submit', { cancelable: true });
        loginForm.dispatchEvent(submitEvent);
    }
}