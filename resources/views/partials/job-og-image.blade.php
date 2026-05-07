@php
    // Colors by job type
    $typeColors = [
        'full time'  => ['#1d4ed8','#4f46e5'],
        'part time'  => ['#b45309','#d97706'],
        'contract'   => ['#6d28d9','#7c3aed'],
        'remote'     => ['#065f46','#059669'],
        'internship' => ['#0369a1','#0284c7'],
    ];
    $key = strtolower($job->type ?? '');
    [$c1,$c2] = $typeColors[$key] ?? ['#1d4ed8','#4f46e5'];

    // Company initials (max 2 chars)
    $co = preg_replace('/[^a-zA-Z ]/', '', $job->company ?? 'N');
    $words = array_filter(explode(' ', trim($co)));
    $initials = count($words) >= 2
        ? strtoupper(substr($words[array_keys($words)[0]], 0, 1) . substr($words[array_keys($words)[1]], 0, 1))
        : strtoupper(substr($co, 0, 2));

    // Truncate text helpers
    $title   = mb_strlen($job->title ?? '') > 44
               ? mb_substr($job->title, 0, 42) . '…'
               : ($job->title ?? 'Job Vacancy');
    $company = mb_strlen($job->company ?? '') > 38
               ? mb_substr($job->company, 0, 36) . '…'
               : ($job->company ?? '');
    $location = $job->location ? '📍 ' . mb_substr($job->location, 0, 32) : '';

    // Tag pills
    $tags = array_filter([
        $job->type       ?? null,
        $job->education  ?? null,
        $job->experience ?? null,
    ]);
@endphp<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="630" viewBox="0 0 1200 630">
<defs>
  <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
    <stop offset="0%" stop-color="#0f172a"/>
    <stop offset="100%" stop-color="#1a1040"/>
  </linearGradient>
  <linearGradient id="ac" x1="0" y1="0" x2="1" y2="0">
    <stop offset="0%" stop-color="{{ $c1 }}"/>
    <stop offset="100%" stop-color="{{ $c2 }}"/>
  </linearGradient>
  <linearGradient id="av" x1="0" y1="0" x2="1" y2="1">
    <stop offset="0%" stop-color="{{ $c1 }}" stop-opacity="0.9"/>
    <stop offset="100%" stop-color="{{ $c2 }}" stop-opacity="0.9"/>
  </linearGradient>
  <filter id="blur1"><feGaussianBlur stdDeviation="60"/></filter>
  <clipPath id="clip"><rect width="1200" height="630" rx="0"/></clipPath>
</defs>

<!-- Background -->
<rect width="1200" height="630" fill="url(#bg)"/>

<!-- Decorative glows -->
<circle cx="950" cy="80"  r="260" fill="{{ $c1 }}" opacity="0.12" filter="url(#blur1)"/>
<circle cx="150" cy="560" r="220" fill="{{ $c2 }}" opacity="0.10" filter="url(#blur1)"/>

<!-- Top accent bar -->
<rect width="1200" height="7" fill="url(#ac)"/>

<!-- Company avatar circle -->
<circle cx="110" cy="175" r="68" fill="{{ $c1 }}" opacity="0.15"/>
<circle cx="110" cy="175" r="60" fill="url(#av)"/>
<text x="110" y="197" font-family="Arial Black,Arial,sans-serif" font-size="38" fill="white" text-anchor="middle" font-weight="900">{{ $initials }}</text>

<!-- Company name -->
@if($company)
<text x="196" y="158" font-family="Arial,sans-serif" font-size="26" fill="rgba(255,255,255,0.55)" font-weight="600">{{ $company }}</text>
@endif

<!-- Location -->
@if($location)
<text x="196" y="198" font-family="Arial,sans-serif" font-size="22" fill="rgba(255,255,255,0.38)">{{ $location }}</text>
@endif

<!-- Job title -->
<text x="80" y="310" font-family="Arial Black,Arial,sans-serif" font-size="62" fill="white" font-weight="900" letter-spacing="-1">{{ $title }}</text>

<!-- Tag pills -->
@php $tx = 80; @endphp
@foreach($tags as $tag)
@php $tw = mb_strlen($tag) * 13 + 36; @endphp
<rect x="{{ $tx }}" y="355" width="{{ $tw }}" height="40" rx="20" fill="{{ $c1 }}" opacity="0.3"/>
<rect x="{{ $tx }}" y="355" width="{{ $tw }}" height="40" rx="20" fill="none" stroke="{{ $c1 }}" stroke-width="1" opacity="0.5"/>
<text x="{{ $tx + $tw/2 }}" y="381" font-family="Arial,sans-serif" font-size="19" fill="rgba(255,255,255,0.85)" text-anchor="middle" font-weight="600">{{ $tag }}</text>
@php $tx += $tw + 14; @endphp
@endforeach

<!-- Bottom bar -->
<rect y="560" width="1200" height="70" fill="rgba(0,0,0,0.35)"/>

<!-- NJ badge -->
<rect x="72" y="578" width="36" height="36" rx="8" fill="url(#ac)"/>
<text x="90" y="603" font-family="Arial Black,sans-serif" font-size="17" fill="white" text-anchor="middle" font-weight="900">NJ</text>

<!-- Brand name -->
<text x="118" y="604" font-family="Arial Black,sans-serif" font-size="22" fill="white" font-weight="900">Nigat Jobs</text>

<!-- Domain -->
<text x="1128" y="604" font-family="Arial,sans-serif" font-size="20" fill="rgba(255,255,255,0.4)" text-anchor="end">nigatjobs.com.et</text>
</svg>
