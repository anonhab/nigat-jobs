@extends('layouts.app')

@section('title', 'Nigat Jobs | Latest Ethiopian Job Vacancies')
@section('meta_desc', 'Browse the latest Ethiopian job vacancies updated daily. Find your next opportunity.')

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

{{-- Job Cards --}}
<section style="padding:3rem 0;">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <p class="section-label">Latest Vacancies</p>
                <h2 class="section-title">Recent Job Listings</h2>
            </div>
        </div>

        {{-- Ad: Top of listings (leaderboard) --}}
        @include('partials.ad', ['slot' => 'SLOT_TOP', 'format' => 'horizontal'])

        <div class="row g-3">
            @forelse($jobs as $job)
            <div class="col-md-6 col-lg-4">
                @include('partials.job-card', ['job' => $job])
            </div>
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
