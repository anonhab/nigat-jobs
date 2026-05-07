@php
    // Consistent avatar color per company name
    $palette = ['#2563eb','#059669','#d97706','#7c3aed','#dc2626','#0284c7','#0f766e','#b45309'];
    $co       = $job->company ?? 'J';
    $avatarBg = $palette[abs(crc32($co)) % count($palette)];
    $initials = strtoupper(substr(preg_replace('/[^a-zA-Z ]/', '', $co), 0, 1));
    $words    = explode(' ', trim($co));
    if (count($words) >= 2) {
        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
    }

    // Top accent color by job type
    $typeAccents = [
        'full time'  => '#2563eb',
        'part time'  => '#d97706',
        'contract'   => '#7c3aed',
        'remote'     => '#059669',
        'internship' => '#0284c7',
    ];
    $accentColor = $typeAccents[strtolower($job->type ?? '')] ?? '#2563eb';

    // "New" badge: posted in last 48h
    $isNew = $job->posted_at && \Carbon\Carbon::parse($job->posted_at)->gt(now()->subHours(48));

    // Deadline urgency
    $urgentDeadline = false;
    if ($job->deadline) {
        try {
            $dl = \Carbon\Carbon::parse($job->deadline);
            $urgentDeadline = $dl->isPast() === false && $dl->diffInDays(now()) <= 3;
        } catch (\Throwable) {}
    }
@endphp

<div class="card-job">
    {{-- Colored accent top bar --}}
    <div style="height:4px;background:{{ $accentColor }};border-radius:14px 14px 0 0;"></div>

    <div class="card-body-job">

        {{-- Header: avatar + company + badge --}}
        <div class="card-header-row">
            <div style="display:flex;align-items:center;gap:.6rem;min-width:0;">
                <div class="company-avatar" style="background:{{ $avatarBg }}15;color:{{ $avatarBg }};border-color:{{ $avatarBg }}25;">
                    {{ $initials }}
                </div>
                <div style="min-width:0;">
                    @if($job->company)
                        <div class="company-name">{{ $job->company }}</div>
                    @endif
                    @if($job->location)
                        <div class="card-location">
                            <i class="bi bi-geo-alt-fill"></i>{{ $job->location }}
                        </div>
                    @endif
                </div>
            </div>
            @if($isNew)
                <span class="badge-new">New</span>
            @endif
        </div>

        {{-- Job title --}}
        <h5 class="card-title-job">{{ $job->title }}</h5>

        {{-- Tags --}}
        <div class="card-tags">
            @if($job->type)
                <span class="jtag jtag-type" style="--tc:{{ $accentColor }};">{{ $job->type }}</span>
            @endif
            @if($job->education)
                <span class="jtag jtag-edu"><i class="bi bi-mortarboard"></i>{{ $job->education }}</span>
            @endif
            @if($job->experience)
                <span class="jtag jtag-exp"><i class="bi bi-person-workspace"></i>{{ $job->experience }}</span>
            @endif
            @if($job->salary && $job->salary !== 'Company Scale')
                <span class="jtag jtag-salary"><i class="bi bi-cash-coin"></i>{{ Str::limit($job->salary, 22) }}</span>
            @endif
        </div>

        {{-- Footer: deadline + actions --}}
        <div class="card-footer-job">
            <div>
                @if($job->deadline)
                    <div class="deadline-text {{ $urgentDeadline ? 'deadline-urgent' : '' }}">
                        <i class="bi bi-clock{{ $urgentDeadline ? '-fill' : '' }}"></i>{{ $job->deadline }}
                    </div>
                @elseif($job->posted_at)
                    <div style="font-size:.76rem;color:var(--muted);">
                        <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($job->posted_at)->diffForHumans() }}
                    </div>
                @endif
            </div>
            <div class="card-btns">
                <a href="{{ route('jobs.show', $job->id) }}" class="btn-card-view">Details</a>
            </div>
        </div>

    </div>
</div>
