<x-layout>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-900">Job Applications</h1>
      <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg">
        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
      </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Email</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Phone</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resume</th>
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
                    <div class="text-sm text-gray-500">{{ $application->user->email }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="text-sm text-gray-900">{{ Str::limit($application->job->title, 40) }}</div>
                <div class="text-sm text-gray-500">{{ $application->job->company_name ?? 'N/A' }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <a href="mailto:{{ $application->contact_email }}" class="text-sm text-blue-600 hover:text-blue-900">
                  {{ $application->contact_email }}
                </a>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $application->contact_phone ?? 'N/A' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $application->location ?? 'N/A' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $application->created_at->format('M d, Y') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                @if($application->resume_path)
                <a href="{{ asset('storage/' . $application->resume_path) }}" 
                   target="_blank"
                   class="text-blue-600 hover:text-blue-900">
                  <i class="fas fa-file-pdf mr-1"></i> View Resume
                </a>
                @else
                <span class="text-gray-400">No resume</span>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                No applications found.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="px-6 py-4 bg-gray-50">
        {{ $applications->links() }}
      </div>
    </div>
  </div>
</x-layout>
