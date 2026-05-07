<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create a new kassbi account to start applying for jobs.">
    <title>Sign Up | kassbi</title>

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
        [data-theme="dark"] .auth-card {
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
        [data-theme="dark"] .form-check-label {
            color: var(--gray);
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

        /* --- HEADER STYLES --- */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .logo { display: flex; align-items: center; text-decoration: none; color: var(--secondary); }
        .logo-icon {
            background-color: var(--primary); color: white; width: 40px; height: 40px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-weight: bold; margin-right: 0.5rem; flex-shrink: 0;
        }
        .logo-text { font-size: 1.5rem; font-weight: bold; color: var(--secondary); }
        .logo-text span { color: var(--primary); }
        .nav-link { text-decoration: none; color: var(--dark); font-weight: 500; }
        .nav-link:hover { color: var(--primary); }
        .btn { padding: 0.5rem 1rem; border-radius: 4px; font-weight: 500; }
        .btn-outline { background-color: transparent; border: 1px solid var(--primary); color: var(--primary); }
        .btn-outline:hover { background-color: var(--primary); color: white; }
        .btn-primary { background-color: var(--primary); color: white; border: 1px solid var(--primary); }
        .btn-primary:hover { background-color: #2980b9; border-color: #2980b9; }
        .theme-toggle { background: none; border: none; font-size: 1.2rem; }

        /* --- AUTH PAGE STYLES (Sign In / Sign Up) --- */
        .main-content {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 80px); /* Adjust based on header height */
            padding: 2rem 0;
        }
        .auth-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
        }
        .auth-title { color: var(--secondary); font-weight: 700; margin-bottom: 0.5rem; }
        .auth-subtitle { color: var(--gray); margin-bottom: 2rem; }
        .form-label { font-weight: 600; color: var(--secondary); }
        .input-group-text { background-color: var(--light); border-right: none; }
        .form-control { border-left: none; }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
            border-color: var(--primary);
        }
        .btn-auth { padding: 0.8rem; font-weight: 600; }
        .divider {
            display: flex; align-items: center; text-align: center;
            color: var(--gray); margin: 2rem 0;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; border-bottom: 1px solid #dee2e6;
        }
        .divider span { padding: 0 1rem; background-color: white; }
        .btn-social { padding: 0.75rem; font-weight: 500; width: 100%; border: 1px solid #dee2e6; }
        .btn-social:hover { background-color: #e9ecef; }
        .btn-social i { font-size: 1.2rem; }
        .auth-link { text-align: center; margin-top: 2rem; color: var(--gray); }
        .auth-link a { color: var(--primary); font-weight: 600; text-decoration: none; }
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
                    <div class="auth-card">
                        <div class="text-center">
                            <h2 class="auth-title">Create Your Account</h2>
                            <p class="auth-subtitle">Join kassbi to find your dream job</p>
                        </div>

                        <!-- Sign Up Form -->
                        <form action="{{ url('/register') }}" method="POST">
                            @csrf
                            <!-- Full Name Input -->
                             <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                                </div>
                            </div>

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

                             <!-- Confirm Password Input -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 btn-auth">Create Account</button>
                        </form>

                        <!-- Divider -->
                        <div class="divider"><span>OR</span></div>
                        
                        <!-- Social Sign Up -->
                        <div class="d-grid gap-3">
                            <button class="btn btn-light btn-social">
                                <i class="bi bi-google me-2 text-danger"></i>
                                Sign up with Google
                            </button>
                            <button class="btn btn-light btn-social">
                                <i class="bi bi-linkedin me-2 text-primary"></i>
                                Sign up with LinkedIn
                            </button>
                        </div>
                        
                        <!-- Sign In Link -->
                        <p class="auth-link">
                            Already have an account? <a href="{{ url('/signin') }}">Sign In</a>
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
            
            applyTheme(localStorage.getItem('theme') || 'light');
        });
    </script>
</body>
</html>