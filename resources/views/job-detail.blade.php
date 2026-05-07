@extends('layouts.app')

@section('title', $job->title . ' | Nigat Jobs')
@section('meta_desc', Str::limit(strip_tags($job->description), 160))
@section('og_image', route('job.card.image', $job->id))

@push('head')
<style>
/* ── Description renderer ── */
.desc-intro {
    color: var(--muted); line-height: 1.9; font-size: .94rem;
    padding: .9rem 1.1rem; background: var(--bg);
    border-radius: 10px; border-left: 3px solid var(--primary);
    margin-bottom: 1.25rem;
}

.positions-list { display: flex; flex-direction: column; gap: .65rem; }

.position-card {
    border: 1.5px solid var(--border);
    border-radius: 12px; overflow: hidden;
}
.position-header {
    display: flex; align-items: center; gap: .7rem;
    padding: .8rem 1rem;
    background: rgba(37,99,235,.05);
    border-bottom: 1px solid var(--border);
}
.pos-num {
    min-width: 28px; height: 28px;
    background: var(--primary); color: white;
    border-radius: 7px; display: inline-flex;
    align-items: center; justify-content: center;
    font-weight: 800; font-size: .82rem; flex-shrink: 0;
}
.pos-title { font-weight: 700; color: var(--text); font-size: .93rem; line-height: 1.4; }

.pos-fields { display: flex; flex-wrap: wrap; gap: .45rem; padding: .8rem 1rem; }
.pos-field {
    display: inline-flex; align-items: flex-start; gap: .35rem;
    border-radius: 8px; padding: .32rem .65rem; font-size: .81rem; max-width: 100%;
}
.pos-field i { margin-top: .1rem; flex-shrink: 0; font-size: .8rem; }
.pos-field strong { font-weight: 700; margin-right: .25rem; }
.pos-field span { color: var(--muted); }

.pos-notes {
    padding: .3rem 1rem .8rem;
    font-size: .84rem; color: var(--muted); line-height: 1.8;
}

.app-card { border: 1.5px solid var(--border); border-radius: 12px; overflow: hidden; }
.app-row {
    display: flex; align-items: flex-start; gap: .8rem;
    padding: .8rem 1rem; border-bottom: 1px solid var(--border);
}
.app-row:last-child { border-bottom: none; }
.app-icon {
    width: 32px; height: 32px; border-radius: 8px;
    display: inline-flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: .95rem;
}
.app-key {
    font-size: .7rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: .06em; color: var(--muted); margin-bottom: .18rem;
}
.app-val { font-size: .88rem; color: var(--text); line-height: 1.6; }

.plain-desc { color: var(--muted); line-height: 1.95; font-size: .93rem; }
.plain-desc strong { color: var(--text); font-weight: 700; }
</style>
@endpush

@section('content')

<section class="page-hero">
    <div class="container">
        <a href="{{ route('jobs') }}" class="breadcrumb-back">
            <i class="bi bi-arrow-left"></i> Back to Jobs
        </a>
        <h1>{{ $job->title }}</h1>
        @if($job->company)
            <p><i class="bi bi-building me-1"></i>{{ $job->company }}</p>
        @endif
    </div>
</section>

<div class="container" style="padding:2.5rem 0 4rem;">
    <div class="row g-4">

        {{-- ── Main ── --}}
        <div class="col-lg-8">
            <div class="detail-surface">

                {{-- Field chips --}}
                <div class="field-row">
                    @if($job->location)
                        <span class="field-chip"><i class="bi bi-geo-alt"></i>{{ $job->location }}</span>
                    @endif
                    @if($job->type)
                        <span class="field-chip"><i class="bi bi-briefcase"></i>{{ $job->type }}</span>
                    @endif
                    @if($job->education)
                        <span class="field-chip" style="background:rgba(16,185,129,.08);border-color:rgba(16,185,129,.3);color:#065f46;">
                            <i class="bi bi-mortarboard" style="color:#059669;"></i>{{ $job->education }}
                        </span>
                    @endif
                    @if($job->experience)
                        <span class="field-chip" style="background:rgba(139,92,246,.08);border-color:rgba(139,92,246,.3);color:#5b21b6;">
                            <i class="bi bi-person-workspace" style="color:#7c3aed;"></i>{{ $job->experience }}
                        </span>
                    @endif
                    @if($job->salary && $job->salary !== 'Company Scale')
                        <span class="field-chip"><i class="bi bi-cash-coin"></i>{{ $job->salary }}</span>
                    @endif
                    @if($job->posted_at)
                        <span class="field-chip"><i class="bi bi-calendar3"></i>{{ \Carbon\Carbon::parse($job->posted_at)->format('M d, Y') }}</span>
                    @endif
                </div>

                @if($job->deadline)
                    <div class="deadline-pill mb-3">
                        <i class="bi bi-clock"></i> Deadline: {{ $job->deadline }}
                    </div>
                @endif

                {{-- ── Smart Description ── --}}
                @if($job->description)
                @php
                    $raw  = trim($job->description ?? '');

                    // ── Normalize: insert \n at structural boundaries ──────────
                    // Even if the scraper stored everything as one long line,
                    // we can find the break points from the patterns themselves.
                    $n = $raw;

                    // Before numbered items  "...15 2. Title..." → "...15\n2. Title..."
                    $n = preg_replace('/([.\d])\s+(?=\d{1,2}[.)]\s+[A-Z])/u', "$1\n", $n);

                    // Before common key labels  "...fields. Education:..." → "...fields.\nEducation:..."
                    $kl = 'Education|Experience|Quantity|No\.?\s*of\s*Positions?|Vacancies'
                        . '|Salary|Location|Place\s+of\s+Work|Deadline|Method|Timeline'
                        . '|Registration|Terms\s+of\s+Employment|Employment\s+Type|How\s+to\s+Apply';
                    $n = preg_replace('/([.;,\d])\s+(?=(?:'.$kl.')\s*:)/iu', "$1\n", $n);

                    // Before Application Details header
                    $n = preg_replace('/\.\s+(?=Application\s+Details?|How\s+to\s+Apply)/iu', ".\n", $n);

                    // ── Parse lines ───────────────────────────────────────────
                    $lines = array_values(array_filter(array_map('trim', explode("\n", $n))));

                    $kvRx  = '/^(Education|Experience|Quantity|No\.?\s*of\s*Positions?|Vacancies'
                           . '|Salary|Location|Place\s+of\s+Work|Deadline|Method|Timeline'
                           . '|Registration|Terms\s+of\s+Employment|Employment\s+Type)\s*:\s*/i';
                    $appRx = '/^(Application\s+Details?|How\s+to\s+Apply|Application\s+Method)/i';
                    $numRx = '/^(\d{1,2})[.)]\s+(.+)/';

                    $positions  = [];
                    $appDetails = [];
                    $introLines = [];
                    $cur        = null;
                    $inApp      = false;

                    foreach ($lines as $line) {
                        if (preg_match($numRx, $line, $m)) {
                            if ($cur) $positions[] = $cur;
                            $cur   = ['num' => $m[1], 'title' => trim($m[2]), 'fields' => [], 'notes' => []];
                            $inApp = false;
                        } elseif (preg_match($appRx, $line)) {
                            if ($cur) { $positions[] = $cur; $cur = null; }
                            $inApp = true;
                        } elseif (preg_match($kvRx, $line, $m)) {
                            $key = ucwords(strtolower(trim($m[1])));
                            $val = trim(substr($line, strlen($m[0])));
                            if ($cur)       $cur['fields'][$key] = $val;
                            elseif ($inApp) $appDetails[$key]    = $val;
                            else            $introLines[]         = $line;
                        } else {
                            if ($cur)       { if ($line) $cur['notes'][] = $line; }
                            elseif ($inApp) { if ($line) $appDetails['_notes'][] = $line; }
                            else            { if ($line) $introLines[] = $line; }
                        }
                    }
                    if ($cur) $positions[] = $cur;

                    // Filter intro: skip lines that just repeat the job title
                    $titleLow = strtolower($job->title ?? '');
                    $introLines = array_values(array_filter($introLines, function($l) use ($titleLow) {
                        $ll = strtolower($l);
                        similar_text($ll, $titleLow, $pct);
                        return $pct < 75 && strlen($l) > 20;
                    }));

                    $hasPositions = count($positions) > 0;
                    $hasApp = !empty(array_filter(array_keys($appDetails), fn($k) => $k !== '_notes'));

                    // Icon/colour map
                    $ico = [
                        'Education'            => ['bi-mortarboard',       '#059669','rgba(16,185,129,.12)'],
                        'Experience'           => ['bi-person-workspace',   '#7c3aed','rgba(139,92,246,.12)'],
                        'Quantity'             => ['bi-people-fill',        '#2563eb','rgba(37,99,235,.1)'],
                        'No Of Positions'      => ['bi-people-fill',        '#2563eb','rgba(37,99,235,.1)'],
                        'Vacancies'            => ['bi-people-fill',        '#2563eb','rgba(37,99,235,.1)'],
                        'Salary'               => ['bi-cash-coin',          '#b45309','rgba(245,158,11,.12)'],
                        'Location'             => ['bi-geo-alt-fill',       '#dc2626','rgba(239,68,68,.1)'],
                        'Place Of Work'        => ['bi-geo-alt-fill',       '#dc2626','rgba(239,68,68,.1)'],
                        'Deadline'             => ['bi-clock-fill',         '#b45309','rgba(245,158,11,.12)'],
                        'Method'               => ['bi-send-fill',          '#0284c7','rgba(14,165,233,.1)'],
                        'Timeline'             => ['bi-calendar-range-fill','#0284c7','rgba(14,165,233,.1)'],
                        'Registration'         => ['bi-pencil-fill',        '#0284c7','rgba(14,165,233,.1)'],
                        'Terms Of Employment'  => ['bi-file-earmark-text',  '#6b7280','rgba(107,114,128,.1)'],
                        'Employment Type'      => ['bi-briefcase-fill',     '#6b7280','rgba(107,114,128,.1)'],
                    ];
                    $defIco = ['bi-tag','#6b7280','rgba(107,114,128,.1)'];
                @endphp

                {{-- Intro --}}
                @if($introLines)
                    <div class="desc-intro">{{ implode(' ', $introLines) }}</div>
                @endif

                {{-- Numbered positions --}}
                @if($hasPositions)
                    <div class="section-heading" style="{{ $introLines ? '' : 'margin-top:0;' }}">
                        Open Positions
                        <span style="font-size:.8rem;font-weight:500;color:var(--muted);margin-left:.4rem;">({{ count($positions) }})</span>
                    </div>
                    <div class="positions-list">
                    @foreach($positions as $pos)
                        <div class="position-card">
                            <div class="position-header">
                                <span class="pos-num">{{ $pos['num'] }}</span>
                                <span class="pos-title">{{ $pos['title'] }}</span>
                            </div>
                            @if($pos['fields'])
                            <div class="pos-fields">
                                @foreach($pos['fields'] as $fKey => $fVal)
                                    @php $fi = $ico[ucwords(strtolower($fKey))] ?? $defIco; @endphp
                                    <div class="pos-field" style="background:{{ $fi[2] }};">
                                        <i class="bi {{ $fi[0] }}" style="color:{{ $fi[1] }};"></i>
                                        <div><strong style="color:var(--text);">{{ $fKey }}:</strong> <span>{{ $fVal }}</span></div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                            @if($pos['notes'])
                                <div class="pos-notes">{{ implode(' ', $pos['notes']) }}</div>
                            @endif
                        </div>
                    @endforeach
                    </div>
                @endif

                {{-- Application details --}}
                @if($hasApp || !empty($appDetails['_notes']))
                    <div class="section-heading">How to Apply</div>
                    <div class="app-card">
                        @foreach($appDetails as $aKey => $aVal)
                            @if($aKey === '_notes') @continue @endif
                            @php $ai = $ico[ucwords(strtolower($aKey))] ?? $defIco; @endphp
                            <div class="app-row">
                                <span class="app-icon" style="background:{{ $ai[2] }};color:{{ $ai[1] }};">
                                    <i class="bi {{ $ai[0] }}"></i>
                                </span>
                                <div>
                                    <div class="app-key">{{ $aKey }}</div>
                                    <div class="app-val">{{ $aVal }}</div>
                                </div>
                            </div>
                        @endforeach
                        @if(!empty($appDetails['_notes']))
                            <div class="app-row" style="border-bottom:none;">
                                <span class="app-icon" style="background:rgba(14,165,233,.1);color:#0284c7;">
                                    <i class="bi bi-info-circle-fill"></i>
                                </span>
                                <div class="app-val">{{ implode(' ', $appDetails['_notes']) }}</div>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Fallback: plain text with bold labels --}}
                @if(!$hasPositions && !$hasApp && !$introLines)
                    @php
                        $html = htmlspecialchars($raw);
                        foreach (['Education','Experience','Salary','Location','Deadline','Quantity',
                                  'Method','Timeline','Registration','Place of Work','Terms of Employment',
                                  'How to Apply','Application Details'] as $lbl) {
                            $html = preg_replace('/\b(' . preg_quote($lbl) . ')\s*:/i', '<strong>$1:</strong>', $html);
                        }
                        $html = nl2br($html);
                    @endphp
                    <div class="section-heading" style="margin-top:0;">Job Description</div>
                    <div class="plain-desc">{!! $html !!}</div>
                @endif

                @endif {{-- /description --}}

                {{-- DB relations --}}
                @if($job->requirements->count())
                    <div class="section-heading">Requirements</div>
                    <ul style="padding-left:1.25rem;color:var(--muted);line-height:2.1;">
                        @foreach($job->requirements as $r)
                            <li>{{ $r->requirement }}</li>
                        @endforeach
                    </ul>
                @endif

                @if($job->responsibilities->count())
                    <div class="section-heading">Responsibilities</div>
                    <ul style="padding-left:1.25rem;color:var(--muted);line-height:2.1;">
                        @foreach($job->responsibilities as $r)
                            <li>{{ $r->responsibility }}</li>
                        @endforeach
                    </ul>
                @endif

                @if($job->benefits->count())
                    <div class="section-heading">Benefits</div>
                    <ul style="padding-left:1.25rem;color:var(--muted);line-height:2.1;">
                        @foreach($job->benefits as $b)
                            <li>{{ $b->benefit }}</li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>

        {{-- ── Sidebar ── --}}
        <div class="col-lg-4">
            <div class="detail-surface" style="position:sticky;top:80px;">
                <h5 style="font-weight:700;margin-bottom:1.25rem;color:var(--text);">Apply for this Job</h5>

                @if($job->apply_url)
                    <a href="{{ $job->apply_url }}" target="_blank" class="apply-big mb-3">
                        Apply Now <i class="bi bi-box-arrow-up-right ms-1"></i>
                    </a>
                @endif

                @if($job->apply_email)
                    <a href="mailto:{{ $job->apply_email }}" class="apply-email-btn mb-3">
                        <i class="bi bi-envelope-fill"></i>
                        {{ $job->apply_email }}
                    </a>
                @endif

                @if($job->deadline)
                    <div class="deadline-pill my-3 w-100 justify-content-center">
                        <i class="bi bi-clock"></i> Deadline: {{ $job->deadline }}
                    </div>
                @endif

                <hr style="border-color:var(--border);margin:1.25rem 0;">

                <p style="font-size:.85rem;color:var(--muted);margin-bottom:.75rem;font-weight:600;">Share this job</p>
                <a href="https://t.me/ethiojobsNigatJobsEt" target="_blank" class="btn-tg w-100 justify-content-center mb-2">
                    <i class="fab fa-telegram"></i> @ethiojobsNigatJobsEt
                </a>
                <a href="{{ route('jobs') }}" class="btn-outline-custom w-100 justify-content-center mt-1">
                    <i class="bi bi-grid me-1"></i> Browse More Jobs
                </a>

                <div class="mt-3">
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-7852365660336296"
                         data-ad-slot="auto"
                         data-ad-format="rectangle"
                         data-full-width-responsive="true"></ins>
                    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
