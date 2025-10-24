<x-layout>
  <div class="container mx-auto px-4 py-8">
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

    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img
            src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('storage/avatars/default-avatar.png') }}"
            alt="{{ $user->name }}"
            class="w-24 h-24 rounded-full object-cover border-4 border-blue-500 shadow-lg"
          />
          <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
            <p class="text-gray-600 mt-1">{{ $user->email }}</p>
            <span class="inline-flex items-center mt-2 px-3 py-1 bg-red-100 text-blue-800 rounded-full text-sm font-semibold">
              <i class="fas fa-user mr-2"></i>Job Seeker
            </span>
          </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
          <i class="fas fa-edit mr-2"></i>Edit Profile
        </a>
      </div>
    </div>

    <!-- Application Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Applications</p>
            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $applications->total() }}</h3>
          </div>
          <div class="bg-red-100 p-3 rounded-lg">
            <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Accepted</p>
            <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $applications->where('status', 'accepted')->count() }}</h3>
          </div>
          <div class="bg-green-100 p-3 rounded-lg">
            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Pending</p>
            <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ $applications->where('status', 'pending')->count() }}</h3>
          </div>
          <div class="bg-yellow-100 p-3 rounded-lg">
            <i class="fas fa-clock text-yellow-600 text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Rejected</p>
            <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $applications->where('status', 'rejected')->count() }}</h3>
          </div>
          <div class="bg-red-100 p-3 rounded-lg">
            <i class="fas fa-times-circle text-red-600 text-2xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Application History -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900">My Applications</h2>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied Date</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($applications as $application)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">{{ $application->job->title }}</div>
                <div class="text-sm text-gray-500">{{ $application->job->job_type }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                {{ $application->job->company_name ?? 'N/A' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $application->job->city }}, {{ $application->job->state }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $application->created_at->format('M d, Y') }}
                <div class="text-xs text-gray-400">{{ $application->created_at->diffForHumans() }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if($application->status === 'accepted')
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  <i class="fas fa-check-circle mr-1"></i> Accepted
                </span>
                @elseif($application->status === 'rejected')
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                  <i class="fas fa-times-circle mr-1"></i> Rejected
                </span>
                @else
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                  <i class="fas fa-clock mr-1"></i> Pending
                </span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex items-center gap-2">
                  <a href="{{ route('jobs.show', $application->job->id) }}" class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-eye mr-1"></i> View Job
                  </a>
                  <form action="{{ route('dashboard.applications.delete', $application->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this application?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">
                      <i class="fas fa-trash mr-1"></i> Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="px-6 py-8 text-center">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-500 mb-4">You haven't applied to any jobs yet.</p>
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                  <i class="fas fa-search mr-2"></i> Browse Jobs
                </a>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      @if($applications->hasPages())
      <div class="px-6 py-4 bg-gray-50">
        {{ $applications->links() }}
      </div>
      @endif
    </div>
  </div>
</x-layout>
