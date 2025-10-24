<x-layout>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">My Job Listings</h1>
      <div class="flex space-x-3">
        <a href="{{ route('jobs.create') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
          <i class="fas fa-plus mr-2"></i>Post New Job
        </a>
        <a href="{{ route('employer.dashboard') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">
          <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Type</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applications</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($jobs as $job)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">{{ Str::limit($job->title, 40) }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ $job->company_name ?? 'N/A' }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">{{ $job->city }}, {{ $job->state }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-blue-800">
                  {{ $job->job_type }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                ${{ number_format($job->salary) }}
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
                <a href="{{ route('jobs.edit', $job->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <form method="POST" action="{{ route('jobs.destroy', $job->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this job?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900">
                    <i class="fas fa-trash"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="8" class="px-6 py-8 text-center">
                <i class="fas fa-briefcase text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-500 mb-4">You haven't posted any jobs yet.</p>
                <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                  <i class="fas fa-plus mr-2"></i> Post Your First Job
                </a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($jobs->hasPages())
      <div class="px-6 py-4 bg-gray-50">
        {{ $jobs->links() }}
      </div>
      @endif
    </div>
  </div>
</x-layout>
