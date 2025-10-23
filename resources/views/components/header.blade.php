<header class="bg-blue-900 text-white p-4" x-data="{ open: false }">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-3xl font-semibold">
      <a href="{{ url('/') }}">Jobes</a>
    </h1>
    <nav class="hidden md:flex items-center space-x-4">
    <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
    <x-nav-link url="/jobs" :active="request()->is('jobs')">All Jobs</x-nav-link>
      @auth
      <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')"
        >Saved Jobs</x-nav-link
      >
      <!-- User Avatar Dropdown -->
      <div class="relative" x-data="{ userDropdown: false }">
        <button 
          @click="userDropdown = !userDropdown"
          class="flex items-center space-x-2 hover:bg-blue-800 px-2 py-1 rounded-lg transition duration-200"
        >
          <img
            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('storage/avatars/default-avatar.png') }}"
            alt="{{ Auth::user()->name }}"
            class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-lg"
            onerror="this.src='{{ asset('storage/avatars/default-avatar.png') }}'"
          />
          <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
          <i class="fa fa-chevron-down text-xs transition-transform" :class="userDropdown ? 'rotate-180' : ''"></i>
        </button>

        <!-- Dropdown Menu -->
        <div 
          x-show="userDropdown"
          @click.away="userDropdown = false"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
          class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50"
          style="display: none;"
        >
          <!-- User Info -->
          <div class="px-4 py-3 border-b border-gray-100">
            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
          </div>
          
          <!-- Menu Items -->
          <div class="py-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fa fa-gauge mr-3 text-gray-400"></i>
              Profile Page
            </a>
            <a href="{{ route('jobs.create') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fa fa-edit mr-3 text-gray-400"></i>
              Create Job
            </a>
            <div class="border-t border-gray-100 my-1"></div>
            <form method="POST" action="{{ route('logout') }}" class="block">
              @csrf
              <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">
                <i class="fa fa-sign-out mr-3 text-gray-400"></i>
                Logout
              </button>
            </form>
          </div>
        </div>
      </div>
      @else
      <x-nav-link url="/login" :active="request()->is('login')"
        >Login</x-nav-link
      >
      <x-nav-link url="/register" :active="request()->is('register')"
        >Register</x-nav-link
      >
      @endauth
    </nav>
    <button @click="open = !open" class="text-white md:hidden flex items-center">
      <i class="fa fa-bars text-2xl"></i>
    </button>
  </div>
  <!-- Mobile Menu -->
<div
  x-show="open"
  @click.away="open = false"
  class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2"
>
    <x-nav-link url="/" :active="request()->is('/')" :mobile="true">Home</x-nav-link>
    <x-nav-link url="/jobs" :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>
    @auth
    <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" :mobile="true">Saved Jobs</x-nav-link>
    <x-nav-link url="/dashboard" :active="request()->is('dashboard')" :mobile="true">Dashboard</x-nav-link>
    <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
      @csrf
      <button type="submit" class="text-white w-full text-left">
        <i class="fa fa-sign-out mr-1"></i> Logout
      </button>
    </form>
    <x-button-link url="/jobs/create" icon="edit" :mobile="true">Create Job</x-button-link>
    @else
    <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
    <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
    @endauth
  </div>
</header>