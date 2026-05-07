<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /* =======================
       PUBLIC JOB LIST
    ======================== */

    public function index(Request $request)
    {
        $jobs = $this->jobQuery($request)
            ->paginate(3);

        return view('index', compact('jobs'));
    }

    public function jobs(Request $request)
    {
        $jobs = $this->jobQuery($request)
            ->paginate(9)
            ->withQueryString();

        return view('jobs', compact('jobs'));
    }

    private function jobQuery(Request $request)
    {
        $query = Job::with(['benefits', 'requirements', 'responsibilities']);

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('education') && $request->education !== 'any') {
            $query->where('education', $request->education);
        }

        if ($request->filled('experience') && $request->experience !== 'any') {
            $query->where('experience', $request->experience);
        }

        if ($request->filled('search')) {
            $term = '%' . $request->search . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                  ->orWhere('company', 'like', $term)
                  ->orWhere('location', 'like', $term)
                  ->orWhere('description', 'like', $term);
            });
        }

        match ($request->sort) {
            'alphabetical' => $query->orderBy('title', 'asc'),
            default        => $query->orderBy('posted_at', 'desc'),
        };

        return $query;
    }

    /* =======================
       SINGLE JOB VIEW
    ======================== */

    public function show($id)
    {
        $job = Job::with(['benefits', 'requirements', 'responsibilities'])
            ->findOrFail($id);

        return view('job-detail', compact('job'));
    }

    /* =======================
       CREATE JOB
    ======================== */

    public function create()
    {
        return view('postjob');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'type'        => 'required|string|max:100',
            'salary'      => 'nullable|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/jobs'), $imageName);
                $imagePath = 'uploads/jobs/' . $imageName;
            }

            // Create Job
            $job = Job::create([
                'title'       => $request->title,
                'company'     => $request->company,
                'location'    => $request->location,
                'type'        => $request->type,
                'salary'      => $request->salary, // defaults to "Company Scale"
                'description' => $request->description,
                'posted_at'   => now(),
                'image'       => $imagePath,
            ]);

            // Relationships
            $this->storeList($job, 'responsibilities', 'responsibility');
            $this->storeList($job, 'requirements', 'requirement');
            $this->storeList($job, 'benefits', 'benefit');

            DB::commit();

            Log::info('Job posted', [
                'job_id' => $job->id,
            ]);

            return redirect()->back()->with('success', 'Job posted successfully!');

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Job creation failed', [
                'error' => $e->getMessage(),
            ]);

            return back()->withInput()->with('error', 'Job creation failed.');
        }
    }

    private function storeList(Job $job, string $input, string $column)
    {
        if (!request()->filled($input)) return;

        foreach (request($input) as $value) {
            if ($value) {
                $job->{$input}()->create([$column => $value]);
            }
        }
    }

    /* =======================
       AUTH
    ======================== */

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created.');
    }

    public function signin()
    {
        return view('signin');
    }

    public function signup()
    {
        return view('signup');
    }

    public function contact()
    {
        return view('contact');
    }
}
