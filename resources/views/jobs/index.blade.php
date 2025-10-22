<x-layout>
  <ul>
    @forelse($jobs as $job)
        <li>
          <a href="{{ route('jobs.show', $job->id) }}">
            {{ $job->title }}
          </a>
        </li>
    @empty
        <li>No jobs found</li>
    @endforelse
  </ul>
</x-layout>