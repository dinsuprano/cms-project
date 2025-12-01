<x-layout>
  <div class="container mx-auto px-4 py-8 max-w-4xl" x-data="{ activeTab: 'personal' }">
    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
      <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span>{{ session('success') }}</span>
      </div>
      <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
        <i class="fas fa-times"></i>
      </button>
    </div>
    @endif

    <!-- Page Header -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Edit Profile</h1>
      <p class="text-gray-600 mt-2">Update your personal information and settings</p>
    </div>

    <!-- Tab Navigation -->
    <div class="mb-6">
      <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
          <button
            @click="activeTab = 'personal'"
            :class="activeTab === 'personal' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
          >
            <i class="fas fa-user mr-2"></i>Personal Information
          </button>
          <button
            @click="activeTab = 'password'"
            :class="activeTab === 'password' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
          >
            <i class="fas fa-lock mr-2"></i>Change Password
          </button>
        </nav>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Profile Picture Section -->
      <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
          <h2 class="text-lg font-semibold text-gray-900 mb-4">Profile Picture</h2>
          
          <div class="flex flex-col items-center">
            <img
              id="avatar-preview"
              src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('storage/avatars/default-avatar.svg') }}"
              alt="{{ $user->name }}"
              class="w-40 h-40 rounded-full object-cover border-4 border-blue-500 shadow-lg mb-4"
            />
            
            <div class="w-full">
              <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                Change Avatar
              </label>
              <input
                type="file"
                id="avatar-input"
                name="avatar"
                accept="image/*"
                class="hidden"
                onchange="previewAvatar(event)"
              />
              <button
                type="button"
                onclick="document.getElementById('avatar-input').click()"
                class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors"
              >
                <i class="fas fa-upload mr-2"></i>Upload New Photo
              </button>
              <p class="text-xs text-gray-500 mt-2">JPG, PNG or GIF (Max 2MB)</p>
            </div>
          </div>

          <!-- Role Badge -->
          <div class="mt-6 pt-6 border-t border-gray-200">
            <p class="text-sm text-gray-600 mb-2">Account Type</p>
            @if($user->isAdmin())
            <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
              <i class="fas fa-shield-alt mr-2"></i>Administrator
            </span>
            @elseif($user->isEmployer())
            <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
              <i class="fas fa-briefcase mr-2"></i>Employer
            </span>
            @else
            <span class="inline-flex items-center px-3 py-1 bg-red-100 text-blue-800 rounded-full text-sm font-semibold">
              <i class="fas fa-user mr-2"></i>Job Seeker
            </span>
            @endif
          </div>
        </div>
      </div>

      <!-- Profile Form Section -->
      <div class="lg:col-span-2">
        <!-- Personal Information Tab -->
        <div x-show="activeTab === 'personal'" x-cloak>
          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profile-form">
            @csrf
            @method('PUT')

            <!-- Hidden file input (will be populated when image is selected) -->
            <input type="file" name="avatar" id="avatar-form-input" class="hidden">

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
              <h2 class="text-lg font-semibold text-gray-900 mb-6">Personal Information</h2>

              <!-- Name Field -->
              <x-inputs.text
                id="name"
                name="name"
                label="Full Name"
                :value="$user->name"
                :required="true"
                placeholder="Enter your full name"
              />

              <!-- Email Field -->
              <x-inputs.text
                id="email"
                name="email"
                label="Email Address"
                type="email"
                :value="$user->email"
                :required="true"
                placeholder="Enter your email address"
              />

              <!-- Phone Number Field -->
              <x-inputs.text
                id="phone_number"
                name="phone_number"
                label="Phone Number"
                type="tel"
                :value="$user->phone_number"
                :required="$user->isUser()"
                placeholder="+1 (555) 123-4567"
              />
              @if($user->isUser())
              <p class="-mt-4 mb-6 text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>Required for job seeker accounts
              </p>
              @endif

              <!-- Location Field -->
              <x-inputs.text
                id="location"
                name="location"
                label="Location"
                :value="$user->location"
                :required="$user->isUser()"
                placeholder="City, State"
              />
              @if($user->isUser())
              <p class="-mt-4 mb-6 text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>Required for job seeker accounts
              </p>
              @endif
            </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-4">
            <button
              type="submit"
              class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors"
            >
              <i class="fas fa-save mr-2"></i>Save Changes
            </button>
            <a
              href="{{ route('dashboard') }}"
              class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium text-center transition-colors"
            >
              <i class="fas fa-times mr-2"></i>Cancel
            </a>
          </div>
        </form>

        <!-- Delete Account Section -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-6 mt-6">
          <h2 class="text-lg font-semibold text-red-900 mb-2">Danger Zone</h2>
          <p class="text-sm text-red-700 mb-4">
            Once you delete your account, there is no going back. Please be certain.
          </p>
          
          <button
            type="button"
            onclick="openDeleteModal()"
            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors"
          >
            <i class="fas fa-trash-alt mr-2"></i>Delete Account
          </button>
        </div>
      </div>

      <!-- Change Password Tab -->
      <div x-show="activeTab === 'password'" x-cloak>
        <form action="{{ route('profile.password.update') }}" method="POST">
          @csrf
          @method('PUT')

          <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-6">Change Password</h2>
            
            <p class="text-sm text-gray-600 mb-6">
              Ensure your account is using a long, random password to stay secure.
            </p>

            <!-- Current Password Field -->
            <x-inputs.text
              id="current_password"
              name="current_password"
              label="Current Password"
              type="password"
              :required="true"
              placeholder="Enter your current password"
            />

            <!-- New Password Field -->
            <x-inputs.text
              id="new_password"
              name="new_password"
              label="New Password"
              type="password"
              :required="true"
              placeholder="Enter your new password (min 8 characters)"
            />
            <p class="-mt-4 mb-6 text-xs text-gray-500">
              <i class="fas fa-info-circle mr-1"></i>Minimum 8 characters
            </p>

            <!-- Confirm New Password Field -->
            <x-inputs.text
              id="new_password_confirmation"
              name="new_password_confirmation"
              label="Confirm New Password"
              type="password"
              :required="true"
              placeholder="Confirm your new password"
            />
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-4">
            <button
              type="submit"
              class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors"
            >
              <i class="fas fa-key mr-2"></i>Update Password
            </button>
            <a
              href="{{ route('dashboard') }}"
              class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium text-center transition-colors"
            >
              <i class="fas fa-times mr-2"></i>Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <!-- Delete Account Modal -->
  <div
    id="deleteModal"
    class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
    onclick="closeDeleteModal(event)"
  >
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6" onclick="event.stopPropagation()">
      <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mx-auto mb-4">
        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
      </div>
      
      <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Delete Account</h3>
      <p class="text-gray-600 text-center mb-6">
        This action cannot be undone. All your data will be permanently deleted.
      </p>

      <form action="{{ route('profile.destroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <x-inputs.text
          id="delete-password"
          name="password"
          label="Confirm your password"
          type="password"
          :required="true"
          placeholder="Enter your password"
        />

        <div class="flex gap-3">
          <button
            type="button"
            onclick="closeDeleteModal()"
            class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition-colors"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors"
          >
            Delete Account
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Preview avatar before upload
    function previewAvatar(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('avatar-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
        
        // Copy the file to the form input
        const formInput = document.getElementById('avatar-form-input');
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        formInput.files = dataTransfer.files;
      }
    }

    // Delete modal functions
    function openDeleteModal() {
      document.getElementById('deleteModal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal(event) {
      if (!event || event.target.id === 'deleteModal') {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('delete-password').value = '';
      }
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeDeleteModal();
      }
    });
  </script>
</x-layout>
