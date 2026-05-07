@extends('layouts.app')

@section('title', 'Contact Us | Nigat Jobs')
@section('meta_desc', 'Get in touch with Nigat Jobs for support or enquiries.')

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Get In Touch</h1>
        <p>Have a question or feedback? We'd love to hear from you.</p>
    </div>
</section>

<div class="container" style="padding:3rem 0 5rem;">
    <div class="row g-4">

        {{-- Form --}}
        <div class="col-lg-7">
            <div class="contact-card">
                <div class="section-heading" style="margin-top:0;">Send Us a Message</div>
                <form action="#" method="POST" class="mt-3">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:.85rem;font-weight:600;color:var(--muted);">Full Name</label>
                            <input type="text" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-size:.85rem;font-weight:600;color:var(--muted);">Email Address</label>
                            <input type="email" class="form-control" placeholder="you@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-size:.85rem;font-weight:600;color:var(--muted);">Subject</label>
                            <input type="text" class="form-control" placeholder="How can we help?" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-size:.85rem;font-weight:600;color:var(--muted);">Message</label>
                            <textarea class="form-control" rows="6" placeholder="Write your message here..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-primary-custom w-100 justify-content-center" style="padding:.75rem;">
                                <i class="bi bi-send me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info --}}
        <div class="col-lg-5">
            <div class="contact-card h-100">
                <div class="section-heading" style="margin-top:0;">Contact Information</div>
                <div class="info-item">
                    <div class="info-icon"><i class="fab fa-telegram"></i></div>
                    <div>
                        <div style="font-weight:700;color:var(--text);margin-bottom:.2rem;">Telegram Channel</div>
                        <a href="https://t.me/ethiojobsNigatJobsEt" target="_blank" style="color:var(--primary);text-decoration:none;font-size:.9rem;">@ethiojobsNigatJobsEt</a>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="bi bi-envelope"></i></div>
                    <div>
                        <div style="font-weight:700;color:var(--text);margin-bottom:.2rem;">Email</div>
                        <span style="color:var(--muted);font-size:.9rem;">support@nigatjobs.et</span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <div style="font-weight:700;color:var(--text);margin-bottom:.2rem;">Location</div>
                        <span style="color:var(--muted);font-size:.9rem;">Addis Ababa, Ethiopia</span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="bi bi-clock"></i></div>
                    <div>
                        <div style="font-weight:700;color:var(--text);margin-bottom:.2rem;">Response Time</div>
                        <span style="color:var(--muted);font-size:.9rem;">Within 24 hours</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
