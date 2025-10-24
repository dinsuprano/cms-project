<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Applicant;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Display admin dashboard with overview stats
     */
    public function index(): View
    {
        $stats = [
            'total_users' => User::count(),
            'total_jobs' => Job::count(),
            'total_applications' => Applicant::count(),
            'users_by_role' => User::selectRaw('role, count(*) as count')
                ->groupBy('role')
                ->pluck('count', 'role'),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display all users
     */
    public function users(): View
    {
        $users = User::with(['jobListings', 'applications'])
            ->withCount(['jobListings', 'applications', 'bookmarkedJobs'])
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display all jobs
     */
    public function jobs(): View
    {
        $jobs = Job::with('user')
            ->withCount('applicants')
            ->latest()
            ->paginate(20);

        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Display all applications
     */
    public function applications(): View
    {
        $applications = Applicant::with(['user', 'job'])
            ->latest()
            ->paginate(20);

        return view('admin.applications.index', compact('applications'));
    }
}
