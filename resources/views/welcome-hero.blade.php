<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel Skill Checker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white dark:bg-gray-900">
    {{-- Navigation Bar --}}
    <nav class="absolute top-0 left-0 right-0 z-20 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200/50 dark:border-gray-700/50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ config('app.name', 'Laravel Skill Checker') }}
                    </h1>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <x-ui.hero
        title="Track Your Laravel Learning Journey"
        subtitle="Skill Progress Tracker"
        description="Monitor your coding progress, log training sessions, and measure your improvement with our comprehensive skill tracking platform designed for developers."
        image="https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?w=800&q=80"
        imageAlt="Developer workspace"
        imagePosition="right"
        gradient="primary"
        height="screen"
    >
        <x-slot:actions>
            @auth
                <x-button link="{{ url('/dashboard') }}" class="btn-primary btn-lg">
                    Go to Dashboard
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </x-button>
            @else
                <x-button link="{{ route('register') }}" class="btn-primary btn-lg">
                    Start Tracking
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </x-button>
                <x-button link="{{ route('login') }}" class="btn-ghost btn-lg">
                    Sign In
                </x-button>
            @endauth
        </x-slot:actions>

        <x-slot:features>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-12">
                <x-ui.hero-feature
                    icon="o-chart-bar"
                    title="Track Progress"
                    description="Monitor your learning with detailed analytics and insights."
                    iconColor="blue"
                />
                <x-ui.hero-feature
                    icon="o-clock"
                    title="Log Sessions"
                    description="Record training duration and rate your perceived effort."
                    iconColor="green"
                />
                <x-ui.hero-feature
                    icon="o-folder"
                    title="Organize Skills"
                    description="Categorize your learning by methods and topics."
                    iconColor="purple"
                />
                <x-ui.hero-feature
                    icon="o-trophy"
                    title="Score System"
                    description="Automatic scoring based on effort and duration."
                    iconColor="yellow"
                />
            </div>
        </x-slot:features>
    </x-ui.hero>

    {{-- Features Section --}}
    <section class="py-24 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <x-ui.badge color="primary" size="lg" class="mb-4">Features</x-ui.badge>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Everything you need to track your skills</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Our platform provides comprehensive tools to help you monitor, analyze, and improve your Laravel development skills.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 lg:grid-cols-3">
                <x-ui.card class="text-center hover:shadow-lg transition-shadow">
                    <x-ui.stat-card
                        title="Training Sessions"
                        value="Track"
                        icon="clipboard-document-list"
                        color="blue"
                    />
                    <p class="mt-4 text-gray-600 dark:text-gray-400">
                        Log detailed training sessions with task descriptions, duration, and what you learned.
                    </p>
                </x-ui.card>

                <x-ui.card class="text-center hover:shadow-lg transition-shadow">
                    <x-ui.stat-card
                        title="Performance"
                        value="Analyze"
                        icon="chart-bar"
                        color="green"
                    />
                    <p class="mt-4 text-gray-600 dark:text-gray-400">
                        View statistics, track RPE scores, and monitor your progress over time.
                    </p>
                </x-ui.card>

                <x-ui.card class="text-center hover:shadow-lg transition-shadow">
                    <x-ui.stat-card
                        title="Categories"
                        value="Organize"
                        icon="folder"
                        color="purple"
                    />
                    <p class="mt-4 text-gray-600 dark:text-gray-400">
                        Create custom categories and methods to organize your learning journey.
                    </p>
                </x-ui.card>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <x-ui.badge color="secondary" size="lg" class="mb-4">How It Works</x-ui.badge>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Simple Steps to Track Your Progress</h2>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 dark:text-blue-400 font-bold">1</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Create Categories</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">
                                Set up your learning categories like Frontend, Backend, Database, etc.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                                <span class="text-green-600 dark:text-green-400 font-bold">2</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Methods</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">
                                Define learning methods like Video Tutorials, Documentation, Coding Practice.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                                <span class="text-purple-600 dark:text-purple-400 font-bold">3</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Log Training</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">
                                Record your sessions with duration, effort level (RPE), and notes.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center">
                                <span class="text-yellow-600 dark:text-yellow-400 font-bold">4</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Track Progress</h3>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">
                                View your progress with automated scoring (RPE × 1.5 × Duration).
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="relative py-16 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600"></div>
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white">Ready to improve your Laravel skills?</h2>
            <p class="mt-4 text-xl text-blue-100">
                Start tracking your learning journey today and see your progress grow.
            </p>
            <div class="mt-8">
                @auth
                    <x-button link="{{ url('/trainings') }}" class="btn-white btn-lg">
                        View Your Progress
                    </x-button>
                @else
                    <x-button link="{{ route('register') }}" class="btn-white btn-lg">
                        Get Started Free
                    </x-button>
                @endauth
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel Skill Checker') }}. All rights reserved.</p>
                <div class="mt-4 flex justify-center space-x-6">
                    <a href="{{ route('login') }}" class="hover:text-white">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-white">Register</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hover:text-white">Dashboard</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>
</body>
</html>