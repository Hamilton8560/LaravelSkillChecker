@extends('components.layouts.app')

@section('content')
    {{-- Hero Section --}}
    <x-ui.hero
        title="Track Your Learning Journey"
        subtitle="Laravel Skill Checker"
        description="Monitor your coding progress, track training sessions, and improve your development skills with our comprehensive learning platform."
        image="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80"
        imageAlt="Coding workspace"
        imagePosition="right"
        gradient="primary"
        height="auto"
    >
        <x-slot:actions>
            @auth
                <x-button link="{{ route('dashboard') }}" class="btn-primary btn-lg">
                    Go to Dashboard
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </x-button>
            @else
                <x-button link="{{ route('register') }}" class="btn-primary btn-lg">
                    Get Started
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
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <x-ui.hero-feature
                    icon="o-chart-bar"
                    title="Track Progress"
                    description="Monitor your learning journey with detailed analytics and insights."
                    iconColor="blue"
                />
                <x-ui.hero-feature
                    icon="o-clock"
                    title="Time Management"
                    description="Log training sessions and track time spent on different skills."
                    iconColor="green"
                />
                <x-ui.hero-feature
                    icon="o-academic-cap"
                    title="Skill Categories"
                    description="Organize your learning into categories and methods."
                    iconColor="purple"
                />
                <x-ui.hero-feature
                    icon="o-trophy"
                    title="Performance Metrics"
                    description="Track RPE scores and calculate performance metrics."
                    iconColor="yellow"
                />
            </div>
        </x-slot:features>
    </x-ui.hero>

    {{-- Features Section --}}
    <section class="py-24 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Everything you need to track your progress</h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Our platform provides all the tools you need to monitor and improve your coding skills.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <x-ui.card class="text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-4">
                        <x-icon name="o-clipboard-document-list" class="w-8 h-8 text-blue-600 dark:text-blue-400" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Training Logs</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Keep detailed records of your learning sessions with notes and reflections.
                    </p>
                </x-ui.card>

                <x-ui.card class="text-center">
                    <div class="w-16 h-16 mx-auto bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mb-4">
                        <x-icon name="o-chart-bar" class="w-8 h-8 text-green-600 dark:text-green-400" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Analytics Dashboard</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Visualize your progress with comprehensive statistics and charts.
                    </p>
                </x-ui.card>

                <x-ui.card class="text-center">
                    <div class="w-16 h-16 mx-auto bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mb-4">
                        <x-icon name="o-book-open" class="w-8 h-8 text-purple-600 dark:text-purple-400" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Learning Resources</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Organize your learning materials and track what you've learned.
                    </p>
                </x-ui.card>
            </div>
        </div>
    </section>
@endsection