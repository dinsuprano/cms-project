# Role-Based System Implementation

## Overview
A complete role-based access control system has been implemented with three user roles:
- **user** (Job Seeker) - Can apply for jobs, bookmark listings
- **employer** - Can post and manage jobs
- **admin** - Full access to admin panel to manage users, jobs, and applications

## What Was Created

### 1. Database Migration ✅
- **File**: `database/migrations/2025_10_24_094355_add_role_to_users_table.php`
- Added `role` enum column with values: 'user', 'employer', 'admin'
- Default value: 'user'

### 2. User Model Updates ✅
- **File**: `app/Models/User.php`
- Added `role` to fillable array
- Helper methods added:
  - `isAdmin()` - Check if user is admin
  - `isEmployer()` - Check if user is employer
  - `isUser()` - Check if user is job seeker
  - `hasRole($role)` - Generic role checker

### 3. Middleware ✅
Three middleware classes for role-based access control:

- **AdminMiddleware**: `app/Http/Middleware/AdminMiddleware.php`
  - Only allows admin users
  - Returns 403 if unauthorized

- **EmployerMiddleware**: `app/Http/Middleware/EmployerMiddleware.php`
  - Only allows employer users
  - Returns 403 if unauthorized

- **JobSeekerMiddleware**: `app/Http/Middleware/JobSeekerMiddleware.php`
  - Only allows job seeker (user role) users
  - Returns 403 if unauthorized

### 4. Admin Dashboard Controller ✅
- **File**: `app/Http/Controllers/Admin/AdminDashboardController.php`
- Methods:
  - `index()` - Dashboard with stats overview
  - `users()` - View all users with pagination
  - `jobs()` - View all job listings with pagination
  - `applications()` - View all applications with pagination

### 5. Admin Views ✅
- **Dashboard**: `resources/views/admin/dashboard.blade.php`
  - Stats cards showing total users, jobs, applications
  - Users by role breakdown
  - Quick links to management pages

- **Users Management**: `resources/views/admin/users/index.blade.php`
  - Table showing all users with avatar, email, role
  - Shows jobs posted, applications submitted, bookmarks
  - Paginated list

### 6. Seeders ✅
- **File**: `database/seeders/AdminUserSeeder.php`
- Creates three test accounts:
  - **Admin**: admin@admin.com / admin123
  - **Employer**: employer@test.com / employer123
  - **Job Seeker**: jobseeker@test.com / jobseeker123

- **Updated**: `database/seeders/DatabaseSeeder.php`
  - Added AdminUserSeeder to seeding chain

### 7. Routes ✅
- **File**: `routes/web.php`
- Admin routes group with middleware:
  ```php
  /admin/dashboard - Admin dashboard
  /admin/users - Manage users
  /admin/jobs - Manage jobs
  /admin/applications - View applications
  ```

### 8. Middleware Registration ✅
- **File**: `bootstrap/app.php`
- Registered middleware aliases:
  - `admin` → AdminMiddleware
  - `employer` → EmployerMiddleware
  - `jobseeker` → JobSeekerMiddleware

## Test Accounts

After running the seeder, you'll have these accounts:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@admin.com | admin123 |
| Employer | employer@test.com | employer123 |
| Job Seeker | jobseeker@test.com | jobseeker123 |

## Usage

### Protect Routes by Role

```php
// Admin only
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes
});

// Employer only
Route::middleware(['auth', 'employer'])->group(function () {
    // Employer routes
});

// Job Seeker only
Route::middleware(['auth', 'jobseeker'])->group(function () {
    // Job seeker routes
});
```

### Check User Role in Views

```blade
@if(auth()->user()->isAdmin())
    <!-- Admin only content -->
@endif

@if(auth()->user()->isEmployer())
    <!-- Employer only content -->
@endif

@if(auth()->user()->isUser())
    <!-- Job seeker only content -->
@endif
```

### Check User Role in Controllers

```php
if (auth()->user()->isAdmin()) {
    // Admin logic
}

if (auth()->user()->hasRole('employer')) {
    // Employer logic
}
```

## Next Steps

### Recommended Enhancements:

1. **Update Registration**
   - Allow users to choose role during registration
   - Add role selection dropdown

2. **Update Navigation**
   - Show admin link in header for admin users
   - Show different menu items based on role

3. **Employer Dashboard**
   - Create separate employer dashboard
   - Show jobs posted by employer
   - Manage applications for their jobs

4. **Admin Features**
   - Add user edit/delete functionality
   - Add job moderation
   - Add analytics and reports

5. **Update Job Creation**
   - Restrict to employers and admins only
   - Update JobPolicy with role checks

## Files Modified/Created

### Created:
- `database/migrations/2025_10_24_094355_add_role_to_users_table.php`
- `app/Http/Middleware/AdminMiddleware.php`
- `app/Http/Middleware/EmployerMiddleware.php`
- `app/Http/Middleware/JobSeekerMiddleware.php`
- `app/Http/Controllers/Admin/AdminDashboardController.php`
- `resources/views/admin/dashboard.blade.php`
- `resources/views/admin/users/index.blade.php`
- `database/seeders/AdminUserSeeder.php`

### Modified:
- `app/Models/User.php`
- `routes/web.php`
- `bootstrap/app.php`
- `database/seeders/DatabaseSeeder.php`

## Testing

1. **Login as Admin**:
   ```
   Email: admin@admin.com
   Password: admin123
   ```
   Visit: http://127.0.0.1:8000/admin/dashboard

2. **Login as Employer**:
   ```
   Email: employer@test.com
   Password: employer123
   ```

3. **Login as Job Seeker**:
   ```
   Email: jobseeker@test.com
   Password: jobseeker123
   ```

## Access Admin Panel

Once logged in as admin, navigate to:
- http://127.0.0.1:8000/admin/dashboard

You'll see:
- Total users, jobs, applications
- Users by role breakdown
- Quick links to manage users, jobs, and applications
