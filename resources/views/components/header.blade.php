<header class="bg-red-900 backdrop-blur-sm text-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
  <div class="container mx-auto px-4 py-3">
    <div class="flex justify-between items-center">
      <h1 class="text-3xl font-bold tracking-tight">
        <a href="{{ url('/') }}" class="hover:text-blue-200 transition-colors duration-200">Jobes</a>
      </h1>
      <nav class="hidden md:flex items-center gap-6">
    <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
    <x-nav-link url="/jobs" :active="request()->is('jobs')">All Jobs</x-nav-link>
      @auth
      @if(auth()->user()->isUser())
      <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')"
        >Saved Jobs</x-nav-link
      >
      @endif
      <!-- User Avatar Dropdown -->
      <div class="relative" x-data="{ userDropdown: false }">
        <button 
          @click="userDropdown = !userDropdown"
          class="flex items-center gap-3 hover:bg-white/10 px-3 py-2 rounded-xl transition-all duration-200 group"
        >
          <img
            src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('storage/avatars/default-avatar.png') }}"
            alt="{{ Auth::user()->name }}"
            class="w-10 h-10 rounded-full object-cover border-2 border-white/30 shadow-lg ring-2 ring-blue-800/50 group-hover:ring-white/50 transition-all duration-200"
            onerror="this.src='{{ asset('storage/avatars/default-avatar.png') }}'"
          />
          <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
          <i class="fa fa-chevron-down text-xs transition-transform duration-200" :class="userDropdown ? 'rotate-180' : ''"></i>
        </button>

        <!-- Dropdown Menu -->
        <div 
          x-show="userDropdown"
          @click.away="userDropdown = false"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
          x-transition:enter-end="opacity-100 scale-100 translate-y-0"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100 scale-100 translate-y-0"
          x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
          class="absolute right-0 mt-3 w-64 bg-white rounded-xl shadow-xl border border-gray-200/50 py-2 z-50 backdrop-blur-sm"
          style="display: none;"
        >
          <!-- User Info -->
          <div class="px-4 py-3 border-b border-gray-100/80">
            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500 mt-0.5">{{ Auth::user()->email }}</p>
          </div>
          
          <!-- Menu Items -->
          <div class="py-2">
            @if(Auth::user()->isUser())
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-blue-700 transition-colors duration-150 group">
              <i class="fa fa-gauge w-5 text-gray-400 group-hover:text-blue-600 transition-colors"></i>
              <span class="font-medium">Profile Page</span>
            </a>
            @endif
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-blue-700 transition-colors duration-150 group">
              <i class="fa fa-user-edit w-5 text-blue-600 group-hover:text-blue-700 transition-colors"></i>
              <span class="font-medium">Edit Profile</span>
            </a>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors duration-150 group">
              <i class="fa fa-user-shield w-5 text-purple-600 group-hover:text-purple-700 transition-colors"></i>
              <span class="font-medium">Admin Panel</span>
            </a>
            @endif
            @if(Auth::user()->isEmployer())
            <a href="{{ route('employer.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150 group">
              <i class="fa fa-briefcase w-5 text-green-600 group-hover:text-green-700 transition-colors"></i>
              <span class="font-medium">Employer Dashboard</span>
            </a>
            @endif
            @if(Auth::user()->isEmployer() || Auth::user()->isAdmin())
            <a href="{{ route('jobs.create') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 group">
              <i class="fa fa-edit w-5 text-gray-400 group-hover:text-gray-600 transition-colors"></i>
              <span class="font-medium">Create Job</span>
            </a>
            @endif
            <div class="border-t border-gray-100/80 my-2"></div>
            <form method="POST" action="{{ route('logout') }}" class="block">
              @csrf
              <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors duration-150 text-left group">
                <i class="fa fa-sign-out w-5 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                <span class="font-medium">Logout</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      @else
        <x-nav-link url="/login" :active="request()->is('login')"
          >Login</x-nav-link
        >
        {{-- <x-nav-link url="/register" :active="request()->is('register')"
          >Employer Site</x-nav-link
        > --}}
        @endauth
      </nav>
      <button @click="open = !open" class="text-white md:hidden flex items-center hover:bg-white/10 p-2 rounded-lg transition-colors duration-200">
        <i class="fa fa-bars text-2xl"></i>
      </button>
    </div>
  </div>
  <!-- Mobile Menu -->
  <div
    x-show="open"
    @click.away="open = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-[-10px]"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-[-10px]"
    class="md:hidden bg-red-900/95 backdrop-blur-sm text-white border-t border-white/10"
  >
    <div class="container mx-auto px-4 py-4 space-y-1">
      <x-nav-link url="/" :active="request()->is('/')" :mobile="true">Home</x-nav-link>
      <x-nav-link url="/jobs" :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>
      @auth
      @if(auth()->user()->isUser())
      <x-nav-link url="/bookmarks" :active="request()->is('bookmarks')" :mobile="true">Saved Jobs</x-nav-link>
      <x-nav-link url="/dashboard" :active="request()->is('dashboard')" :mobile="true">Dashboard</x-nav-link>
      @endif
      @if(auth()->user()->isAdmin())
      <x-nav-link url="/admin/dashboard" :active="request()->is('admin/dashboard')" :mobile="true">Admin Panel</x-nav-link>
      @endif
      @if(auth()->user()->isEmployer())
      <x-nav-link url="/employer/dashboard" :active="request()->is('employer/dashboard')" :mobile="true">Employer Dashboard</x-nav-link>
      @endif
      <x-nav-link url="/profile/edit" :active="request()->is('profile/edit')" :mobile="true">Edit Profile</x-nav-link>
      <div class="border-t border-white/10 my-2"></div>
      <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
        @csrf
        <button type="submit" class="text-white w-full text-left flex items-center gap-2 hover:text-red-300 transition-colors">
          <i class="fa fa-sign-out"></i>
          <span>Logout</span>
        </button>
      </form>
      @if(Auth::user()->isEmployer() || Auth::user()->isAdmin())
      <div class="pt-2">
        <x-button-link url="/jobs/create" icon="edit" :mobile="true">Create Job</x-button-link>
      </div>
      @endif
      @else
      <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
      <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
      @endauth
    </div>
  </div>
</header>