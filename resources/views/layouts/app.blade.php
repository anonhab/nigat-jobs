<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_desc', 'Nigat Jobs — Latest Ethiopian job vacancies updated daily.')">
    <title>@yield('title', 'Nigat Jobs | Find Your Career')</title>

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="@yield('title', 'Nigat Jobs | Find Your Career')">
    <meta property="og:description" content="@yield('meta_desc', 'Nigat Jobs — Latest Ethiopian job vacancies updated daily.')">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:site_name"   content="Nigat Jobs">

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary">
    <meta name="twitter:title"       content="@yield('title', 'Nigat Jobs')">
    <meta name="twitter:description" content="@yield('meta_desc', 'Nigat Jobs — Latest Ethiopian job vacancies.')">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google AdSense — replace ca-pub-XXXXXXXXXXXXXXXX with your Publisher ID --}}
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
            crossorigin="anonymous"></script>

    <style>
        /* ── Variables ── */
        :root {
            --primary:   #2563eb;
            --primary-h: #1d4ed8;
            --secondary: #1e293b;
            --accent:    #f59e0b;
            --bg:        #f1f5f9;
            --surface:   #ffffff;
            --border:    #e2e8f0;
            --text:      #1e293b;
            --muted:     #64748b;
            --radius:    12px;
            --shadow:    0 4px 20px rgba(0,0,0,.08);
            --shadow-lg: 0 8px 32px rgba(0,0,0,.13);
            --transition: .25s ease;
        }
        [data-theme="dark"] {
            --bg:      #0f172a;
            --surface: #1e293b;
            --border:  #334155;
            --text:    #f1f5f9;
            --muted:   #94a3b8;
            --shadow:  0 4px 20px rgba(0,0,0,.4);
            --shadow-lg: 0 8px 32px rgba(0,0,0,.5);
        }

        /* ── Base ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            transition: background var(--transition), color var(--transition);
        }
        a { color: inherit; }
        img { max-width: 100%; }

        /* ── Navbar ── */
        .site-nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: background var(--transition), border-color var(--transition);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .85rem 0;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: .6rem;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text);
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: var(--primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-weight: 800;
            font-size: .95rem;
            flex-shrink: 0;
        }
        .brand span { color: var(--primary); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: .25rem;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--muted);
            font-weight: 500;
            font-size: .95rem;
            padding: .45rem .85rem;
            border-radius: 8px;
            transition: color var(--transition), background var(--transition);
        }
        .nav-links a:hover,
        .nav-links a.active { color: var(--primary); background: rgba(37,99,235,.08); }

        .btn-tg {
            display: inline-flex; align-items: center; gap: .4rem;
            background: #2CA5E0; color: white;
            padding: .45rem 1rem;
            border-radius: 8px;
            font-size: .9rem; font-weight: 600;
            text-decoration: none;
            transition: background var(--transition);
        }
        .btn-tg:hover { background: #1a8fc7; color: white; }

        .theme-btn {
            background: none; border: none;
            color: var(--muted);
            font-size: 1.1rem;
            cursor: pointer;
            padding: .45rem .55rem;
            border-radius: 8px;
            transition: color var(--transition), background var(--transition);
            line-height: 1;
        }
        .theme-btn:hover { color: var(--primary); background: rgba(37,99,235,.08); }

        /* mobile toggle */
        .nav-toggle {
            display: none;
            background: none; border: none;
            color: var(--text); font-size: 1.4rem;
            cursor: pointer; padding: .3rem;
        }
        @media (max-width: 768px) {
            .nav-toggle { display: block; }
            .nav-links {
                display: none;
                flex-direction: column;
                align-items: stretch;
                gap: .1rem;
                position: absolute;
                top: 100%; left: 0; right: 0;
                background: var(--surface);
                border-bottom: 1px solid var(--border);
                padding: .75rem 1rem;
                box-shadow: var(--shadow);
            }
            .nav-links.open { display: flex; }
            .nav-links a { padding: .6rem .75rem; }
            .site-nav { position: relative; }
        }

        /* ── Hero Banner ── */
        .hero-band {
            background: linear-gradient(135deg, var(--primary) 0%, #1e3a5f 100%);
            color: white;
            padding: 4.5rem 0 3.5rem;
            text-align: center;
        }
        .hero-band h1 { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 800; margin-bottom: .75rem; }
        .hero-band p  { font-size: 1.1rem; opacity: .9; max-width: 600px; margin: 0 auto 2rem; }

        /* ── Search bar ── */
        .search-wrap {
            background: white;
            border-radius: var(--radius);
            padding: .6rem;
            display: flex;
            gap: .5rem;
            max-width: 620px;
            margin: 0 auto;
            box-shadow: 0 8px 24px rgba(0,0,0,.18);
        }
        .search-wrap input {
            flex: 1; border: none; outline: none;
            padding: .55rem .75rem;
            font-size: 1rem;
            background: transparent;
            color: #1e293b;
        }
        .search-wrap button {
            background: var(--primary); color: white;
            border: none; border-radius: 8px;
            padding: .55rem 1.4rem;
            font-weight: 600; cursor: pointer;
            transition: background var(--transition);
            white-space: nowrap;
        }
        .search-wrap button:hover { background: var(--primary-h); }

        /* ── Cards ── */
        .card-job {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow);
            transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
            height: 100%;
            display: flex; flex-direction: column;
            overflow: hidden;
        }
        .card-job:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 36px rgba(0,0,0,.13);
            border-color: rgba(37,99,235,.35);
        }
        .card-body-job {
            padding: 1.4rem 1.5rem 1.3rem;
            display: flex; flex-direction: column; flex: 1;
        }
        /* Header row */
        .card-header-row {
            display: flex; align-items: flex-start;
            justify-content: space-between; gap: .6rem;
            margin-bottom: .9rem;
        }
        /* Company avatar */
        .company-avatar {
            width: 50px; height: 50px; border-radius: 12px;
            border: 1.5px solid transparent;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.05rem;
            flex-shrink: 0; letter-spacing: -.5px;
        }
        .company-name {
            font-size: .9rem; font-weight: 700; color: var(--text);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            max-width: 180px;
        }
        .card-location {
            font-size: .82rem; color: var(--muted);
            display: flex; align-items: center; gap: .25rem; margin-top: .15rem;
        }
        .card-location i { font-size: .75rem; color: #dc2626; }
        /* New badge */
        .badge-new {
            font-size: .68rem; font-weight: 800; letter-spacing: .05em;
            text-transform: uppercase;
            background: #dcfce7; color: #15803d;
            border-radius: 6px; padding: .22rem .6rem;
            flex-shrink: 0; align-self: flex-start;
            white-space: nowrap;
        }
        [data-theme="dark"] .badge-new { background: rgba(21,128,61,.25); color: #4ade80; }
        /* Job title */
        .card-title-job {
            font-size: 1.07rem; font-weight: 700; color: var(--text);
            line-height: 1.45; margin: 0 0 .7rem;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }
        /* Tag row */
        .card-tags { display: flex; flex-wrap: wrap; gap: .4rem; margin-bottom: .8rem; }
        .jtag {
            display: inline-flex; align-items: center; gap: .3rem;
            font-size: .78rem; font-weight: 700;
            padding: .3rem .75rem; border-radius: 99px;
            white-space: nowrap;
        }
        .jtag i { font-size: .72rem; }
        .jtag-type  { background: color-mix(in srgb, var(--tc) 12%, transparent); color: var(--tc,#2563eb); }
        .jtag-edu   { background: rgba(16,185,129,.1);  color: #059669; }
        .jtag-exp   { background: rgba(139,92,246,.1);  color: #7c3aed; }
        .jtag-salary{ background: rgba(245,158,11,.1);  color: #b45309; }
        [data-theme="dark"] .jtag-edu  { color: #34d399; }
        [data-theme="dark"] .jtag-exp  { color: #a78bfa; }
        [data-theme="dark"] .jtag-salary{ color: #fbbf24; }
        /* Card footer */
        .card-footer-job {
            display: flex; align-items: center;
            justify-content: space-between; gap: .5rem;
            margin-top: auto; padding-top: .9rem;
            border-top: 1px solid var(--border);
        }
        .deadline-text {
            font-size: .82rem; color: #b45309; font-weight: 600;
            display: flex; align-items: center; gap: .3rem;
        }
        .deadline-urgent { color: #dc2626; }
        .card-btns { display: flex; gap: .4rem; flex-shrink: 0; }
        .btn-card-view {
            padding: .46rem .9rem;
            border: 1.5px solid var(--border);
            border-radius: 8px; color: var(--muted);
            font-size: .84rem; font-weight: 700;
            text-decoration: none;
            transition: border-color .18s, color .18s, background .18s;
            white-space: nowrap;
        }
        .btn-card-view:hover { border-color: var(--primary); color: var(--primary); background: rgba(37,99,235,.05); }
        .btn-card-apply {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .46rem 1rem;
            background: var(--primary); color: white;
            border-radius: 8px;
            font-size: .84rem; font-weight: 700;
            text-decoration: none;
            transition: background .18s;
            white-space: nowrap;
        }
        .btn-card-apply:hover { background: var(--primary-h); color: white; }
        /* Legacy aliases (used in a few spots) */
        .tag { display:inline-block;font-size:.75rem;font-weight:600;padding:.2rem .65rem;border-radius:99px;background:rgba(37,99,235,.1);color:var(--primary);margin-right:.3rem;margin-bottom:.3rem; }
        .tag-orange { background:rgba(245,158,11,.12);color:#b45309; }
        .deadline-tag { font-size:.78rem;color:#d97706;font-weight:600; }
        .card-meta { font-size:.83rem;color:var(--muted);display:flex;align-items:center;gap:.3rem;margin-bottom:.3rem; }
        .card-meta i { color:var(--primary);font-size:.8rem; }

        /* ── Filter bar ── */
        .filter-bar {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem 1.5rem;
            box-shadow: var(--shadow);
        }
        .filter-bar .form-control,
        .filter-bar .form-select {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 8px;
        }
        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37,99,235,.15);
        }
        .filter-bar label { color: var(--muted); font-size: .85rem; font-weight: 600; }

        /* ── Buttons ── */
        .btn-primary-custom {
            background: var(--primary); color: white;
            border: none; border-radius: 8px;
            padding: .55rem 1.25rem;
            font-weight: 600; cursor: pointer;
            text-decoration: none; display: inline-flex; align-items: center; gap: .4rem;
            transition: background var(--transition);
        }
        .btn-primary-custom:hover { background: var(--primary-h); color: white; }
        .btn-outline-custom {
            background: transparent;
            border: 1.5px solid var(--border);
            color: var(--muted);
            border-radius: 8px;
            padding: .55rem .9rem;
            cursor: pointer;
            text-decoration: none; display: inline-flex; align-items: center;
            transition: border-color var(--transition), color var(--transition);
        }
        .btn-outline-custom:hover { border-color: var(--primary); color: var(--primary); }

        /* ── Section label ── */
        .section-label {
            font-size: .75rem; font-weight: 700; letter-spacing: .1em;
            text-transform: uppercase; color: var(--primary);
            margin-bottom: .4rem;
        }
        .section-title {
            font-size: clamp(1.4rem, 2.5vw, 1.9rem);
            font-weight: 800; color: var(--text);
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center; padding: 4rem 1rem;
            color: var(--muted);
        }
        .empty-state i { font-size: 3rem; margin-bottom: 1rem; opacity: .4; }

        /* ── Page hero (inner pages) ── */
        .page-hero {
            background: linear-gradient(135deg, var(--primary) 0%, #1e3a5f 100%);
            color: white; padding: 3rem 0 2.5rem;
        }
        .page-hero h1 { font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; }
        .page-hero p  { opacity: .85; margin-top: .5rem; }
        .breadcrumb-back {
            font-size: .85rem; color: rgba(255,255,255,.75);
            text-decoration: none; display: inline-flex; align-items: center; gap: .3rem;
            margin-bottom: .75rem;
            transition: color .2s;
        }
        .breadcrumb-back:hover { color: white; }

        /* ── Detail card ── */
        .detail-surface {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2rem;
        }
        .field-row {
            display: flex; flex-wrap: wrap; gap: .6rem; margin-bottom: 1.25rem;
        }
        .field-chip {
            display: inline-flex; align-items: center; gap: .4rem;
            background: var(--bg); border: 1px solid var(--border);
            border-radius: 8px; padding: .4rem .85rem;
            font-size: .85rem; color: var(--text);
        }
        .field-chip i { color: var(--primary); }
        .section-heading {
            font-size: 1rem; font-weight: 700; color: var(--text);
            border-left: 3px solid var(--primary);
            padding-left: .65rem; margin: 1.75rem 0 .75rem;
        }
        .desc-block { white-space: pre-wrap; line-height: 1.85; color: var(--muted); font-size: .95rem; }
        .deadline-pill {
            display: inline-flex; align-items: center; gap: .4rem;
            background: #fef3c7; color: #92400e;
            border-radius: 8px; padding: .4rem .9rem;
            font-size: .85rem; font-weight: 700;
        }
        [data-theme="dark"] .deadline-pill { background: rgba(245,158,11,.15); color: #fbbf24; }
        .apply-big {
            display: block; text-align: center;
            background: var(--primary); color: white;
            border-radius: 10px; padding: .85rem 1.5rem;
            font-size: 1rem; font-weight: 700;
            text-decoration: none;
            transition: background var(--transition);
        }
        .apply-big:hover { background: var(--primary-h); color: white; }
        .apply-email-btn {
            display: flex; align-items: center; justify-content: center; gap: .5rem;
            background: rgba(37,99,235,.08);
            color: var(--primary);
            border: 1.5px solid rgba(37,99,235,.25);
            border-radius: 10px; padding: .75rem 1.25rem;
            font-size: .92rem; font-weight: 700;
            text-decoration: none; word-break: break-all;
            transition: background .18s, border-color .18s;
        }
        .apply-email-btn:hover { background: rgba(37,99,235,.14); border-color: var(--primary); color: var(--primary); }

        /* ── Footer ── */
        .site-footer {
            background: var(--secondary);
            color: #cbd5e1;
            padding: 3rem 0 0;
            margin-top: 5rem;
        }
        [data-theme="dark"] .site-footer { background: #020617; }
        .footer-brand { font-size: 1.2rem; font-weight: 700; color: white; display: flex; align-items: center; gap: .5rem; }
        .footer-desc { font-size: .9rem; color: #94a3b8; margin-top: .6rem; max-width: 280px; line-height: 1.7; }
        .footer-heading { font-size: .8rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #94a3b8; margin-bottom: .9rem; }
        .footer-links { list-style: none; padding: 0; }
        .footer-links li { margin-bottom: .5rem; }
        .footer-links a { color: #94a3b8; text-decoration: none; font-size: .9rem; transition: color .2s; }
        .footer-links a:hover { color: white; }
        .social-row { display: flex; gap: .6rem; margin-top: 1rem; }
        .social-btn {
            width: 36px; height: 36px; border-radius: 8px;
            background: rgba(255,255,255,.08);
            color: #94a3b8;
            display: flex; align-items: center; justify-content: center;
            text-decoration: none; font-size: .95rem;
            transition: background .2s, color .2s;
        }
        .social-btn:hover { background: var(--primary); color: white; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.07);
            padding: 1.25rem 0;
            text-align: center;
            font-size: .85rem;
            color: #64748b;
            margin-top: 2.5rem;
        }

        /* ── Contact ── */
        .contact-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 2rem;
        }
        .info-item {
            display: flex; align-items: flex-start; gap: 1rem;
            padding: 1.1rem; border-radius: 10px;
            background: var(--bg);
            margin-bottom: 1rem;
        }
        .info-icon {
            width: 42px; height: 42px; border-radius: 10px;
            background: rgba(37,99,235,.1); color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .info-icon i { color: var(--primary); }

        /* ── Features ── */
        .feature-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2rem 1.5rem;
            text-align: center;
            transition: transform var(--transition), box-shadow var(--transition);
        }
        .feature-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
        .feature-icon {
            width: 60px; height: 60px; margin: 0 auto 1.1rem;
            background: rgba(37,99,235,.1); border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: var(--primary);
        }

        /* ── Newsletter ── */
        .newsletter-band {
            background: linear-gradient(135deg, var(--primary), #1e3a5f);
            color: white; padding: 3.5rem 0; text-align: center;
        }
        .newsletter-band h2 { font-size: 1.7rem; font-weight: 800; }
        .newsletter-band p  { opacity: .85; margin: .5rem 0 1.75rem; }
        .newsletter-form {
            display: flex; gap: .5rem; max-width: 460px; margin: 0 auto;
        }
        .newsletter-form input {
            flex: 1; padding: .7rem 1rem; border: none; border-radius: 8px;
            font-size: .95rem; outline: none;
        }
        .newsletter-form button {
            background: var(--accent); color: white; border: none;
            border-radius: 8px; padding: .7rem 1.4rem;
            font-weight: 700; cursor: pointer;
            transition: background .2s;
        }
        .newsletter-form button:hover { background: #d97706; }
        @media (max-width: 480px) {
            .newsletter-form { flex-direction: column; }
        }

        /* ── Pagination ── */
        .page-link { color: var(--primary); }
        .page-item.active .page-link { background: var(--primary); border-color: var(--primary); }
        [data-theme="dark"] .page-link { background: var(--surface); border-color: var(--border); color: var(--primary); }
        [data-theme="dark"] .page-item.disabled .page-link { background: var(--surface); border-color: var(--border); }

        /* ── Form controls global dark fix ── */
        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select {
            background: #1e293b; color: #f1f5f9; border-color: #334155;
        }
        [data-theme="dark"] .form-control::placeholder { color: #64748b; }
    </style>
    @stack('head')
</head>
<body data-theme="light">

{{-- ── Navbar ── --}}
<nav class="site-nav">
    <div class="container">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="brand">
                <div class="brand-icon">NJ</div>
                <span>Nigat<span> Jobs</span></span>
            </a>

            <button class="nav-toggle" id="navToggle" aria-label="Menu">
                <i class="bi bi-list"></i>
            </button>

            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('jobs') }}" class="{{ request()->routeIs('jobs') ? 'active' : '' }}">Browse Jobs</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                <li>
                    <a href="https://t.me/for_sale89" target="_blank" class="btn-tg">
                        <i class="fab fa-telegram"></i> Telegram
                    </a>
                </li>
                <li>
                    <button class="theme-btn" id="themeToggle" aria-label="Toggle dark mode">
                        <i class="bi bi-moon-fill" id="themeIcon"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- ── Page Content ── --}}
@yield('content')

{{-- ── Footer ── --}}
<footer class="site-footer">
    <div class="container">
        <div class="row g-4 pb-4">
            <div class="col-lg-4">
                <div class="footer-brand">
                    <div class="brand-icon">NJ</div>
                    Nigat Jobs
                </div>
                <p class="footer-desc">Your daily source for Ethiopian job vacancies. We aggregate the latest opportunities so you never miss a chance.</p>
                <div class="social-row">
                    <a href="https://t.me/for_sale89" target="_blank" class="social-btn" aria-label="Telegram"><i class="fab fa-telegram"></i></a>
                    <a href="#" class="social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <p class="footer-heading">Navigation</p>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('jobs') }}">Browse Jobs</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-6">
                <p class="footer-heading">Job Categories</p>
                <ul class="footer-links">
                    <li><a href="{{ route('jobs', ['type'=>'Full Time']) }}">Full Time</a></li>
                    <li><a href="{{ route('jobs', ['type'=>'Part Time']) }}">Part Time</a></li>
                    <li><a href="{{ route('jobs', ['type'=>'Contract']) }}">Contract</a></li>
                    <li><a href="{{ route('jobs', ['type'=>'Remote']) }}">Remote</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <p class="footer-heading">Join our Telegram</p>
                <p style="font-size:.88rem;color:#94a3b8;line-height:1.7;">Get instant job alerts on Telegram before they fill up.</p>
                <a href="https://t.me/for_sale89" target="_blank" class="btn-tg mt-2 d-inline-flex">
                    <i class="fab fa-telegram"></i> @for_sale89
                </a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            &copy; {{ date('Y') }} Nigat Jobs. All rights reserved. &nbsp;|&nbsp;
            <a href="{{ route('privacy') }}" style="color:#64748b;text-decoration:none;">Privacy Policy</a> &nbsp;|&nbsp;
            <a href="{{ route('terms') }}"   style="color:#64748b;text-decoration:none;">Terms of Use</a> &nbsp;|&nbsp;
            <a href="{{ route('about') }}"   style="color:#64748b;text-decoration:none;">About Us</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        // Theme
        const body    = document.body;
        const icon    = document.getElementById('themeIcon');
        const btn     = document.getElementById('themeToggle');
        const saved   = localStorage.getItem('theme') || 'light';

        function applyTheme(t) {
            body.setAttribute('data-theme', t);
            if (icon) icon.className = t === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
            localStorage.setItem('theme', t);
        }
        applyTheme(saved);
        if (btn) btn.addEventListener('click', () => {
            applyTheme(body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        });

        // Mobile nav
        const toggle   = document.getElementById('navToggle');
        const navLinks = document.getElementById('navLinks');
        if (toggle) toggle.addEventListener('click', () => navLinks.classList.toggle('open'));
    })();
</script>
@stack('scripts')
</body>
</html>
