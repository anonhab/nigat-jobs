@extends('layouts.app')

@section('title', 'Browse Jobs | Nigat Jobs')
@section('meta_desc', 'Search and filter Ethiopian job vacancies by type, keyword, and more.')

@push('head')
<style>
    /* ── Jobs search hero ── */
    .jobs-hero {
        background: linear-gradient(135deg, var(--primary) 0%, #1e3a5f 100%);
        padding: 3rem 0 5rem;
        text-align: center;
        color: white;
    }
    .jobs-hero h1 { font-size: clamp(1.6rem,3vw,2.2rem); font-weight:800; }
    .jobs-hero p  { opacity:.85; margin:.4rem 0 0; }

    /* ── Floating search card ── */
    .search-card {
        background: var(--surface);
        border-radius: 16px;
        box-shadow: 0 12px 40px rgba(0,0,0,.18);
        padding: 1.5rem;
        margin-top: -3rem;
        border: 1px solid var(--border);
    }
    .search-input-wrap {
        position: relative;
    }
    .search-input-wrap .search-icon {
        position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
        color: var(--muted); font-size: 1rem; pointer-events: none;
    }
    .search-input-wrap input {
        width: 100%;
        padding: .75rem 1rem .75rem 2.75rem;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-size: .97rem;
        background: var(--bg);
        color: var(--text);
        transition: border-color .2s, box-shadow .2s;
        outline: none;
    }
    .search-input-wrap input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,.15);
    }
    .search-input-wrap input::placeholder { color: var(--muted); }

    /* ── Type pills ── */
    .type-pills {
        display: flex; flex-wrap: wrap; gap: .45rem;
    }
    .type-pills input[type="radio"] { display:none; }
    .type-pills label {
        cursor: pointer;
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .42rem .9rem;
        border-radius: 99px;
        font-size: .85rem; font-weight: 600;
        border: 1.5px solid var(--border);
        color: var(--muted);
        background: var(--bg);
        transition: all .18s;
        white-space: nowrap;
        user-select: none;
    }
    .type-pills input[type="radio"]:checked + label {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    .type-pills label:hover {
        border-color: var(--primary);
        color: var(--primary);
    }
    .type-pills input[type="radio"]:checked + label:hover {
        color: white;
    }

    /* ── Search button ── */
    .btn-search {
        width: 100%; padding: .72rem 1.5rem;
        background: var(--primary); color: white;
        border: none; border-radius: 10px;
        font-size: 1rem; font-weight: 700;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: .5rem;
        transition: background .2s, transform .1s;
    }
    .btn-search:hover  { background: var(--primary-h); }
    .btn-search:active { transform: scale(.98); }

    /* ── Results bar ── */
    .results-bar {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: .75rem;
        margin-bottom: 1.25rem;
    }
    .results-bar .count { font-size: .88rem; color: var(--muted); }
    .results-bar .count strong { color: var(--text); }
    .sort-wrap {
        display: flex; align-items: center; gap: .5rem;
        font-size: .85rem; color: var(--muted);
    }
    .sort-wrap select {
        border: 1.5px solid var(--border);
        border-radius: 8px;
        padding: .35rem .7rem;
        font-size: .85rem;
        background: var(--surface);
        color: var(--text);
        cursor: pointer;
        outline: none;
        transition: border-color .2s;
    }
    .sort-wrap select:focus { border-color: var(--primary); }

    /* ── Filter label ── */
    .filter-label {
        font-size: .75rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .07em;
        color: var(--muted); display: block;
    }

    /* ── Active filter chips ── */
    .active-filters { display:flex; flex-wrap:wrap; gap:.4rem; margin-bottom:1rem; }
    .filter-chip {
        display: inline-flex; align-items: center; gap: .35rem;
        background: rgba(37,99,235,.1);
        color: var(--primary);
        border-radius: 99px;
        padding: .3rem .75rem;
        font-size: .8rem; font-weight: 600;
    }
    .filter-chip a { color: var(--primary); text-decoration:none; font-size: .75rem; opacity:.7; }
    .filter-chip a:hover { opacity:1; }
</style>
@endpush

@section('content')

{{-- Hero + floating search --}}
<section class="jobs-hero">
    <div class="container">
        <h1>Find Your Next Job</h1>
        <p>{{ number_format($jobs->total()) }} vacancies — updated daily</p>
    </div>
</section>

<div class="container" style="padding:0 0 4rem;">

    {{-- Floating Search Card --}}
    @php
        $curType = request('type', 'all');
        $curEdu  = request('education', 'any');
        $curExp  = request('experience', 'any');
    @endphp
    <form method="GET" action="{{ route('jobs') }}" id="searchForm">
        <div class="search-card mb-4">

            {{-- Row 1: Keyword + Search button --}}
            <div class="row g-3 align-items-center mb-3">
                <div class="col">
                    <label class="filter-label"><i class="bi bi-search me-1"></i> Keywords</label>
                    <div class="search-input-wrap mt-1">
                        <i class="bi bi-briefcase search-icon"></i>
                        <input type="text" name="search"
                               placeholder="Job title, company, skill…"
                               value="{{ request('search') }}"
                               autocomplete="off">
                    </div>
                </div>
                <div class="col-auto" style="padding-top:1.6rem;">
                    <button type="submit" class="btn-search" style="width:auto;padding:.72rem 2rem;">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </div>

            <hr style="border-color:var(--border);margin:.25rem 0 1rem;">

            {{-- Row 2: Job Type --}}
            <div class="mb-3">
                <label class="filter-label"><i class="bi bi-briefcase me-1"></i> Job Type</label>
                <div class="type-pills mt-2">
                    @foreach([
                        'all'       => ['All Types',  'bi-grid-3x3-gap'],
                        'Full Time' => ['Full Time',  'bi-clock-fill'],
                        'Part Time' => ['Part Time',  'bi-clock-history'],
                        'Contract'  => ['Contract',   'bi-file-earmark-text'],
                        'Remote'    => ['Remote',     'bi-wifi'],
                        'Internship'=> ['Internship', 'bi-mortarboard'],
                    ] as $val => [$label, $icon])
                        <input type="radio" name="type" id="type_{{ $loop->index }}"
                               value="{{ $val }}" {{ $curType === $val ? 'checked' : '' }}>
                        <label for="type_{{ $loop->index }}">
                            <i class="bi {{ $icon }}"></i> {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Row 3: Education --}}
            <div class="mb-3">
                <label class="filter-label"><i class="bi bi-mortarboard me-1"></i> Education / Degree</label>
                <div class="type-pills mt-2">
                    @foreach([
                        'any'              => ['Any Level',       'bi-circle'],
                        'Certificate'      => ['Certificate',     'bi-patch-check'],
                        'Diploma'          => ['Diploma',         'bi-award'],
                        "Bachelor's"       => ["Bachelor's",      'bi-journal-bookmark'],
                        "Master's"         => ["Master's",        'bi-journal-bookmark-fill'],
                        'PhD'              => ['PhD',             'bi-bookmark-star'],
                    ] as $val => [$label, $icon])
                        <input type="radio" name="education" id="edu_{{ $loop->index }}"
                               value="{{ $val }}" {{ $curEdu === $val ? 'checked' : '' }}>
                        <label for="edu_{{ $loop->index }}">
                            <i class="bi {{ $icon }}"></i> {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Row 4: Experience --}}
            <div>
                <label class="filter-label"><i class="bi bi-person-workspace me-1"></i> Experience</label>
                <div class="type-pills mt-2">
                    @foreach([
                        'any'           => ['Any',            'bi-circle'],
                        'Fresh'         => ['Fresh Graduate', 'bi-emoji-smile'],
                        '1+ Year'       => ['1+ Year',        'bi-bar-chart'],
                        '2+ Years'      => ['2+ Years',       'bi-bar-chart-fill'],
                        '3-5 Years'     => ['3–5 Years',      'bi-graph-up'],
                        '5+ Years'      => ['5+ Years',       'bi-graph-up-arrow'],
                        '10+ Years'     => ['10+ Years',      'bi-star-fill'],
                    ] as $val => [$label, $icon])
                        <input type="radio" name="experience" id="exp_{{ $loop->index }}"
                               value="{{ $val }}" {{ $curExp === $val ? 'checked' : '' }}>
                        <label for="exp_{{ $loop->index }}">
                            <i class="bi {{ $icon }}"></i> {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

        </div>
    </form>

    {{-- Ad: Below search card --}}
    @include('partials.ad', ['slot' => 'SLOT_JOBS_TOP', 'format' => 'horizontal'])

    {{-- Active filter chips --}}
    @php
        $hasFilters = request('search')
            || ($curType !== 'all')
            || ($curEdu  !== 'any')
            || ($curExp  !== 'any');
    @endphp
    @if($hasFilters)
    <div class="active-filters">
        @if(request('search'))
            <span class="filter-chip">
                <i class="bi bi-search"></i> "{{ request('search') }}"
                <a href="{{ route('jobs', request()->except(['search','page'])) }}">×</a>
            </span>
        @endif
        @if($curType !== 'all')
            <span class="filter-chip">
                <i class="bi bi-briefcase"></i> {{ $curType }}
                <a href="{{ route('jobs', request()->except(['type','page'])) }}">×</a>
            </span>
        @endif
        @if($curEdu !== 'any')
            <span class="filter-chip">
                <i class="bi bi-mortarboard"></i> {{ $curEdu }}
                <a href="{{ route('jobs', request()->except(['education','page'])) }}">×</a>
            </span>
        @endif
        @if($curExp !== 'any')
            <span class="filter-chip">
                <i class="bi bi-person-workspace"></i> {{ $curExp }}
                <a href="{{ route('jobs', request()->except(['experience','page'])) }}">×</a>
            </span>
        @endif
        <a href="{{ route('jobs') }}" style="font-size:.82rem;color:var(--muted);text-decoration:none;align-self:center;margin-left:.25rem;">
            <i class="bi bi-x-circle"></i> Clear all
        </a>
    </div>
    @endif

    {{-- Results bar --}}
    <div class="results-bar">
        <p class="count mb-0">
            Showing <strong>{{ $jobs->firstItem() ?? 0 }}–{{ $jobs->lastItem() ?? 0 }}</strong>
            of <strong>{{ number_format($jobs->total()) }}</strong> jobs
        </p>
        <form method="GET" action="{{ route('jobs') }}" class="sort-wrap" id="sortForm">
            @foreach(request()->except('sort') as $k => $v)
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endforeach
            <i class="bi bi-sort-down"></i>
            <select name="sort" onchange="document.getElementById('sortForm').submit()">
                <option value="recent"       {{ request('sort','recent')==='recent'       ? 'selected':'' }}>Newest First</option>
                <option value="alphabetical" {{ request('sort')==='alphabetical'           ? 'selected':'' }}>A – Z</option>
            </select>
        </form>
    </div>

    {{-- Job Cards --}}
    <div class="row g-3">
        @forelse($jobs as $job)
        @if($loop->iteration === 7)
            </div>
            @include('partials.ad', ['slot' => 'SLOT_JOBS_MID', 'format' => 'auto'])
            <div class="row g-3">
        @endif
        <div class="col-md-6 col-lg-4">
            @include('partials.job-card', ['job' => $job])
        </div>
        @empty
        <div class="col-12 empty-state">
            <i class="bi bi-search d-block"></i>
            <h5 style="color:var(--text);">No jobs found</h5>
            <p>Try different keywords or <a href="{{ route('jobs') }}" style="color:var(--primary);">clear filters</a>.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($jobs->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
