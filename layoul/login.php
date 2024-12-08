<?php
// Start the session to access CSRF token
session_start();
require_once './backend/functions.php';

// Generate CSRF token
$csrf_token = generateCSRFToken();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0a0a0a;
            position: relative;
            overflow: hidden;
        }

        .animated-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .gradient-sphere {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.5;
            animation: moveSphere 20s infinite ease-in-out;
        }

        .sphere-1 {
            width: 600px;
            height: 600px;
            background: linear-gradient(45deg, #ff3366, #ff6b3d);
            top: -300px;
            left: -300px;
            animation-delay: -5s;
        }

        .sphere-2 {
            width: 500px;
            height: 500px;
            background: linear-gradient(45deg, #4433ff, #3dceff);
            bottom: -250px;
            right: -250px;
            animation-delay: -2s;
        }

        .sphere-3 {
            width: 400px;
            height: 400px;
            background: linear-gradient(45deg, #7400ff, #ff00d4);
            top: 50%;
            left: 30%;
            animation-delay: -8s;
        }

        @keyframes moveSphere {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg) scale(1);
            }

            25% {
                transform: translate(100px, 50px) rotate(90deg) scale(1.1);
            }

            50% {
                transform: translate(50px, 100px) rotate(180deg) scale(1);
            }

            75% {
                transform: translate(-50px, 50px) rotate(270deg) scale(0.9);
            }
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: floatParticle 8s infinite linear;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) scale(1);
                opacity: 0;
            }
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem;
            color: white;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transform: translateY(20px);
            opacity: 0;
            animation: slideIn 0.6s ease-out forwards;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 200%;
            height: 100%;
            background: linear-gradient(to right,
                    transparent,
                    rgba(255, 255, 255, 0.1),
                    transparent);
            transform: skewX(-15deg);
            transition: 0.5s;
        }

        .login-container:hover::before {
            left: 100%;
        }

        @keyframes slideIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(45deg, #fff, #ccc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.05);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
            transition: color 0.3s ease;
        }

        .form-input:focus+.input-icon {
            color: white;
        }

        .submit-button {
            width: 100%;
            padding: 1rem;
            background: white;
            color: black;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right,
                    transparent,
                    rgba(255, 255, 255, 0.8),
                    transparent);
            transition: 0.5s;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .submit-button:hover::before {
            left: 100%;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
        }

        .social-button {
            width: 50px;
            height: 50px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .social-button::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(100%);
            transition: 0.3s ease;
        }

        .social-button:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .social-button:hover::before {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            color: rgba(255, 255, 255, 0.4);
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .divider span {
            padding: 0 1rem;
            font-size: 0.9rem;
        }

        .additional-options {
            text-align: center;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .additional-options a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .additional-options a:hover {
            opacity: 0.8;
        }

        .error-message {
            color: #ff4477;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes ripple {
            to {
                width: 300px;
                height: 300px;
                opacity: 0;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 1rem;
                padding: 2rem;
            }

            .login-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="animated-background">
        <div class="gradient-sphere sphere-1"></div>
        <div class="gradient-sphere sphere-2"></div>
        <div class="gradient-sphere sphere-3"></div>
        <div class="particles" id="particles"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Sign in to continue your journey</p>
        </div>

        <form id="loginForm">
            <div class="form-group">
                <input type="text" name="username" id="username" class="form-input" placeholder="Enter your username"
                    required>
                <i class="fas fa-user input-icon"></i>
            </div>

            <div class="form-group">
                <input type="password" class="form-input" id="password" placeholder="Password" required>
                <i class="input-icon fas fa-lock"></i>
                <span class="error-message" id="passwordError"></span>
            </div>
            <input type="hidden" id="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">


            <button type="submit" class="submit-button">Sign In</button>
        </form>

        <div class="divider">
            <span>or continue with</span>
        </div>

        <div class="additional-options">
            <a href="#" onclick="handleForgotPassword()">Forgot password?</a>
        </div>
    </div>

    <script src="./assets/js/login.js"></script>
</body>

</html>