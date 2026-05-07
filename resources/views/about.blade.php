@extends('layouts.app')
@section('title', 'About Nigat Jobs | Ethiopian Job Board')
@section('meta_desc', 'Learn about Nigat Jobs — Ethiopia\'s daily job aggregator bringing you the latest vacancies from top companies.')

@section('content')
<section class="page-hero">
    <div class="container">
        <h1>About Nigat Jobs</h1>
        <p>Ethiopia's daily source for job vacancies</p>
    </div>
</section>

<div class="container" style="padding:3rem 0 5rem;">

    {{-- Mission --}}
    <div class="row g-4 align-items-center mb-5">
        <div class="col-lg-6">
            <div class="detail-surface">
                <p class="section-label">Our Mission</p>
                <h2 class="section-title" style="margin-bottom:1rem;">Connecting Ethiopians with Opportunity</h2>
                <p style="color:var(--muted);line-height:1.9;">
                    Nigat Jobs was built to solve one problem: job seekers in Ethiopia spend hours checking multiple
                    websites and Telegram channels just to find today's vacancies. We automate that for you.
                </p>
                <p style="color:var(--muted);line-height:1.9;margin-top:.75rem;">
                    Every day our system monitors Ethiopia's top job channels, scrapes the full details, and publishes
                    them here in one place — with direct apply links, deadlines, and salary information. All free.
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row g-3">
                <div class="col-6">
                    <div class="feature-card text-center">
                        <div style="font-size:2rem;font-weight:800;color:var(--primary);">100+</div>
                        <div style="color:var(--muted);font-size:.9rem;margin-top:.3rem;">Jobs posted daily</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="feature-card text-center">
                        <div style="font-size:2rem;font-weight:800;color:var(--primary);">6</div>
                        <div style="color:var(--muted);font-size:.9rem;margin-top:.3rem;">Source channels monitored</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="feature-card text-center">
                        <div style="font-size:2rem;font-weight:800;color:var(--primary);">24/7</div>
                        <div style="color:var(--muted);font-size:.9rem;margin-top:.3rem;">Automated monitoring</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="feature-card text-center">
                        <div style="font-size:2rem;font-weight:800;color:var(--primary);">Free</div>
                        <div style="color:var(--muted);font-size:.9rem;margin-top:.3rem;">Always free to use</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- How it works --}}
    <div class="detail-surface mb-4">
        <p class="section-label">How It Works</p>
        <h2 class="section-title" style="margin-bottom:1.5rem;">Simple by Design</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div style="display:flex;gap:1rem;align-items:flex-start;">
                    <div style="width:40px;height:40px;background:rgba(37,99,235,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;color:var(--primary);">1</div>
                    <div>
                        <h6 style="font-weight:700;color:var(--text);margin-bottom:.3rem;">We Monitor</h6>
                        <p style="color:var(--muted);font-size:.9rem;line-height:1.7;">Our agent watches Ethiopia's top job Telegram channels around the clock for new vacancy posts.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div style="display:flex;gap:1rem;align-items:flex-start;">
                    <div style="width:40px;height:40px;background:rgba(37,99,235,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;color:var(--primary);">2</div>
                    <div>
                        <h6 style="font-weight:700;color:var(--text);margin-bottom:.3rem;">We Scrape</h6>
                        <p style="color:var(--muted);font-size:.9rem;line-height:1.7;">We visit the original job link and extract the full details — title, requirements, deadline, salary, and how to apply.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div style="display:flex;gap:1rem;align-items:flex-start;">
                    <div style="width:40px;height:40px;background:rgba(37,99,235,.1);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-weight:800;color:var(--primary);">3</div>
                    <div>
                        <h6 style="font-weight:700;color:var(--text);margin-bottom:.3rem;">You Apply</h6>
                        <p style="color:var(--muted);font-size:.9rem;line-height:1.7;">We publish the full job here with a direct apply link. You click Apply and go straight to the employer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Telegram CTA --}}
    <div style="background:linear-gradient(135deg,var(--primary),#1e3a5f);border-radius:var(--radius);padding:2.5rem;text-align:center;color:white;">
        <h3 style="font-weight:800;margin-bottom:.5rem;">Get Alerts on Telegram</h3>
        <p style="opacity:.85;margin-bottom:1.5rem;">Join our channel and receive new job postings directly in your Telegram app</p>
        <a href="https://t.me/ethiojobsNigatJobsEt" target="_blank" class="btn-tg" style="font-size:1rem;padding:.75rem 2rem;">
            <i class="fab fa-telegram"></i> Join @ethiojobsNigatJobsEt
        </a>
    </div>

</div>
@endsection
