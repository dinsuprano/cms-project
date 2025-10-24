@props(['heading' => 'Your Next Career Move Starts Here.', 'subheading' => 'Explore. Apply. Succeed.'])

<!-- Call to Action Banner -->

<section class="container mx-auto my-12 px-4">
    <div class="bg-linear-to-r from-red-600 to-red-700 text-white rounded-2xl p-8 md:p-12 shadow-xl relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-center md:text-left">
                <h2 class="text-3xl md:text-4xl font-bold mb-3">{{$heading}}</h2>
                <p class="text-blue-100 text-lg max-w-2xl">
                    {{$subheading}}
                </p>
            </div>
            <div class="shrink-0">
                <x-button-link url="{{ route('register') }}" type="button" icon="edit">Apply Now</x-button-link>
            </div>
        </div>
    </div>
</section>

<!-- Professional Footer -->
<footer class="bg-white border-t border-gray-200 mt-16">
    <!-- Main Footer Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <!-- Company Info -->
            <div class="space-y-4">
                <h3 class="text-2xl font-bold text-blue-900">Jobes</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Your trusted partner in finding the perfect career opportunity. Connect with top employers and discover your dream job today.
                </p>
                <!-- Social Media -->
                <div class="flex gap-3 pt-2">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-red-600 text-gray-600 hover:text-white flex items-center justify-center transition-all duration-200">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-red-600 text-gray-600 hover:text-white flex items-center justify-center transition-all duration-200">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-red-600 text-gray-600 hover:text-white flex items-center justify-center transition-all duration-200">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-red-600 text-gray-600 hover:text-white flex items-center justify-center transition-all duration-200">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- For Job Seekers -->
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-gray-900">For Job Seekers</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Browse Jobs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Search Jobs
                        </a>
                    </li>
                    @auth
                    @if(auth()->user()->isUser())
                    <li>
                        <a href="{{ route('bookmarks.index') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Saved Jobs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            My Applications
                        </a>
                    </li>
                    @endif
                    @endauth
                    <li>
                        <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Profile
                        </a>
                    </li>
                </ul>
            </div>

            <!-- For Employers -->
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-gray-900">For Employers</h4>
                <ul class="space-y-3">
                    @auth
                    @if(auth()->user()->isEmployer() || auth()->user()->isAdmin())
                    <li>
                        <a href="{{ route('jobs.create') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Post a Job
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employer.dashboard') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Employer Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employer.jobs') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Manage Jobs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('employer.applications') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            View Applications
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Employer Registration
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Pricing Plans
                        </a>
                    </li>
                    @endif
                    @else
                    <li>
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Employer Login
                        </a>
                    </li>
                    @endauth
                    <li>
                        <a href="#" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Post a Job
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support & Legal -->
            <div class="space-y-4">
                <h4 class="text-lg font-bold text-gray-900">Support & Legal</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Help Center
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-blue-600 text-sm flex items-center gap-2 transition-colors duration-200">
                            <i class="fa fa-chevron-right text-xs"></i>
                            Cookie Policy
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="border-t border-gray-200 bg-gray-50">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-600">
                    © {{ date('Y') }} <span class="font-semibold text-gray-900">Jobes</span>. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                        Sitemap
                    </a>
                    <a href="#" class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                        Accessibility
                    </a>
                    <a href="#" class="text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200">
                        Report Issue
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>