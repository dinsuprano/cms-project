# User Profile Management System

## Overview
Complete profile management system allowing users to edit their personal information and delete their accounts. Job seekers have additional required fields (phone number and location).

## Features Implemented ✅

### 1. Database Migration
**File**: `database/migrations/2025_10_24_104732_add_location_and_phone_to_users_table.php`

**New Fields Added:**
- `phone_number` (string, nullable)
- `location` (string, nullable)

**Note**: Both fields are nullable in the database but required for job seekers through validation.

### 2. User Model Update
**File**: `app/Models/User.php`

**Added to Fillable:**
```php
'phone_number',
'location',
```

### 3. Profile Controller
**File**: `app/Http/Controllers/ProfileController.php`

#### Methods Implemented:

**`edit()` - Show Profile Edit Form**
- Returns profile edit view
- Passes authenticated user data

**`update()` - Update Profile**
- Validates all fields
- **Conditional Validation**:
  - Phone & Location: Required for job seekers (`isUser()`)
  - Phone & Location: Optional for employers/admins
- Handles avatar upload with preview
- Deletes old avatar when new one is uploaded
- Updates user information
- Redirects with success message

**`updatePassword()` - Change Password (NEW)**
- Validates current password
- Verifies current password matches
- Validates new password (min 8 characters)
- Requires password confirmation
- Hashes and updates password
- Returns success message

**`destroy()` - Delete Account**
- Requires password confirmation
- Validates password before deletion
- Deletes user avatar from storage
- Logs out the user
- Deletes user account
- Invalidates session
- Redirects to homepage with success message

### 4. Profile Edit View
**File**: `resources/views/profile/edit.blade.php`

#### Layout Structure:

**📑 Tabbed Interface (NEW):**
- **Personal Information Tab** - Update profile details
- **Change Password Tab** - Update password

**Two-Column Layout:**
1. **Left Sidebar** (Profile Picture Section)
   - Large avatar preview (40x40 rounded)
   - Upload new photo button
   - File type and size info
   - Role badge (Admin/Employer/Job Seeker)
   - Sticky positioning on desktop

2. **Right Main Content** (Tabbed Content)
   - Tab navigation with Alpine.js
   - Personal information form (Tab 1)
   - Change password form (Tab 2)
   - Danger zone (delete account - Tab 1 only)

#### Personal Information Tab Fields:

1. **Name** (Required for all)
   - Text input
   - Full name

2. **Email** (Required for all)
   - Email input
   - Unique validation

3. **Phone Number**
   - Required for Job Seekers (red asterisk)
   - Optional for Employers/Admins
   - Help text for job seekers
   - Placeholder: "+1 (555) 123-4567"

4. **Location**
   - Required for Job Seekers (red asterisk)
   - Optional for Employers/Admins
   - Help text for job seekers
   - Placeholder: "City, State"

5. **Avatar Upload**
   - Image file input (hidden)
   - Click "Upload New Photo" button
   - Live preview before upload
   - Max 2MB, JPG/PNG/GIF
   - Automatic old avatar deletion

#### Change Password Tab Fields (NEW):

1. **Current Password** (Required)
   - Password input
   - Must match existing password
   - Error shown if incorrect

2. **New Password** (Required)
   - Password input
   - Minimum 8 characters
   - Help text shown

3. **Confirm New Password** (Required)
   - Password input
   - Must match new password
   - Validation error if mismatch

#### Features:

**✨ Avatar Preview**
- JavaScript preview before upload
- Updates image immediately when file selected
- File transferred to form input automatically

**🎨 Responsive Design**
- Mobile: Single column stacked layout
- Tablet: 2 columns
- Desktop: 3-column grid with sticky sidebar

**💾 Action Buttons**
- Save Changes (Blue)
- Cancel (Gray) - Returns to dashboard

**⚠️ Danger Zone**
- Red-themed section
- Delete account button
- Warning message

### 5. Delete Account Modal
**File**: `resources/views/profile/edit.blade.php` (included)

#### Features:
- Modal overlay with backdrop blur
- Warning icon (red)
- Password confirmation required
- Cannot be undone warning
- Cancel and Delete buttons
- Closes on Escape key
- Closes on backdrop click

#### Security:
- Password verification in controller
- Error message if password incorrect
- Session invalidation after deletion
- Automatic logout

### 6. Routes Configuration
**File**: `routes/web.php`

**New Routes:**
```php
GET  /profile/edit            - Show edit form
PUT  /profile                 - Update profile
PUT  /profile/password        - Update password (NEW)
DELETE /profile               - Delete account
```

All routes protected by `auth` middleware.

### 7. Navigation Updates
**File**: `resources/views/components/header.blade.php`

**Desktop Dropdown Menu:**
- Added "Edit Profile" link (blue user-edit icon)
- Positioned after "Profile Page", before dashboards

**Mobile Menu:**
- Added "Edit Profile" link
- Accessible to all authenticated users

**File**: `resources/views/dashboard/jobseeker.blade.php`
- Fixed "Edit Profile" button to point to `profile.edit` route

## User Interface

### Profile Edit Page

**Color Scheme:**
- Primary Action: Blue (`bg-red-600`)
- Danger: Red (`bg-red-600`)
- Cancel: Gray (`bg-gray-200`)

**Card Sections:**
1. Profile Picture Card (Sticky)
2. Personal Information Card
3. Danger Zone Card (Red theme)

### Success Messages
- Green banner at top
- Dismissible (X button)
- Auto-shows after update

### Error Messages
- Red text below each field
- Laravel validation errors
- Password confirmation errors

## Validation Rules

### All Users:
- **Name**: Required, string, max 255 characters
- **Email**: Required, unique (except own), valid email format
- **Avatar**: Optional, image file, max 2MB, JPG/PNG/GIF

### Job Seekers Only (role='user'):
- **Phone Number**: Required, string, max 20 characters
- **Location**: Required, string, max 255 characters

### Employers & Admins:
- **Phone Number**: Optional, string, max 20 characters
- **Location**: Optional, string, max 255 characters

### Password Change (All Users):
- **Current Password**: Required, string
- **New Password**: Required, string, min 8 characters, must have confirmation
- **New Password Confirmation**: Required, must match new password

## JavaScript Functionality

### Tab Navigation (Alpine.js)
```javascript
x-data="{ activeTab: 'personal' }"
```
- Manages active tab state
- Switches between Personal Info and Change Password
- Shows/hides content with x-show
- x-cloak prevents flash of unstyled content

### Avatar Preview
```javascript
function previewAvatar(event)
```
- Reads selected file
- Displays preview immediately
- Transfers file to form input
- No page reload needed

### Delete Modal
```javascript
openDeleteModal()
closeDeleteModal(event)
```
- Shows/hides modal
- Prevents body scroll when open
- Closes on Escape key
- Closes on backdrop click
- Clears password field on close

## Security Features

### Profile Update:
- ✅ Authentication required
- ✅ Email uniqueness check (excluding own)
- ✅ File type validation (images only)
- ✅ File size limit (2MB)
- ✅ Old avatar deletion (prevents storage bloat)
- ✅ XSS protection via Blade escaping

### Password Change:
- ✅ Authentication required
- ✅ Current password verification
- ✅ New password minimum 8 characters
- ✅ Password confirmation required
- ✅ Passwords must match
- ✅ Password hashing with bcrypt
- ✅ CSRF protection

### Account Deletion:
- ✅ Password confirmation required
- ✅ Password verification before deletion
- ✅ Session invalidation
- ✅ Automatic logout
- ✅ Avatar file deletion
- ✅ CSRF protection

## Usage

### Edit Profile

1. **Access Edit Page:**
   - Click avatar/name in header → "Edit Profile"
   - Click "Edit Profile" button on dashboard
   - Visit: http://127.0.0.1:8000/profile/edit

2. **Update Information (Personal Information Tab):**
   - Change name, email, phone, or location
   - Upload new avatar (optional)
   - See live preview of new avatar
   - Click "Save Changes"

3. **Required Fields for Job Seekers:**
   - Phone number (marked with red asterisk)
   - Location (marked with red asterisk)
   - Help text appears below these fields

### Change Password (NEW)

1. **Access Password Tab:**
   - Go to Edit Profile page
   - Click "Change Password" tab

2. **Update Password:**
   - Enter current password
   - Enter new password (min 8 characters)
   - Confirm new password
   - Click "Update Password"
   - Success message appears

3. **Validation:**
   - Current password must be correct
   - New password must be at least 8 characters
   - Confirmation must match new password
   - Errors shown if validation fails

### Delete Account

1. **Access Danger Zone:**
   - Scroll to bottom of profile edit page
   - Red "Danger Zone" section

2. **Delete Account:**
   - Click "Delete Account" button
   - Modal appears with warning
   - Enter your password to confirm
   - Click "Delete Account" in modal
   - Account deleted, logged out, redirected to home

## File Structure

### Created Files:
```
resources/views/profile/edit.blade.php
database/migrations/2025_10_24_104732_add_location_and_phone_to_users_table.php
```

### Modified Files:
```
app/Models/User.php
app/Http/Controllers/ProfileController.php
routes/web.php
resources/views/components/header.blade.php
resources/views/dashboard/jobseeker.blade.php
```

## Test Accounts

| Role | Email | Password | Phone/Location Required |
|------|-------|----------|------------------------|
| Job Seeker | jobseeker@test.com | jobseeker123 | Yes (both required) |
| Employer | employer@test.com | employer123 | No (optional) |
| Admin | admin@admin.com | admin123 | No (optional) |

## Testing Checklist

### Profile Update:
- [ ] Login as job seeker
- [ ] Visit Edit Profile page
- [ ] Verify "Personal Information" tab is active by default
- [ ] Upload new avatar - see preview
- [ ] Update name, email, phone, location
- [ ] Click "Save Changes"
- [ ] See success message
- [ ] Verify changes in dashboard
- [ ] Try submitting without phone/location (should fail for job seekers)

### Password Change (NEW):
- [ ] Go to Edit Profile page
- [ ] Click "Change Password" tab
- [ ] Try wrong current password - see error
- [ ] Enter correct current password
- [ ] Enter new password (< 8 chars) - see error
- [ ] Enter valid new password (≥ 8 chars)
- [ ] Enter mismatched confirmation - see error
- [ ] Enter matching confirmation
- [ ] Click "Update Password"
- [ ] See success message
- [ ] Logout and login with new password - should work
- [ ] Try old password - should fail

### Account Deletion:
- [ ] Visit Edit Profile page
- [ ] Click "Delete Account" in Danger Zone
- [ ] Modal appears
- [ ] Enter wrong password - see error
- [ ] Enter correct password
- [ ] Click "Delete Account"
- [ ] Account deleted, logged out
- [ ] Redirected to home page
- [ ] Try logging in again (should fail)

### Navigation:
- [ ] Desktop: Click avatar → See "Edit Profile" link
- [ ] Mobile: Open menu → See "Edit Profile" link
- [ ] Job Seeker Dashboard: "Edit Profile" button works
- [ ] All links point to `/profile/edit`

### Validation:
- [ ] Job Seeker: Phone & Location required
- [ ] Employer: Phone & Location optional
- [ ] Email must be unique
- [ ] Avatar must be image file
- [ ] Avatar max 2MB
- [ ] Name is required
- [ ] Current password must be correct (password change)
- [ ] New password min 8 characters
- [ ] Password confirmation must match

### Tab Navigation:
- [ ] Personal Information tab active by default
- [ ] Click Change Password tab - content switches
- [ ] Click Personal Information tab - switches back
- [ ] No flash of unstyled content (x-cloak working)
- [ ] Tab highlighting shows active tab

## Error Handling

### Validation Errors:
- Display below each field
- Red text color
- Specific error messages

### File Upload Errors:
- Invalid file type
- File too large
- Storage permission issues

### Delete Account Errors:
- Wrong password
- Database constraints (if any)

## Responsive Design

### Mobile (< 768px):
- Single column layout
- Stacked sections
- Full-width buttons
- Avatar preview on top

### Tablet (768px - 1024px):
- 2-column grid
- Better spacing
- Side-by-side buttons

### Desktop (> 1024px):
- 3-column layout
- Sticky sidebar with avatar
- Optimal spacing
- 4xl max-width container

## Next Steps - Recommended Enhancements

### 1. Email Verification
- Require email verification when email changes
- Send confirmation email
- Verify new email before update

### 2. Password Change
- Add password change section
- Require current password
- New password confirmation
- Password strength indicator

### 3. Two-Factor Authentication
- Optional 2FA setup
- SMS or authenticator app
- Backup codes

### 4. Profile Completeness
- Show profile completion percentage
- Encourage filling all optional fields
- Badges for complete profiles

### 5. Avatar Cropper
- Crop/resize avatar before upload
- Predefined aspect ratios
- Zoom and rotate

### 6. Activity Log
- Show recent account activity
- Login history
- Profile changes log

### 7. Export Data
- GDPR compliance
- Download all user data
- JSON or CSV format

### 8. Account Deactivation
- Temporary account suspension
- Alternative to deletion
- Reactivation option

## Database Schema

### Users Table (Updated):
```sql
- id (bigint)
- name (string)
- email (string, unique)
- password (string)
- avatar (string, nullable)
- role (enum: user, employer, admin)
- phone_number (string, nullable)  ← NEW
- location (string, nullable)      ← NEW
- email_verified_at (timestamp)
- created_at (timestamp)
- updated_at (timestamp)
```

## Success! ✅

The profile management system is now fully functional with:
- ✅ Complete profile editing for all user types
- ✅ Role-based field requirements (job seekers)
- ✅ Avatar upload with live preview
- ✅ Account deletion with password confirmation
- ✅ Responsive design for all devices
- ✅ Comprehensive validation and security
- ✅ Accessible from multiple locations (header, dashboard)

Users can now manage their profiles with ease! 🎉
