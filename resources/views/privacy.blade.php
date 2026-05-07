@extends('layouts.app')
@section('title', 'Privacy Policy | Nigat Jobs')
@section('meta_desc', 'Read the Nigat Jobs privacy policy to understand how we collect and use your data.')

@section('content')
<section class="page-hero">
    <div class="container">
        <h1>Privacy Policy</h1>
        <p>Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<div class="container" style="padding:3rem 0 5rem;max-width:820px;">
    <div class="detail-surface">
        <div class="section-heading" style="margin-top:0;">1. Introduction</div>
        <p style="color:var(--muted);line-height:1.9;">
            Welcome to <strong style="color:var(--text);">Nigat Jobs</strong> ("we", "our", or "us"). We are committed to protecting your privacy.
            This Privacy Policy explains how we collect, use, and safeguard information when you visit our website
            <strong style="color:var(--text);">nigatjobs.et</strong> and our Telegram channel <strong style="color:var(--text);">@for_sale89</strong>.
        </p>

        <div class="section-heading">2. Information We Collect</div>
        <p style="color:var(--muted);line-height:1.9;">We may collect the following types of information:</p>
        <ul style="color:var(--muted);line-height:2;padding-left:1.5rem;">
            <li><strong style="color:var(--text);">Usage Data:</strong> Pages visited, time spent, browser type, device type, and IP address — collected automatically via analytics.</li>
            <li><strong style="color:var(--text);">Cookies:</strong> Small files stored on your device to remember your preferences (e.g., dark mode setting).</li>
            <li><strong style="color:var(--text);">Contact Information:</strong> Name and email address if you submit our contact form voluntarily.</li>
        </ul>

        <div class="section-heading">3. How We Use Your Information</div>
        <ul style="color:var(--muted);line-height:2;padding-left:1.5rem;">
            <li>To display and improve our job listings</li>
            <li>To understand how visitors use the website (analytics)</li>
            <li>To show relevant advertisements through <strong style="color:var(--text);">Google AdSense</strong></li>
            <li>To respond to messages sent through our contact form</li>
        </ul>

        <div class="section-heading">4. Google AdSense & Cookies</div>
        <p style="color:var(--muted);line-height:1.9;">
            We use Google AdSense to display advertisements. Google uses cookies to serve ads based on your prior visits
            to our website or other websites. You can opt out of personalised advertising by visiting
            <a href="https://www.google.com/settings/ads" target="_blank" style="color:var(--primary);">Google Ads Settings</a>.
            Google's use of advertising cookies enables it and its partners to serve ads based on your visit to our site
            and/or other sites on the Internet. To learn more about how Google uses data, visit
            <a href="https://policies.google.com/technologies/partner-sites" target="_blank" style="color:var(--primary);">Google's Privacy &amp; Terms</a>.
        </p>

        <div class="section-heading">5. Third-Party Links</div>
        <p style="color:var(--muted);line-height:1.9;">
            Our website contains links to external job sites and employer websites. We are not responsible for the
            privacy practices or content of those sites. We encourage you to review their privacy policies before
            submitting any personal information.
        </p>

        <div class="section-heading">6. Data Retention</div>
        <p style="color:var(--muted);line-height:1.9;">
            We do not store personal data beyond what is necessary. Contact form submissions are retained only as long
            as needed to respond to your enquiry.
        </p>

        <div class="section-heading">7. Your Rights</div>
        <p style="color:var(--muted);line-height:1.9;">
            You have the right to request access to, correction of, or deletion of any personal data we hold about you.
            Contact us at <strong style="color:var(--text);">support@nigatjobs.et</strong> to exercise these rights.
        </p>

        <div class="section-heading">8. Changes to This Policy</div>
        <p style="color:var(--muted);line-height:1.9;">
            We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated
            revision date.
        </p>

        <div class="section-heading">9. Contact Us</div>
        <p style="color:var(--muted);line-height:1.9;">
            If you have questions about this Privacy Policy, please
            <a href="{{ route('contact') }}" style="color:var(--primary);">contact us</a> or reach us on Telegram at
            <a href="https://t.me/for_sale89" target="_blank" style="color:var(--primary);">@for_sale89</a>.
        </p>
    </div>
</div>
@endsection
