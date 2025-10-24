<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Employer\EmployerDashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Search route must come before resource routes to avoid conflicts
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');

// Apply middleware to specific actions
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'update','edit', 'destroy']);
// Define the rest of the resource routes without middleware
Route::resource('jobs', JobController::class)->except(['create', 'edit','update','destroy']);

// Route::get('/jobs/{id}/save', [JobController::class, 'save'])->name('jobs.save');


Route::middleware('guest')->group(function () {
  Route::get('/register', [RegisterController::class, 'register'])->name('register');
  Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
  Route::get('/login', [LoginController::class, 'login'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Profile Routes
Route::middleware('auth')->group(function () {
  Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])
->name('applicants.store')->middleware('auth');
Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicants.destroy')->middleware('auth');

// Job Seeker Routes
Route::middleware(['auth', 'jobseeker'])->group(function () {
    Route::delete('/dashboard/applications/{id}', [DashboardController::class, 'deleteApplication'])->name('dashboard.applications.delete');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/jobs', [AdminDashboardController::class, 'jobs'])->name('jobs');
    Route::get('/applications', [AdminDashboardController::class, 'applications'])->name('applications');
});

// Employer Routes
Route::middleware(['auth', 'employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/jobs', [EmployerDashboardController::class, 'myJobs'])->name('jobs');
    Route::get('/applications', [EmployerDashboardController::class, 'applications'])->name('applications');
    Route::patch('/applications/{id}/status', [EmployerDashboardController::class, 'updateApplicationStatus'])->name('applications.status');
    Route::delete('/applications/{id}', [EmployerDashboardController::class, 'deleteApplicant'])->name('applications.delete');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');