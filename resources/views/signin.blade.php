<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign in to your kassbi account.">
    <title>Sign In | kassbi</title>

    <!-- Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Global Styles & Variables */
        :root {
            --primary: #3498db; --secondary: #2c3e50; --light: #f8f9fa;
            --dark: #343a40; --gray: #6c757d; --success: #28a745;
            --danger: #dc3545; --warning: #ffc107; --info: #17a2b8;
        }

        /* Dark Mode Theme */
        [data-theme="dark"] {
            --primary: #5cb8e6; --secondary: #f8f9fa; --light: #212529;
            --dark: #f8f9fa; --gray: #adb5bd;
            background-color: var(--light); color: var(--dark);
        }
        [data-theme="dark"] header {
            background-color: #2c3e50;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        [data-theme="dark"] .logo-text,
        [data-theme="dark"] .nav-link,
        [data-theme="dark"] .theme-toggle {
            color: var(--dark) !important;
        }
        [data-theme="dark"] .btn-outline {
            border-color: var(--primary) !important;
            color: var(--primary) !important;
        }
        [data-theme="dark"] .btn-outline:hover {
            background-color: var(--primary) !important;
            color: #212529 !important;
        }
        [data-theme="dark"] .signin-card {
            background-color: #343a40;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        }
        [data-theme="dark"] .form-control {
            background-color: #495057;
            color: var(--dark);
            border-color: #6c757d;
        }
        [data-theme="dark"] .form-control:focus {
             background-color: #495057;
        }
        [data-theme="dark"] .form-label, 
        [data-theme="dark"] .form-check-label,
        [data-theme="dark"] .forgot-password-link {
            color: var(--gray);
        }
         [data-theme="dark"] .forgot-password-link:hover {
            color: var(--primary);
        }
        [data-theme="dark"] .divider span {
            background-color: #343a40;
        }
        [data-theme="dark"] .btn-social {
            background-color: #495057;
            color: var(--dark);
            border-color: #6c757d;
        }
         [data-theme="dark"] .btn-social:hover {
            background-color: #5a6268;
        }

        /* Base & Layout Styles */
        body {
            background-color: var(--light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        /* --- HEADER STYLES (FROM PREVIOUS FILE) --- */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .logo { display: flex; align-items: center; text-decoration: none; color: var(--secondary); }
        .logo-icon {
            background-color: var(--primary); color: white; width: 40px; height: 40px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: bold; margin-right: 0.5rem; flex-shrink: 0;
        }
        .logo-text { font-size: 1.5rem; font-weight: bold; white-space: nowrap; color: var(--secondary); transition: color 0.3s; }
        .logo-text span { color: var(--primary); }
        .nav-link { text-decoration: none; color: var(--dark); font-weight: 500; transition: color 0.3s; }
        .nav-link:hover { color: var(--primary); }
        .btn {
            padding: 0.5rem 1rem; border-radius: 4px; font-weight: 500; cursor: pointer;
            transition: all 0.3s; border: none; text-decoration: none; display: inline-flex;
            align-items: center; justify-content: center;
        }
        .btn-outline { background-color: transparent; border: 1px solid var(--primary); color: var(--primary); }
        .btn-outline:hover { background-color: var(--primary); color: white; }
        .btn-primary { background-color: var(--primary); color: white; border: 1px solid var(--primary); }
        .btn-primary:hover { background-color: #2980b9; border-color: #2980b9; }
        .theme-toggle {
            background: none; border: none; color: var(--dark); font-size: 1.2rem; cursor: pointer;
            padding: 0.5rem; transition: color 0.3s;
        }
        .theme-toggle:hover { color: var(--primary); }

        /* --- SIGN IN PAGE STYLES --- */
        .main-content {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 80px); /* Adjust 80px based on actual header height */
            padding: 2rem 0;
        }
        .signin-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .signin-title {
            color: var(--secondary);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .signin-subtitle {
            color: var(--gray);
            margin-bottom: 2rem;
        }
        .form-label {
            font-weight: 600;
            color: var(--secondary);
        }
        .input-group-text {
            background-color: var(--light);
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
            border-color: var(--primary);
        }
        .btn-signin {
            padding: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: transform 0.2s;
        }
        .btn-signin:hover {
             transform: translateY(-2px);
        }
        .forgot-password-link {
            font-size: 0.9rem;
            color: var(--gray);
            text-decoration: none;
            transition: color 0.3s;
        }
        .forgot-password-link:hover {
            color: var(--primary);
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--gray);
            margin: 2rem 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        .divider span {
            padding: 0 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            background-color: white;
            transition: background-color 0.3s;
        }
        .btn-social {
            padding: 0.75rem;
            font-weight: 500;
            width: 100%;
            border: 1px solid #dee2e6;
            transition: background-color 0.3s;
        }
        .btn-social:hover {
            background-color: #e9ecef;
        }
        .btn-social i {
            font-size: 1.2rem;
        }
        .signup-link {
            text-align: center;
            margin-top: 2rem;
            color: var(--gray);
        }
        .signup-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }
        
        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .navbar-collapse { margin-top: 1rem; }
            .navbar-nav { flex-direction: column; align-items: center; }
            .nav-item { margin-bottom: 0.75rem; }
        }
         @media (max-width: 576px) {
            .signin-card { padding: 2rem; }
         }

    </style>
</head>
<body data-theme="light">

    <!-- Header (Consistent with other pages) -->
    @include('layouts.header')

    <!-- Main Content -->
<main class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="signin-card">
                    <div class="text-center mb-4">
                        <h2 class="signin-title">Welcome Back!</h2>
                        <p class="signin-subtitle">Sign in to continue to kassbi</p>
                    </div>

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Sign In Form -->
                    <form action="{{ url('/signin') }}" method="POST">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="rememberMe">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="forgot-password-link">Forgot password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 btn-signin">Sign In</button>
                    </form>

                    <!-- Divider -->
                    <div class="divider my-4"><span>OR</span></div>

                    <!-- Social Sign In -->
                    <div class="d-grid gap-3">
                        <button class="btn btn-light btn-social">
                            <i class="bi bi-google me-2 text-danger"></i>
                            Sign in with Google
                        </button>
                        <button class="btn btn-light btn-social">
                            <i class="bi bi-linkedin me-2 text-primary"></i>
                            Sign in with LinkedIn
                        </button>
                    </div>

                    <!-- Sign Up Link -->
                    <p class="signup-link text-center mt-4">
                        Don't have an account? <a href="{{ url('/signup') }}">Sign up for free</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleBtn = document.querySelector('.theme-toggle');

            // --- THEME ---
            const applyTheme = (theme) => {
                document.body.setAttribute('data-theme', theme);
                const icon = themeToggleBtn.querySelector('i');
                icon.className = (theme === 'dark') ? 'fas fa-sun' : 'fas fa-moon';
                localStorage.setItem('theme', theme);
            };

            themeToggleBtn.addEventListener('click', e => {
                e.preventDefault();
                const newTheme = document.body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                applyTheme(newTheme);
            });
            
            // Load saved theme on page load
            applyTheme(localStorage.getItem('theme') || 'light');
        });
    </script>
</body>
</html>