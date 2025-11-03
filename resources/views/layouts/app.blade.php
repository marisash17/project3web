<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3120CD;
            --primary-light: #4430E7;
            --primary-dark: #2B1FC0;
            --sidebar-width: 300px;
            --gradient: linear-gradient(135deg, #2B1FC0 0%, #4430E7 50%, #5A46FF 100%);
            --gradient-hover: linear-gradient(135deg, #4430E7 0%, #5A46FF 50%, #6B58FF 100%);
            --glass: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.15);
            --shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            --card-shadow: 0 8px 30px rgba(49, 32, 205, 0.2);
            --neumorphic: 10px 10px 30px rgba(0, 0, 0, 0.1), -10px -10px 30px rgba(255, 255, 255, 0.8);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 50%, #e8edff 100%);
            min-height: 100vh;
            display: flex;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Enhanced Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--gradient);
            color: #fff;
            padding: 0;
            z-index: 1000;
            overflow-y: auto;
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .sidebar-header {
            padding: 35px 30px 25px;
            border-bottom: 1px solid var(--glass-border);
            background: rgba(255, 255, 255, 0.08);
            position: relative;
            overflow: hidden;
        }

        .sidebar-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 0;
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: translateY(-2px);
        }

        .logo img {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            padding: 8px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .logo:hover img {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .logo-text {
            font-weight: 800;
            font-size: 24px;
            background: linear-gradient(135deg, #fff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .admin-info {
            padding: 30px 25px;
            text-align: center;
            background: var(--glass);
            margin: 20px;
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .admin-info::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .admin-info:hover::before {
            opacity: 1;
        }

        .admin-info:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .admin-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #fff 0%, #e0e7ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .admin-avatar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
        }

        .admin-avatar:hover::before {
            transform: rotate(45deg) translate(50%, 50%);
        }

        .admin-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        .admin-avatar i {
            font-size: 36px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            z-index: 2;
            position: relative;
        }

        .admin-name {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 8px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .admin-role {
            font-size: 14px;
            opacity: 0.9;
            background: rgba(255, 255, 255, 0.2);
            padding: 6px 16px;
            border-radius: 20px;
            display: inline-block;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 500;
        }

        .sidebar-nav {
            padding: 20px 15px;
        }

        .nav-item {
            margin-bottom: 10px;
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            padding: 16px 20px;
            border-radius: 14px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.6s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link i {
            font-size: 20px;
            width: 24px;
            text-align: center;
            transition: all 0.3s ease;
            filter: drop-shadow(0 2px 3px rgba(0, 0, 0, 0.2));
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            transform: translateX(8px);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-dark) 100%);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 8px 25px rgba(90, 70, 255, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transform: translateX(8px);
        }

        .nav-link.active i {
            color: #fff;
            transform: scale(1.15);
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        .nav-link span {
            font-size: 15px;
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }
        
        /* Enhanced Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: transparent;
            position: relative;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(49, 32, 205, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }
        
        /* Enhanced Header Styles */
        .main-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(25px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.6);
            padding: 20px 35px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title h1 {
            font-weight: 800;
            font-size: 32px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .page-title p {
            color: #666;
            font-size: 15px;
            margin: 8px 0 0;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .current-time {
            background: rgba(255, 255, 255, 0.7);
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 600;
            color: var(--primary);
            box-shadow: var(--neumorphic);
            border: 1px solid rgba(255, 255, 255, 0.4);
            font-size: 14px;
        }

        .logout-btn {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            box-shadow: var(--card-shadow);
            position: relative;
            overflow: hidden;
        }

        .logout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }

        .logout-btn:hover::before {
            left: 100%;
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(49, 32, 205, 0.35);
            color: white;
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--primary-light) 0%, var(--primary-dark) 100%);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nav-item {
            animation: slideIn 0.5s ease-out;
        }

        .nav-item:nth-child(1) { animation-delay: 0.1s; }
        .nav-item:nth-child(2) { animation-delay: 0.2s; }
        .nav-item:nth-child(3) { animation-delay: 0.3s; }
        .nav-item:nth-child(4) { animation-delay: 0.4s; }
        .nav-item:nth-child(5) { animation-delay: 0.5s; }
        .nav-item:nth-child(6) { animation-delay: 0.6s; }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        .nav-link.active {
            animation: pulse 2s ease-in-out infinite;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 280px;
                transform: translateX(-100%);
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
        
        @media (max-width: 768px) {
            .main-header {
                padding: 18px 25px;
            }
            
            .page-title h1 {
                font-size: 28px;
            }

            .header-actions {
                gap: 15px;
            }

            .current-time {
                padding: 8px 15px;
                font-size: 13px;
            }

            .logout-btn {
                padding: 10px 20px;
            }
        }
        
        @media (max-width: 576px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .sidebar-header {
                padding: 25px 20px 20px;
            }

            .admin-info {
                margin: 15px;
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <div class="main-content">
        <!-- Header -->
        <header class="main-header">
            <div class="header-content">
                <div class="page-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="header-actions">
                    <div class="current-time">
                        <i class="bi bi-clock me-2"></i>
                        <span id="current-time"></span>
                    </div>
                    <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update current time
        function updateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
        }
        
        setInterval(updateTime, 1000);
        updateTime();

        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(8px)';
                });
                
                link.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.transform = 'translateX(0)';
                    }
                });
            });

            // Add ripple effect to logout button
            const logoutBtn = document.querySelector('.logout-btn');
            logoutBtn.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.borderRadius = '50%';
                ripple.style.position = 'absolute';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });
    </script>
    <style>
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
    @stack('scripts')
</body>
</html>