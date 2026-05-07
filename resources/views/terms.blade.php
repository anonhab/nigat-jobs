@extends('layouts.app')
@section('title', 'Terms of Use | Nigat Jobs')
@section('meta_desc', 'Read the Nigat Jobs terms of use before using our job board.')

@section('content')
<section class="page-hero">
    <div class="container">
        <h1>Terms of Use</h1>
        <p>Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<div class="container" style="padding:3rem 0 5rem;max-width:820px;">
    <div class="detail-surface">
        <div class="section-heading" style="margin-top:0;">1. Acceptance of Terms</div>
        <p style="color:var(--muted);line-height:1.9;">
            By accessing and using <strong style="color:var(--text);">Nigat Jobs</strong> ("the website"), you accept and agree to be bound by these Terms of Use.
            If you do not agree to these terms, please do not use this website.
        </p>

        <div class="section-heading">2. Purpose of the Website</div>
        <p style="color:var(--muted);line-height:1.9;">
            Nigat Jobs is an informational job board that aggregates publicly available job vacancies posted on Ethiopian
            job websites and Telegram channels. We do not act as a recruiter or employer, and we do not guarantee employment.
        </p>

        <div class="section-heading">3. Job Listings</div>
        <ul style="color:var(--muted);line-height:2;padding-left:1.5rem;">
            <li>All job listings are sourced from publicly available third-party websites and channels.</li>
            <li>Nigat Jobs does not verify the accuracy or legitimacy of any job posting.</li>
            <li>Users apply to jobs directly through the employer's website. Nigat Jobs is not a party to any application.</li>
            <li>Always verify the authenticity of a job before submitting personal information to an employer.</li>
        </ul>

        <div class="section-heading">4. Intellectual Property</div>
        <p style="color:var(--muted);line-height:1.9;">
            The Nigat Jobs website design, logo, and original content are the property of Nigat Jobs. Job descriptions are
            sourced from third-party publishers and remain the property of their respective owners.
        </p>

        <div class="section-heading">5. Limitation of Liability</div>
        <p style="color:var(--muted);line-height:1.9;">
            Nigat Jobs is provided "as is" without warranties of any kind. We are not liable for any losses or damages
            arising from your use of the website, reliance on job listings, or interactions with third-party employers.
        </p>

        <div class="section-heading">6. Advertising</div>
        <p style="color:var(--muted);line-height:1.9;">
            This website displays advertisements served by Google AdSense. These are third-party ads and Nigat Jobs is
            not responsible for their content. Clicking on ads may take you to external websites.
        </p>

        <div class="section-heading">7. Changes to Terms</div>
        <p style="color:var(--muted);line-height:1.9;">
            We reserve the right to update these Terms at any time. Continued use of the website after changes constitutes
            acceptance of the new terms.
        </p>

        <div class="section-heading">8. Contact</div>
        <p style="color:var(--muted);line-height:1.9;">
            For questions about these Terms, <a href="{{ route('contact') }}" style="color:var(--primary);">contact us</a>.
        </p>
    </div>
</div>
@endsection
