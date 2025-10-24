@props(['job'])
<div class="group relative bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200 h-[420px] flex flex-col">
  <!-- Card Header with Company Logo & Title -->
  <div class="p-6 border-b border-gray-100">
    <div class="flex items-start gap-4">
      <!-- Company Logo -->
      <div class="shrink-0">
        @if($job->company_logo)
        <div class="w-16 h-16 rounded-lg bg-gray-50 border border-gray-200 p-2 flex items-center justify-center overflow-hidden">
          <img
            src="/storage/{{ $job->company_logo }}"
            alt="{{$job->company_name}}"
            class="w-full h-full object-contain"
          />
        </div>
        @else
        <div class="w-16 h-16 rounded-lg bg-linear-to-br from-blue-500 to-blue-600 flex items-center justify-center">
          <i class="fa fa-building text-white text-2xl"></i>
        </div>
        @endif
      </div>
      
      <!-- Job Title & Company -->
      <div class="flex-1 min-w-0">
        <h2 class="text-lg font-bold text-gray-900 mb-1 line-clamp-2 group-hover:text-blue-600 transition-colors">
          {{ $job->title }}
        </h2>
        <p class="text-sm font-medium text-gray-600">{{ $job->company_name }}</p>
        <div class="flex items-center gap-2 mt-2">
          <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-red-50 text-blue-700 border border-blue-100">
            <i class="fa fa-briefcase mr-1.5 text-xs"></i>
            {{ $job->job_type }}
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Body - Fixed Height Content -->
  <div class="flex-1 p-6 flex flex-col justify-between overflow-hidden">
    <!-- Description - Fixed 3 lines -->
    <div class="mb-4">
      <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed">
        {{ $job->description }}
      </p>
    </div>

    <!-- Job Details -->
    <div class="space-y-3">
      <!-- Salary -->
      <div class="flex items-center gap-3">
        <div class="shrink-0 w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
          <i class="fa fa-dollar-sign text-green-600 text-sm"></i>
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-xs text-gray-500 font-medium">Salary</p>
          <p class="text-sm font-bold text-gray-900">${{ number_format($job->salary) }}</p>
        </div>
      </div>

      <!-- Location -->
      <div class="flex items-center gap-3">
        <div class="shrink-0 w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center">
          <i class="fa fa-location-dot text-purple-600 text-sm"></i>
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-xs text-gray-500 font-medium">Location</p>
          <div class="flex items-center gap-2">
            <p class="text-sm font-semibold text-gray-900 truncate">{{ $job->city }}, {{ $job->state }}</p>
            @if($job->remote)
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
              <i class="fa fa-house-laptop mr-1 text-[10px]"></i>Remote
            </span>
            @else
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-orange-100 text-orange-700 border border-orange-200">
              <i class="fa fa-building mr-1 text-[10px]"></i>On-site
            </span>
            @endif
          </div>
        </div>
      </div>

      <!-- Tags -->
      {{-- <div class="flex items-start gap-3">
        <div class="shrink-0 w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
          <i class="fa fa-tags text-indigo-600 text-sm"></i>
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-xs text-gray-500 font-medium mb-1">Tags</p>
          <div class="flex flex-wrap gap-1.5">
            @foreach(array_slice(explode(',', $job->tags), 0, 3) as $tag)
            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
              {{ trim($tag) }}
            </span>
            @endforeach
          </div>
        </div>
      </div> --}}
    </div>
  </div>

  <!-- Card Footer - Details Button -->
  <div class="p-4 bg-gray-50/50 border-t border-gray-100">
    <a
      href="{{ route('jobs.show', $job->id) }}"
      class="block w-full text-center px-5 py-3 rounded-lg text-sm font-semibold text-white bg-linear-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 shadow-sm hover:shadow-md transition-all duration-200 group"
    >
      <span class="flex items-center justify-center gap-2">
        View Details
        <i class="fa fa-arrow-right text-xs group-hover:translate-x-1 transition-transform duration-200"></i>
      </span>
    </a>
  </div>

  <!-- Hover Effect Accent -->
  <div class="absolute top-0 left-0 w-1 h-full bg-linear-to-b from-red-500 to-red-600 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-top"></div>
</div>
