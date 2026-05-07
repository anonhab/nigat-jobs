<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

Route::post('/signin', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [JobController::class, 'index'])->name('home');
Route::get('/about',   fn() => view('about'))->name('about');
Route::get('/privacy', fn() => view('privacy'))->name('privacy');
Route::get('/terms',   fn() => view('terms'))->name('terms');
Route::get('/contact', [JobController::class, 'contact'])->name('contact');
Route::get('/signin', [JobController::class, 'signin'])->name('signin');
Route::get('/signup', [JobController::class, 'signup'])->name('signup');
Route::post('/register', [JobController::class, 'register']);
Route::get('/jobs', [JobController::class, 'jobs'])->name('jobs');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{id}/card.svg', function ($id) {
    $job = \App\Models\Job::findOrFail($id);
    $svg = view('partials.job-og-image', compact('job'))->render();
    return response($svg, 200, ['Content-Type' => 'image/svg+xml', 'Cache-Control' => 'public, max-age=86400']);
})->name('job.card.image');
// Route to display the "Post a Job" form
// This will match the user navigating to yoursite.com/jobs/create
Route::get('/create', [JobController::class, 'create'])->name('create');

// Route to handle the form submission
// The form's action="route('jobs.store')" will post the data to this route
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');



// ── Agent API ──────────────────────────────────────────────────────────────
// Called by the Python scraper agent to post a new job.
// Requires header:  X-Agent-Key: <AGENT_API_KEY from .env>
Route::post('/api/agent/jobs', function (Request $request) {

    $key = env('AGENT_API_KEY', 'changeme');
    if ($request->header('X-Agent-Key') !== $key) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $data = $request->validate([
        'title'            => 'required|string|max:255',
        'company'          => 'nullable|string|max:255',
        'location'         => 'nullable|string|max:255',
        'type'             => 'nullable|string|max:100',
        'education'        => 'nullable|string|max:100',
        'experience'       => 'nullable|string|max:100',
        'salary'           => 'nullable|string|max:255',
        'deadline'         => 'nullable|string|max:255',
        'description'      => 'nullable|string',
        'apply_url'        => 'nullable|string|max:500',
        'apply_email'      => 'nullable|email|max:255',
        'image'            => 'nullable|url|max:500',
        'source_url'       => 'nullable|url',
        'requirements'     => 'nullable|array',
        'responsibilities' => 'nullable|array',
        'benefits'         => 'nullable|array',
    ]);

    // Skip duplicates — return existing URL so agent can still post to TG
    if (!empty($data['source_url'])) {
        $existing = Job::where('source_url', $data['source_url'])->first();
        if ($existing) {
            return response()->json([
                'status' => 'duplicate',
                'job_id' => $existing->id,
                'url'    => env('APP_URL') . '/jobs/' . $existing->id,
            ], 200);
        }
    }

    $job = Job::create([
        'title'       => $data['title'],
        'company'     => $data['company'] ?? null,
        'location'    => $data['location'] ?? null,
        'type'        => $data['type'] ?? 'Full Time',
        'education'   => $data['education'] ?? null,
        'experience'  => $data['experience'] ?? null,
        'salary'      => $data['salary'] ?? null,
        'deadline'    => $data['deadline'] ?? null,
        'description' => $data['description'] ?? null,
        'apply_url'   => $data['apply_url'] ?? null,
        'apply_email' => $data['apply_email'] ?? null,
        'image'       => $data['image'] ?? null,
        'source_url'  => $data['source_url'] ?? null,
        'posted_at'   => now(),
    ]);

    foreach ($data['requirements'] ?? [] as $r) {
        if (trim($r)) $job->requirements()->create(['requirement' => trim($r)]);
    }
    foreach ($data['responsibilities'] ?? [] as $r) {
        if (trim($r)) $job->responsibilities()->create(['responsibility' => trim($r)]);
    }
    foreach ($data['benefits'] ?? [] as $b) {
        if (trim($b)) $job->benefits()->create(['benefit' => trim($b)]);
    }

    $jobUrl = env('APP_URL') . '/jobs/' . $job->id;

    Log::info('Job created via agent', ['job_id' => $job->id, 'title' => $job->title]);

    return response()->json([
        'status' => 'created',
        'job_id' => $job->id,
        'url'    => $jobUrl,
    ], 201);
});

Route::post('/botwebhook', function (Request $request) {

    $update = $request->all();
    Log::info('Telegram webhook received', ['update' => $update]);

    $chatId = $update['message']['chat']['id'] ?? null;
    $text = $update['message']['text'] ?? '';

    if (!$chatId || !$text) {
        Log::warning('No chat ID or text', ['update' => $update]);
        return response('No data', 400);
    }

    // Parse job data (simple example, expects each field on a new line)
    $lines = explode("\n", $text);
    $jobData = [];

    foreach ($lines as $line) {
        if (str_contains($line, ':')) {
            [$key, $value] = explode(':', $line, 2);
            $jobData[trim(strtolower($key))] = trim($value);
        }
    }

    try {
        // Save job in database
        $job = Job::create([
            'title' => $jobData['title'] ?? 'No title',
            'company' => $jobData['company'] ?? null,
            'location' => $jobData['location'] ?? null,
            'type' => $jobData['type'] ?? null,
            'salary_min' => $jobData['salary_min'] ?? null,
            'salary_max' => $jobData['salary_max'] ?? null,
            'description' => $jobData['description'] ?? null,
        ]);

        // Optional: handle responsibilities, requirements, benefits
        if (!empty($jobData['responsibilities'])) {
            $responsibilities = explode('-', $jobData['responsibilities']);
            foreach ($responsibilities as $r) {
                $r = trim($r);
                if ($r) $job->responsibilities()->create(['responsibility' => $r]);
            }
        }

        if (!empty($jobData['requirements'])) {
            $requirements = explode('-', $jobData['requirements']);
            foreach ($requirements as $r) {
                $r = trim($r);
                if ($r) $job->requirements()->create(['requirement' => $r]);
            }
        }

        if (!empty($jobData['benefits'])) {
            $benefits = explode('-', $jobData['benefits']);
            foreach ($benefits as $b) {
                $b = trim($b);
                if ($b) $job->benefits()->create(['benefit' => $b]);
            }
        }

        Log::info('Job created via bot', ['job_id' => $job->id, 'chat_id' => $chatId]);

        // Reply to Telegram
        Http::post("https://api.telegram.org/bot".env('TELEGRAM_BOT_TOKEN')."/sendMessage", [
            'chat_id' => $chatId,
            'text' => "✅ Job created successfully: {$job->title}",
        ]);

    } catch (\Exception $e) {
        Log::error('Job creation failed via bot', [
            'error' => $e->getMessage(),
            'input' => $text,
        ]);

        Http::post("https://api.telegram.org/bot".env('TELEGRAM_BOT_TOKEN')."/sendMessage", [
            'chat_id' => $chatId,
            'text' => "❌ Failed to create job: {$e->getMessage()}",
        ]);
    }

    return response('ok');
});