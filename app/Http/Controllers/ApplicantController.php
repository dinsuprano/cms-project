<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{

    public function store(Request $request, Job $job): RedirectResponse
    {
        // Check if the user has already applied for the job
        $existingApplication = Applicant::where('job_id', $job->id)
                                        ->where('user_id', Auth::id())
                                        ->exists();

        if ($existingApplication) {
            return redirect()->back()->with('status', 'You have already applied to this job.');
        }

        // Validate incoming data
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'contact_phone' => 'string',
            'contact_email' => 'required|string|email',
            'message' => 'string',
            'location' => 'string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $validatedData['resume_path'] = $path;
        }

        // Store the application
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = Auth::id();
        $application->save();

        return redirect()->back()->with('success', 'Your application has been submitted.');
    }


    // @desc   Delete a job application
    // @route  DELETE /applicants/{applicant}
    public function destroy($id): RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();
        return redirect()->route('dashboard')->with('success', 'Applicant deleted successfully.');

    }
}