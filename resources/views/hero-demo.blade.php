<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hero Component Demo - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white dark:bg-gray-900">
    {{-- Example 1: Hero with Image on Right --}}
    
    <x-ui.hero
        title="Track Your Learning Journey"
        subtitle="Laravel Skill Checker"
        description="Monitor your coding progress, track training sessions, and improve your development skills with our comprehensive learning platform."
        image="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80"
        imageAlt="Coding workspace"
        imagePosition="right"
        gradient="primary"
        height="screen"
    >
        <x-slot:actions>
            <x-button class="btn-primary btn-lg">
                Get Started
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </x-button>
            <x-button class="btn-ghost btn-lg">
                Learn More
            </x-button>
        </x-slot:actions>

        <x-slot:features>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <x-ui.hero-feature
                    icon="o-chart-bar"
                    title="Track Progress"
                    description="Monitor your learning journey with detailed analytics."
                    iconColor="blue"
                />
                <x-ui.hero-feature
                    icon="o-clock"
                    title="Time Management"
                    description="Log training sessions and track time spent."
                    iconColor="green"
                />
            </div>
        </x-slot:features>
    </x-ui.hero>

    {{-- Example 2: Centered Hero with Background Image --}}
    <x-ui.hero
        title="Build Something Amazing"
        subtitle="Powered by Laravel"
        description="Create beautiful, modern web applications with our powerful component library."
        image="https://images.unsplash.com/photo-1517134191118-9d595e4c8c2b?w=1200&q=80"
        imagePosition="background"
        overlay
        centered
        height="large"
    >
        <x-slot:actions>
            <x-button class="btn-white btn-lg">
                Start Building
            </x-button>
            <x-button class="btn-ghost-white btn-lg">
                View Documentation
            </x-button>
        </x-slot:actions>
    </x-ui.hero>

    {{-- Example 3: Hero with Image on Left --}}
    <x-ui.hero
        title="Elevate Your Skills"
        description="Join thousands of developers who are mastering new technologies and advancing their careers."
        image="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80"
        imagePosition="left"
        gradient="warm"
        height="medium"
    >
        <x-slot:actions>
            <x-button class="btn-primary">Join Now</x-button>
            <x-button class="btn-outline">Watch Demo</x-button>
        </x-slot:actions>
    </x-ui.hero>

    {{-- Example 4: Simple Centered Hero --}}
    <x-ui.hero
        title="Welcome to Your Dashboard"
        description="Everything you need to manage your application in one place."
        centered
        gradient="cool"
        height="medium"
        wave
    >
        <x-slot:actions>
            <x-button class="btn-primary">Get Started</x-button>
        </x-slot:actions>
    </x-ui.hero>

    {{-- Example 5: Hero with Custom Gradient --}}
    <x-ui.hero
        title="Gradient Customization"
        subtitle="Custom Colors"
        description="You can use any Tailwind gradient classes for unique designs."
        gradient="from-pink-500 via-purple-500 to-indigo-500"
        centered
        height="medium"
    >
        <x-slot:actions>
            <x-button class="btn-primary">Explore</x-button>
        </x-slot:actions>
    </x-ui.hero>
</body>
</html>