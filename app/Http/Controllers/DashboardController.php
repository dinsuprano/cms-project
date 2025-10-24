<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Applicant;

class DashboardController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check user role and show appropriate dashboard
        if ($user->isUser()) {
            // Job Seeker Dashboard - Show applications history
            $applications = Applicant::where('user_id', $user->id)
                ->with('job')
                ->latest()
                ->paginate(10);
            
            return view('dashboard.jobseeker', compact('user', 'applications'));
        } elseif ($user->isEmployer()) {
            // Redirect employers to their dedicated dashboard
            return redirect()->route('employer.dashboard');
        } else {
            // Admin Dashboard
            return redirect()->route('admin.dashboard');
        }
    }

    // @desc   Show the dashboard
    // @route  GET /dashboard
    public function show(Request $request): View
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get all job listings for the authenticated user
        $jobs = Job::where('user_id', $user->id)->with('applicants')->get();

        return view('dashboard.index', compact('user', 'jobs'));
    }

    /**
     * Delete a job application (for job seekers)
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteApplication($id)
    {
        $user = Auth::user();
        
        // Find the application
        $application = Applicant::findOrFail($id);
        
        // Verify the application belongs to the authenticated user
        if ($application->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Delete the application
        $application->delete();
        
        return redirect()->route('dashboard')->with('success', 'Application deleted successfully!');
    }
}

