<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EmployerDashboardController extends Controller
{
    /**
     * Display employer dashboard with their job statistics
     */
    public function index(): View
    {
        $employer = Auth::user();
        
        $stats = [
            'total_jobs' => Job::where('user_id', $employer->id)->count(),
            'total_applications' => Applicant::whereHas('job', function($query) use ($employer) {
                $query->where('user_id', $employer->id);
            })->count(),
            'active_jobs' => Job::where('user_id', $employer->id)->count(),
        ];

        // Get recent jobs with application counts
        $recentJobs = Job::where('user_id', $employer->id)
            ->withCount('applicants')
            ->latest()
            ->take(5)
            ->get();

        return view('employer.dashboard', compact('stats', 'recentJobs'));
    }

    /**
     * Display employer's job listings
     */
    public function myJobs(): View
    {
        $employer = Auth::user();
        
        $jobs = Job::where('user_id', $employer->id)
            ->withCount('applicants')
            ->latest()
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    /**
     * Display applications for employer's jobs
     */
    public function applications(): View
    {
        $employer = Auth::user();
        
        $applications = Applicant::with(['user', 'job'])
            ->whereHas('job', function($query) use ($employer) {
                $query->where('user_id', $employer->id);
            })
            ->latest()
            ->paginate(20);

        return view('employer.applications.index', compact('applications'));
    }

    /**
     * Delete an applicant (only if they applied to employer's job)
     */
    public function deleteApplicant($id): RedirectResponse
    {
        $employer = Auth::user();
        
        $applicant = Applicant::with('job')->findOrFail($id);
        
        // Check if the job belongs to the employer
        if ($applicant->job->user_id !== $employer->id) {
            abort(403, 'Unauthorized action.');
        }
        
        $applicant->delete();
        
        return redirect()->back()->with('success', 'Applicant deleted successfully.');
    }

    /**
     * Update application status (Accept/Reject)
     */
    public function updateApplicationStatus(Request $request, $id): RedirectResponse
    {
        $employer = Auth::user();
        
        $applicant = Applicant::with('job')->findOrFail($id);
        
        // Check if the job belongs to the employer
        if ($applicant->job->user_id !== $employer->id) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);
        
        $applicant->status = $request->status;
        $applicant->save();
        
        $statusText = ucfirst($request->status);
        
        return redirect()->back()->with('success', "Application has been marked as {$statusText}.");
    }
}
