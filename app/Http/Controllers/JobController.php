<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    //Display a listing of jobs
    public function index()
    {
        $title = 'Available Jobs';
        $jobs = [
            'Software Engineer',
            'Web Developer',
            'Data Scientist',
            
        ];

        return view('jobs.index', compact('title', 'jobs'));
    }

    public function create()    
    {
        return view('jobs.create');
    }

}
