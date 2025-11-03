<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f4f4f4 0%, #e8e8e8 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            height: 550px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #3120CD 0%, #4a3ce6 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            top: -50px;
            left: -50px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            bottom: -30px;
            right: 50px;
        }

        .welcome-text {
            position: relative;
            z-index: 2;
        }

        .welcome-text h1 {
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .welcome-text p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features {
            margin-top: 30px;
            position: relative;
            z-index: 2;
        }

        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .feature i {
            margin-right: 10px;
            font-size: 18px;
            background: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right-panel {
            flex: 1;
            background: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo i {
            font-size: 40px;
            color: #3120CD;
            margin-bottom: 10px;
        }

        .logo h2 {
            color: #3120CD;
            font-size: 24px;
            font-weight: 700;
        }

        .form-container {
            margin-top: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 18px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 15px 15px 50px;
            border: 1.5px solid #e1e1e1;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3120CD;
            box-shadow: 0 0 0 3px rgba(49, 32, 205, 0.1);
            background-color: #fff;
        }

        .form-group label {
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 15px;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus + label,
        .form-group input:not(:placeholder-shown) + label {
            top: -10px;
            left: 15px;
            font-size: 12px;
            background: white;
            padding: 0 5px;
            color: #3120CD;
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .forgot-password {
            color: #3120CD;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: #3120CD;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(49, 32, 205, 0.3);
        }

        .login-btn:hover {
            background: #2a1cb5;
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(49, 32, 205, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
            color: #888;
            font-size: 14px;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e1e1e1;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            color: #555;
            font-size: 18px;
            transition: all 0.3s ease;
            border: 1px solid #e1e1e1;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .facebook:hover {
            background: #3b5998;
            color: white;
        }

        .twitter:hover {
            background: #1da1f2;
            color: white;
        }

        .google:hover {
            background: #db4437;
            color: white;
        }

        .register-link {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .register-link a {
            color: #3120CD;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .success {
            color: #28a745;
            text-align: center;
            margin-top: 15px;
            padding: 12px;
            background-color: rgba(40, 167, 69, 0.1);
            border-radius: 8px;
            font-weight: 500;
            border-left: 4px solid #28a745;
        }

        .errors {
            color: #dc3545;
            margin-top: 15px;
            padding: 12px;
            background-color: rgba(220, 53, 69, 0.1);
            border-radius: 8px;
            border-left: 4px solid #dc3545;
        }

        .errors ul {
            list-style-type: none;
            padding-left: 0;
        }

        .errors li {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
                height: auto;
            }
            
            .left-panel {
                padding: 30px;
            }
            
            .right-panel {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="left-panel">
            <div class="welcome-text">
                <h1>Selamat Datang Admin</h1>
                <p>Masuk ke dashboard admin untuk mengelola sistem dengan mudah dan efisien.</p>
            </div>
            <div class="features">
                <div class="feature">
                    <i class="fas fa-shield-alt"></i>
                    <span>Sistem keamanan terenkripsi</span>
                </div>
                <div class="feature">
                    <i class="fas fa-chart-line"></i>
                    <span>Analitik data real-time</span>
                </div>
                <div class="feature">
                    <i class="fas fa-cogs"></i>
                    <span>Kontrol penuh sistem</span>
                </div>
            </div>
        </div>
        
        <div class="right-panel">
            <div class="logo">
                <i class="fas fa-user-shield"></i>
                <h2>Admin Login</h2>
            </div>
            
            <div class="form-container">
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" placeholder=" " required>
                        <label for="username">Username</label>
                    </div>
                    
                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder=" " required>
                        <label for="password">Password</label>
                    </div>
                    
                    <button type="submit" class="login-btn">Masuk</button>
                </form>
                
                @if(session('success'))
                    <p class="success">{{ session('success') }}</p>
                @endif

                @if ($errors->any())
                    <div class="errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        </div>
    </div>

    <script>
        // Animasi sederhana untuk form
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
        });
    </script>
</body>
</html>