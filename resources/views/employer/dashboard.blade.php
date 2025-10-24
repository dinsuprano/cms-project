<x-layout>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Employer Dashboard</h1>
      <span class="px-4 py-2 bg-green-100 text-green-800 rounded-lg font-semibold">
        <i class="fas fa-briefcase mr-2"></i>Employer
      </span>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <!-- Total Jobs Posted -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Jobs Posted</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_jobs'] }}</h3>
          </div>
          <div class="bg-red-100 p-3 rounded-lg">
            <i class="fas fa-briefcase text-blue-600 text-2xl"></i>
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
          <div class="bg-green-100 p-3 rounded-lg">
            <i class="fas fa-file-alt text-green-600 text-2xl"></i>
          </div>
        </div>
      </div>

      <!-- Active Jobs -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Active Jobs</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['active_jobs'] }}</h3>
          </div>
          <div class="bg-purple-100 p-3 rounded-lg">
            <i class="fas fa-check-circle text-purple-600 text-2xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <a href="{{ route('jobs.create') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Post New Job</h3>
            <p class="text-gray-500 text-sm mt-1">Create a new job listing</p>
          </div>
          <i class="fas fa-plus-circle text-blue-600 text-2xl"></i>
        </div>
      </a>

      <a href="{{ route('employer.jobs') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">My Job Listings</h3>
            <p class="text-gray-500 text-sm mt-1">View and manage your jobs</p>
          </div>
          <i class="fas fa-list text-green-600 text-2xl"></i>
        </div>
      </a>

      <a href="{{ route('employer.applications') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Applications</h3>
            <p class="text-gray-500 text-sm mt-1">Review applicants</p>
          </div>
          <i class="fas fa-users text-purple-600 text-2xl"></i>
        </div>
      </a>
    </div>

    <!-- Recent Jobs -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Job Postings</h2>
      @if($recentJobs->count() > 0)
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applications</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($recentJobs as $job)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">{{ $job->title }}</div>
                <div class="text-sm text-gray-500">{{ $job->job_type }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $job->city }}, {{ $job->state }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  {{ $job->applicants_count }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $job->created_at->format('M d, Y') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="{{ route('jobs.show', $job->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                  <i class="fas fa-eye"></i> View
                </a>
                <a href="{{ route('jobs.edit', $job->id) }}" class="text-indigo-600 hover:text-indigo-900">
                  <i class="fas fa-edit"></i> Edit
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <div class="text-center py-8">
        <i class="fas fa-briefcase text-gray-400 text-5xl mb-4"></i>
        <p class="text-gray-500 mb-4">You haven't posted any jobs yet.</p>
        <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
          <i class="fas fa-plus mr-2"></i> Post Your First Job
        </a>
      </div>
      @endif
    </div>
  </div>
</x-layout>
