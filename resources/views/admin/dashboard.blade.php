<x-layout>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
      <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-lg font-semibold">
        <i class="fas fa-user-shield mr-2"></i>Admin
      </span>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <!-- Total Users -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Users</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</h3>
          </div>
          <div class="bg-red-100 p-3 rounded-lg">
            <i class="fas fa-users text-blue-600 text-2xl"></i>
          </div>
        </div>
      </div>

      <!-- Total Jobs -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Jobs</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_jobs'] }}</h3>
          </div>
          <div class="bg-green-100 p-3 rounded-lg">
            <i class="fas fa-briefcase text-green-600 text-2xl"></i>
          </div>
        </div>
      </div>

      <!-- Total Applications -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Applications</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_applications'] }}</h3>
          </div>
          <div class="bg-yellow-100 p-3 rounded-lg">
            <i class="fas fa-file-alt text-yellow-600 text-2xl"></i>
          </div>
        </div>
      </div>

      <!-- Admins -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Admin Users</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['users_by_role']['admin'] ?? 0 }}</h3>
          </div>
          <div class="bg-purple-100 p-3 rounded-lg">
            <i class="fas fa-user-shield text-purple-600 text-2xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Users by Role -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
      <h2 class="text-xl font-bold text-gray-900 mb-4">Users by Role</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 bg-red-50 rounded-lg">
          <p class="text-gray-600 text-sm">Job Seekers</p>
          <p class="text-2xl font-bold text-blue-600">{{ $stats['users_by_role']['user'] ?? 0 }}</p>
        </div>
        <div class="p-4 bg-green-50 rounded-lg">
          <p class="text-gray-600 text-sm">Employers</p>
          <p class="text-2xl font-bold text-green-600">{{ $stats['users_by_role']['employer'] ?? 0 }}</p>
        </div>
        <div class="p-4 bg-purple-50 rounded-lg">
          <p class="text-gray-600 text-sm">Administrators</p>
          <p class="text-2xl font-bold text-purple-600">{{ $stats['users_by_role']['admin'] ?? 0 }}</p>
        </div>
      </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <a href="{{ route('admin.users') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Manage Users</h3>
            <p class="text-gray-500 text-sm mt-1">View and manage all users</p>
          </div>
          <i class="fas fa-arrow-right text-blue-600"></i>
        </div>
      </a>

      <a href="{{ route('admin.jobs') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Manage Jobs</h3>
            <p class="text-gray-500 text-sm mt-1">View and manage all job listings</p>
          </div>
          <i class="fas fa-arrow-right text-green-600"></i>
        </div>
      </a>

      <a href="{{ route('admin.applications') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">View Applications</h3>
            <p class="text-gray-500 text-sm mt-1">Monitor all job applications</p>
          </div>
          <i class="fas fa-arrow-right text-yellow-600"></i>
        </div>
      </a>
    </div>
  </div>
</x-layout>
