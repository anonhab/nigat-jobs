<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Post a new job opening on kassbi and find the best candidates.">
    <title>Post a Job | kassbi</title>

    <!-- Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Global Styles & Variables */
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray: #6c757d;
            --success: #28a745;
        }

        /* Dark Mode Theme */
        [data-theme="dark"] {
            --primary: #5cb8e6;
            --secondary: #f8f9fa;
            --light: #212529;
            --dark: #f8f9fa;
            --gray: #adb5bd;
            background-color: var(--light);
            color: var(--dark);
        }

        [data-theme="dark"] header,
        [data-theme="dark"] footer {
            background-color: #2c3e50;
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

        [data-theme="dark"] .form-card {
            background-color: #343a40;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        }

        [data-theme="dark"] .form-control {
            background-color: #495057;
            color: var(--dark);
            border-color: #6c757d;
        }

        [data-theme="dark"] .footer-logo-text,
        [data-theme="dark"] .footer-links-title,
        [data-theme="dark"] .footer-link a:hover,
        [data-theme="dark"] .social-link {
            color: white;
        }

        [data-theme="dark"] footer p {
            color: #adb5bd !important;
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

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--secondary);
        }

        .logo-icon {
            background-color: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--secondary);
        }

        .logo-text span {
            color: var(--primary);
        }

        .nav-link {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: 500;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: 1px solid var(--primary);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .theme-toggle {
            background: none;
            border: none;
            font-size: 1.2rem;
        }

        /* --- JOB POST PAGE STYLES --- */
        .page-header {
            background: var(--light);
            padding: 3rem 0;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }

        .form-section {
            padding: 4rem 0;
        }

        .form-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
        }

        .form-title {
            color: var(--secondary);
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
            border-color: var(--primary);
        }

        .input-group-text {
            background-color: #e9ecef;
        }

        .dynamic-field {
            margin-bottom: 0.75rem;
        }

        .btn-add {
            font-weight: 500;
        }

        .btn-remove {
            border: none;
            background: none;
            color: var(--danger);
        }

        hr {
            margin: 2.5rem 0;
        }

        /* --- FOOTER STYLES --- */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 4rem 0 0;
        }

        .footer-logo {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
        }

        .footer-logo-icon {
            background-color: var(--primary);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 0.75rem;
        }

        .footer-logo-text {
            font-size: 1.6rem;
            font-weight: bold;
        }

        .footer-links-title {
            font-size: 1.3rem;
            margin-bottom: 1.25rem;
            font-weight: 600;
        }

        .footer-links-list {
            list-style: none;
            padding: 0;
        }

        .footer-link {
            margin-bottom: 0.7rem;
        }

        .footer-link a {
            color: #adb5bd;
            text-decoration: none;
        }

        .footer-link a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 1.25rem;
            margin-top: 1.5rem;
        }

        .social-link {
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-link:hover {
            background-color: var(--primary);
        }

        .footer-bottom {
            padding: 1.75rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #adb5bd;
        }

        .footer-bottom a {
            color: #adb5bd;
            text-decoration: none;
        }

        /* --- FOOTER STYLES --- */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 4rem 0 0;
            transition: background-color 0.3s, color 0.3s;
        }

        footer .footer-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
        }

        footer .footer-logo-icon {
            background-color: var(--primary);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 0.75rem;
        }

        footer .footer-logo-text {
            font-size: 1.6rem;
            font-weight: bold;
        }

        footer .footer-links-title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        footer .footer-links-list {
            list-style: none;
            padding: 0;
        }

        footer .footer-link {
            margin-bottom: 0.5rem;
        }

        footer .footer-link a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer .footer-link a:hover {
            color: var(--primary);
        }

        footer .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        footer .social-link {
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 1.1rem;
        }

        footer .social-link:hover {
            background-color: var(--primary);
            transform: translateY(-3px);
        }

        footer .footer-bottom {
            padding: 1.5rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #adb5bd;
            font-size: 0.9rem;
        }

        footer .footer-bottom a {
            color: #adb5bd;
            text-decoration: none;
        }

        footer .footer-bottom a:hover {
            color: var(--primary);
        }

        /* --- DARK MODE FOOTER --- */
        [data-theme="dark"] footer {
            background-color: #1b1e23;
            color: #f8f9fa;
        }

        [data-theme="dark"] footer .footer-logo a,
        [data-theme="dark"] footer .footer-logo-text,
        [data-theme="dark"] footer .footer-links-title,
        [data-theme="dark"] footer .footer-link a,
        [data-theme="dark"] footer .social-link {
            color: #f8f9fa !important;
        }

        [data-theme="dark"] footer .footer-link a:hover,
        [data-theme="dark"] footer .social-link:hover,
        [data-theme="dark"] footer .footer-bottom a:hover {
            color: var(--primary) !important;
        }

        [data-theme="dark"] footer .footer-bottom {
            color: #adb5bd;
            border-top-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body data-theme="light">

    <!-- Header -->
    @include('layouts.header')
    <!-- Main Form Section -->
    <main class="form-section">

        <div class="container">

            <div class="row justify-content-center">
                {{-- Success & Error Messages --}}
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="col-lg-10 col-xl-8">
                    <div class="form-card">
                        <h3 class="form-title">Job Details</h3>
                        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Job Details -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Job Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required placeholder="e.g., Senior Laravel Developer">
                                </div>
                                <div class="col-md-6">
                                    <label for="company" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company" name="company" required placeholder="e.g., Acme Corporation">
                                </div>
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" required placeholder="e.g., San Francisco, CA">
                                </div>
                                <div class="col-md-6">
                                    <label for="type" class="form-label">Job Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Remote">Remote</option>
                                        <option value="Internship">Internship</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="salary_min" class="form-label">Minimum Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="salary_min" name="salary_min" required placeholder="e.g., 80000">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="salary_max" class="form-label">Maximum Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="salary_max" name="salary_max" required placeholder="e.g., 120000">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Job Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="6" required placeholder="Provide a detailed description of the job role..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Company Logo / Job Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                </div>
                            </div>

                            <hr>

                            <!-- Dynamic Responsibilities -->
                            <div class="mb-4">
                                <h4 class="h5 fw-bold">Responsibilities</h4>
                                <div id="responsibilities-container">
                                    <div class="input-group dynamic-field">
                                        <input type="text" name="responsibilities[]" class="form-control" placeholder="e.g., Develop and maintain web applications" required>
                                        <button class="btn-remove" type="button" aria-label="Remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm btn-add" data-container="responsibilities-container" data-name="responsibilities[]">
                                    <i class="fas fa-plus me-1"></i> Add Responsibility
                                </button>
                            </div>

                            <!-- Dynamic Requirements -->
                            <div class="mb-4">
                                <h4 class="h5 fw-bold">Requirements</h4>
                                <div id="requirements-container">
                                    <div class="input-group dynamic-field">
                                        <input type="text" name="requirements[]" class="form-control" placeholder="e.g., 3+ years of experience with PHP" required>
                                        <button class="btn-remove" type="button" aria-label="Remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm btn-add" data-container="requirements-container" data-name="requirements[]">
                                    <i class="fas fa-plus me-1"></i> Add Requirement
                                </button>
                            </div>

                            <!-- Dynamic Benefits -->
                            <div class="mb-4">
                                <h4 class="h5 fw-bold">Benefits</h4>
                                <div id="benefits-container">
                                    <div class="input-group dynamic-field">
                                        <input type="text" name="benefits[]" class="form-control" placeholder="e.g., Health Insurance">
                                        <button class="btn-remove" type="button" aria-label="Remove"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm btn-add" data-container="benefits-container" data-name="benefits[]">
                                    <i class="fas fa-plus me-1"></i> Add Benefit
                                </button>
                            </div>

                            <hr>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Submit Job Posting</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} kassbi. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- THEME TOGGLE SCRIPT ---
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


            // --- DYNAMIC FORM FIELD SCRIPT ---
            function handleDynamicFields() {
                // Add new field
                document.querySelectorAll('.btn-add').forEach(button => {
                    button.addEventListener('click', function() {
                        const containerId = this.dataset.container;
                        const container = document.getElementById(containerId);
                        const name = this.dataset.name;

                        const newField = document.createElement('div');
                        newField.classList.add('input-group', 'dynamic-field');
                        newField.innerHTML = `
                            <input type="text" name="${name}" class="form-control" required>
                            <button class="btn-remove" type="button" aria-label="Remove"><i class="fas fa-times"></i></button>
                        `;
                        container.appendChild(newField);
                    });
                });

                // Remove field (using event delegation)
                document.body.addEventListener('click', function(e) {
                    if (e.target.closest('.btn-remove')) {
                        const removeButton = e.target.closest('.btn-remove');
                        const fieldWrapper = removeButton.parentElement;
                        const container = fieldWrapper.parentElement;

                        // Prevent removing the last field
                        if (container.querySelectorAll('.dynamic-field').length > 1) {
                            fieldWrapper.remove();
                        } else {
                            // Optionally, clear the value instead of removing
                            fieldWrapper.querySelector('input').value = '';
                        }
                    }
                });
            }

            handleDynamicFields();
        });
    </script>
</body>

</html>