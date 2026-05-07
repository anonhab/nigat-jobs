@extends('layouts.app')

@section('title', 'Nigat Jobs | Latest Ethiopian Job Vacancies')
@section('meta_desc', 'Browse the latest Ethiopian job vacancies updated daily. Find your next opportunity.')

@push('head')
<style>
    /* ── Job Match Wizard ── */
    .match-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
        padding: 3.5rem 0;
        position: relative;
        overflow: hidden;
    }
    .match-section::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 70% 50%, rgba(124,58,237,.18) 0%, transparent 70%),
                    radial-gradient(ellipse at 20% 80%, rgba(37,99,235,.15) 0%, transparent 60%);
        pointer-events: none;
    }
    .match-title {
        font-size: clamp(1.4rem, 3vw, 2rem);
        font-weight: 800; color: white;
        margin-bottom: .35rem;
    }
    .match-sub { color: rgba(255,255,255,.6); font-size: .95rem; margin-bottom: 2rem; }

    /* Steps */
    .match-steps { display: flex; flex-direction: column; gap: 1.75rem; }
    .match-step-label {
        font-size: .72rem; font-weight: 800; letter-spacing: .1em;
        text-transform: uppercase; color: rgba(255,255,255,.45);
        margin-bottom: .75rem;
        display: flex; align-items: center; gap: .5rem;
    }
    .match-step-label .step-num {
        width: 20px; height: 20px; border-radius: 50%;
        background: rgba(124,58,237,.4);
        color: #a78bfa;
        font-size: .68rem; font-weight: 900;
        display: flex; align-items: center; justify-content: center;
    }

    /* Option cards */
    .match-options { display: flex; flex-wrap: wrap; gap: .6rem; }
    .match-options input[type="radio"] { display: none; }
    .match-opt-label {
        cursor: pointer;
        display: inline-flex; align-items: center; gap: .4rem;
        padding: .55rem 1.1rem;
        border-radius: 99px;
        font-size: .88rem; font-weight: 600;
        border: 1.5px solid rgba(255,255,255,.12);
        color: rgba(255,255,255,.6);
        background: rgba(255,255,255,.05);
        transition: all .18s;
        user-select: none;
        white-space: nowrap;
    }
    .match-opt-label i { font-size: .8rem; }
    .match-opt-label:hover {
        border-color: rgba(139,92,246,.6);
        color: white;
        background: rgba(139,92,246,.15);
    }
    .match-options input[type="radio"]:checked + .match-opt-label {
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 15px rgba(124,58,237,.4);
    }

    /* Find button */
    .btn-match {
        display: inline-flex; align-items: center; gap: .6rem;
        padding: .85rem 2.5rem;
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        color: white; border: none; border-radius: 12px;
        font-size: 1rem; font-weight: 700; cursor: pointer;
        transition: opacity .2s, transform .1s;
        box-shadow: 0 6px 24px rgba(124,58,237,.4);
        margin-top: .5rem;
    }
    .btn-match:hover { opacity: .9; }
    .btn-match:active { transform: scale(.98); }
    .btn-match:disabled { opacity: .4; cursor: not-allowed; }

    /* Match count badge */
    .match-count-badge {
        display: inline-flex; align-items: center; gap: .4rem;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 99px;
        padding: .3rem .85rem;
        font-size: .82rem; color: rgba(255,255,255,.65);
        margin-left: .75rem;
    }
    .match-count-badge strong { color: #a78bfa; }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="hero-band">
    <div class="container">
        <p class="section-label">🇪🇹 Ethiopia's Job Board</p>
        <h1>Find Your Next Opportunity</h1>
        <p>Daily vacancies from top Ethiopian companies and organisations</p>
        <form class="search-wrap" action="{{ route('jobs') }}" method="GET">
            <i class="bi bi-briefcase" style="color:#64748b;font-size:1rem;margin-left:.25rem;flex-shrink:0;"></i>
            <input type="text" name="search" placeholder="Job title, company, skill…" value="{{ request('search') }}" autocomplete="off">
            <button type="submit"><i class="bi bi-search me-1"></i>Search Jobs</button>
        </form>
    </div>
</section>

{{-- Stats bar --}}
@php $total = $jobs->total(); @endphp
<div style="background:var(--surface);border-bottom:1px solid var(--border);">
    <div class="container py-3 d-flex flex-wrap gap-4 align-items-center justify-content-between">
        <div class="d-flex gap-4">
            <div style="font-size:.9rem;color:var(--muted);">
                <strong style="color:var(--primary);font-size:1.1rem;">{{ $total }}</strong> jobs available
            </div>
            <div style="font-size:.9rem;color:var(--muted);">
                Updated <strong style="color:var(--text);">today</strong>
            </div>
        </div>
        <a href="{{ route('jobs') }}" class="btn-primary-custom" style="font-size:.85rem;padding:.4rem .9rem;">
            Browse All <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>

{{-- ── Job Match Wizard ── --}}
<section class="match-section">
    <div class="container" style="position:relative;z-index:1;">
        <div class="row align-items-center g-5">
            <div class="col-lg-4">
                <p class="match-title">Find Jobs <span style="background:linear-gradient(135deg,#60a5fa,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Made for You</span></p>
                <p class="match-sub">Tell us your background and we'll show you the best matching vacancies right now.</p>
                <div style="display:flex;align-items:center;flex-wrap:wrap;gap:.5rem;margin-top:1.5rem;">
                    <div style="width:8px;height:8px;border-radius:50%;background:#4ade80;box-shadow:0 0 8px #4ade80;"></div>
                    <span style="font-size:.82rem;color:rgba(255,255,255,.5);">{{ $total }} live vacancies ready to match</span>
                </div>
            </div>
            <div class="col-lg-8">
                <form action="{{ route('jobs') }}" method="GET" class="match-steps" id="matchForm">
                    {{-- Step 1: Education --}}
                    <div>
                        <div class="match-step-label">
                            <span class="step-num">1</span> Your Education Level
                        </div>
                        <div class="match-options">
                            @foreach([
                                'Certificate' => ['bi-patch-check',    'Certificate'],
                                'Diploma'     => ['bi-award',          'Diploma'],
                                "Bachelor's"  => ['bi-journal-bookmark','Bachelor\'s'],
                                "Master's"    => ['bi-journal-bookmark-fill',"Master's"],
                                'PhD'         => ['bi-bookmark-star',  'PhD'],
                            ] as $val => [$icon, $label])
                                <input type="radio" name="education" id="me_{{ $loop->index }}" value="{{ $val }}">
                                <label class="match-opt-label" for="me_{{ $loop->index }}">
                                    <i class="bi {{ $icon }}"></i> {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Step 2: Experience --}}
                    <div>
                        <div class="match-step-label">
                            <span class="step-num">2</span> Your Work Experience
                        </div>
                        <div class="match-options">
                            @foreach([
                                'Fresh'     => ['bi-emoji-smile',   'Fresh Graduate'],
                                '1+ Year'   => ['bi-bar-chart',     '1+ Year'],
                                '2+ Years'  => ['bi-bar-chart-fill','2+ Years'],
                                '3-5 Years' => ['bi-graph-up',      '3–5 Years'],
                                '5+ Years'  => ['bi-graph-up-arrow','5+ Years'],
                                '10+ Years' => ['bi-star-fill',     '10+ Years'],
                            ] as $val => [$icon, $label])
                                <input type="radio" name="experience" id="mx_{{ $loop->index }}" value="{{ $val }}">
                                <label class="match-opt-label" for="mx_{{ $loop->index }}">
                                    <i class="bi {{ $icon }}"></i> {{ $label }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div>
                        <button type="submit" class="btn-match" id="matchBtn">
                            <i class="bi bi-stars"></i>
                            Find My Matching Jobs
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Job Cards --}}
<section style="padding:3rem 0;">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <p class="section-label">Latest Vacancies</p>
                <h2 class="section-title">Recent Job Listings</h2>
            </div>
        </div>

        {{-- Ad: Top of listings --}}
        <div class="text-center mb-3">
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-7852365660336296"
                 data-ad-slot="auto"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
        </div>

        <div class="row g-3">
            @forelse($jobs as $job)
            <div class="col-md-6 col-lg-4">
                @include('partials.job-card', ['job' => $job])
            </div>
            {{-- Ad: after every 6th job card --}}
            @if($loop->iteration % 6 === 0 && !$loop->last)
            <div class="col-12">
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-7852365660336296"
                     data-ad-slot="auto"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
            @endif
            @empty
            <div class="col-12 empty-state">
                <i class="bi bi-inbox d-block"></i>
                <p>No jobs yet — check back soon.</p>
            </div>
            @endforelse
        </div>

        @if($jobs->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $jobs->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('jobs') }}" class="btn-primary-custom">
                View All Jobs <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- Features --}}
<section style="padding:3rem 0;background:var(--surface);border-top:1px solid var(--border);">
    <div class="container">
        <div class="text-center mb-4">
            <p class="section-label">Why Nigat Jobs</p>
            <h2 class="section-title">Simple. Fast. Free.</h2>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                    <h5 style="font-weight:700;margin-bottom:.4rem;">Daily Updates</h5>
                    <p style="color:var(--muted);font-size:.9rem;">New vacancies scraped and posted every day from Ethiopia's top job channels.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fab fa-telegram"></i></div>
                    <h5 style="font-weight:700;margin-bottom:.4rem;">Telegram Alerts</h5>
                    <p style="color:var(--muted);font-size:.9rem;">Join our Telegram channel and get instant alerts for new job postings.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-bullseye"></i></div>
                    <h5 style="font-weight:700;margin-bottom:.4rem;">Full Details</h5>
                    <p style="color:var(--muted);font-size:.9rem;">Each job includes requirements, deadline, salary, and a direct apply link.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Newsletter --}}
<section class="newsletter-band">
    <div class="container">
        <h2>Get Job Alerts on Telegram</h2>
        <p>Join our channel and be the first to know about new vacancies</p>
        <div style="display:flex;justify-content:center;">
            <a href="https://t.me/for_sale89" target="_blank" class="btn-tg" style="font-size:1rem;padding:.75rem 2rem;">
                <i class="fab fa-telegram"></i> Join @for_sale89
            </a>
        </div>
    </div>
</section>

@endsection
