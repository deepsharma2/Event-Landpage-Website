<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CSA XCON CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 50%, #0a0e27 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(0, 212, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(124, 58, 237, 0.1) 0%, transparent 50%);
            animation: pulse 15s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .login-container {
            position: relative;
            z-index: 1;
            background: rgba(19, 24, 41, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-section h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #00d4ff 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .logo-section p {
            color: #a0aec0;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #a0aec0;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00d4ff;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1);
        }

        .form-group input::placeholder {
            color: #718096;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #a0aec0;
        }

        .remember-me input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .forgot-password {
            color: #00d4ff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #7c3aed;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #00d4ff 0%, #7c3aed 100%);
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(0, 212, 255, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
        }

        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        .divider span {
            position: relative;
            background: rgba(19, 24, 41, 0.9);
            padding: 0 1rem;
            color: #718096;
            font-size: 0.85rem;
        }

        .back-to-site {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-to-site a {
            color: #a0aec0;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .back-to-site a:hover {
            color: #00d4ff;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <h1>CSA XCON CMS</h1>
            <p>Content Management System</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                <?php
                    $error = $_GET['error'];
                    if ($error === 'invalid') {
                        echo 'Invalid username or password';
                    } elseif ($error === 'session') {
                        echo 'Your session has expired. Please login again.';
                    } else {
                        echo 'An error occurred. Please try again.';
                    }
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] === 'logout'): ?>
            <div class="alert alert-success">
                You have been successfully logged out.
            </div>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" value="1">
                    <span>Remember me</span>
                </label>
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>

            <button type="submit" class="btn-login">Sign In</button>
        </form>

        <div class="divider">
            <span>OR</span>
        </div>

        <div class="back-to-site">
            <a href="../index.html">← Back to Website</a>
        </div>
    </div>
</body>
</html>
