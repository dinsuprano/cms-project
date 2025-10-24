<x-layout>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Job Applications</h1>
      <a href="{{ route('employer.dashboard') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">
        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
      </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
      <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Applied For</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resume</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($applications as $application)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <img src="{{ $application->user->avatar ? asset('storage/' . $application->user->avatar) : asset('storage/avatars/default-avatar.png') }}" 
                       alt="{{ $application->user->name }}" 
                       class="h-10 w-10 rounded-full object-cover">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ $application->full_name }}</div>
                    <div class="text-sm text-gray-500">{{ $application->user->name }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="text-sm text-gray-900">{{ Str::limit($application->job->title, 40) }}</div>
                <div class="text-sm text-gray-500">{{ $application->job->company_name ?? 'N/A' }}</div>
              </td>
              <td class="px-6 py-4">
                <div class="text-sm">
                  <a href="mailto:{{ $application->contact_email }}" class="text-blue-600 hover:text-blue-900">
                    {{ $application->contact_email }}
                  </a>
                </div>
                @if($application->contact_phone)
                <div class="text-sm mt-1">
                  <a href="tel:{{ $application->contact_phone }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-phone text-xs mr-1"></i>{{ $application->contact_phone }}
                  </a>
                </div>
                @endif
                @if($application->location)
                <div class="text-xs text-gray-500 mt-1">
                  <i class="fas fa-map-marker-alt mr-1"></i>{{ $application->location }}
                </div>
                @endif
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
                @if($application->resume_path)
                <a href="{{ asset('storage/' . $application->resume_path) }}" 
                   target="_blank"
                   class="inline-flex items-center px-3 py-1 bg-red-100 text-blue-700 rounded-md hover:bg-red-200">
                  <i class="fas fa-file-pdf mr-1"></i> View
                </a>
                @else
                <span class="text-gray-400">No resume</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex flex-col space-y-2">
                  <!-- Status Update Buttons -->
                  <div class="flex space-x-1">
                    <form method="POST" action="{{ route('employer.applications.status', $application->id) }}" class="inline">
                      @csrf
                      @method('PATCH')
                      <input type="hidden" name="status" value="accepted">
                      <button type="submit" 
                              class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs rounded hover:bg-green-200"
                              {{ $application->status === 'accepted' ? 'disabled' : '' }}>
                        <i class="fas fa-check mr-1"></i> Accept
                      </button>
                    </form>
                    <form method="POST" action="{{ route('employer.applications.status', $application->id) }}" class="inline">
                      @csrf
                      @method('PATCH')
                      <input type="hidden" name="status" value="rejected">
                      <button type="submit" 
                              class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 text-xs rounded hover:bg-red-200"
                              {{ $application->status === 'rejected' ? 'disabled' : '' }}>
                        <i class="fas fa-times mr-1"></i> Reject
                      </button>
                    </form>
                  </div>
                  <!-- Delete Button -->
                  <form method="POST" action="{{ route('employer.applications.delete', $application->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this application?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded hover:bg-gray-200 w-full justify-center">
                      <i class="fas fa-trash mr-1"></i> Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="px-6 py-8 text-center">
                <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
                <p class="text-gray-500">No applications received yet.</p>
                <p class="text-gray-400 text-sm mt-2">Applications will appear here when job seekers apply to your jobs.</p>
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
