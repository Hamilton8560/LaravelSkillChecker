@props([
    'title' => 'Welcome to Your App',
    'subtitle' => null,
    'description' => null,
    'image' => null,
    'imageAlt' => 'Hero image',
    'imagePosition' => 'right', // left, right, background, none
    'overlay' => false, // for background images
    'gradient' => null, // primary, secondary, custom
    'height' => 'auto', // auto, screen, large, medium
    'centered' => false,
])

@php
$heightClasses = [
    'auto' => '',
    'screen' => 'min-h-screen',
    'large' => 'min-h-[600px]',
    'medium' => 'min-h-[400px]',
];

$gradientClasses = [
    'primary' => 'from-blue-600 to-purple-600',
    'secondary' => 'from-green-600 to-blue-600',
    'warm' => 'from-orange-500 to-pink-500',
    'cool' => 'from-cyan-500 to-blue-600',
    'dark' => 'from-gray-700 to-gray-900',
];

$heightClass = $heightClasses[$height] ?? '';
$gradientClass = $gradient ? ($gradientClasses[$gradient] ?? $gradient) : '';
@endphp

<section {{ $attributes->merge(['class' => "relative overflow-hidden bg-white dark:bg-gray-900 {$heightClass}"]) }}>
    {{-- Background Image Overlay --}}
    @if($imagePosition === 'background' && $image)
        <div class="absolute inset-0 z-0">
            <img src="{{ $image }}" alt="{{ $imageAlt }}" class="w-full h-full object-cover">
            @if($overlay)
                <div class="absolute inset-0 bg-gray-900/70 dark:bg-gray-900/80"></div>
            @endif
        </div>
    @endif

    {{-- Gradient Background --}}
    @if($gradient && $imagePosition !== 'background')
        <div class="absolute inset-0 bg-gradient-to-br {{ $gradientClass }} opacity-10 dark:opacity-20"></div>
    @endif

    {{-- Decorative Elements --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-32 w-80 h-80 bg-purple-300 dark:bg-purple-700 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-xl opacity-30 animate-blob"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-blue-300 dark:bg-blue-700 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-300 dark:bg-pink-700 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative z-10 {{ $imagePosition === 'background' ? '' : 'container mx-auto px-4 sm:px-6 lg:px-8' }}">
        <div class="py-24 sm:py-32 lg:py-40">
            @if($imagePosition === 'left' || $imagePosition === 'right')
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-8 items-center">
                    {{-- Content --}}
                    <div class="{{ $imagePosition === 'right' ? 'lg:order-1' : 'lg:order-2' }} {{ $centered ? 'text-center lg:text-left' : '' }}">
                        @if($subtitle)
                            <p class="text-base font-semibold text-blue-600 dark:text-blue-400 mb-2">{{ $subtitle }}</p>
                        @endif
                        
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 dark:text-white {{ $gradient ? 'bg-gradient-to-r ' . $gradientClass . ' bg-clip-text text-transparent' : '' }}">
                            {{ $title }}
                        </h1>
                        
                        @if($description)
                            <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-gray-300 {{ $centered ? 'mx-auto' : '' }} max-w-2xl">
                                {{ $description }}
                            </p>
                        @endif
                        
                        @if(isset($actions))
                            <div class="mt-10 flex items-center {{ $centered ? 'justify-center lg:justify-start' : '' }} gap-4 flex-wrap">
                                {{ $actions }}
                            </div>
                        @endif

                        @if(isset($features))
                            <div class="mt-12">
                                {{ $features }}
                            </div>
                        @endif
                    </div>

                    {{-- Image --}}
                    @if($image)
                        <div class="{{ $imagePosition === 'right' ? 'lg:order-2' : 'lg:order-1' }}">
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-r {{ $gradientClass ?: 'from-blue-500 to-purple-600' }} rounded-2xl transform rotate-3 scale-105 opacity-20 dark:opacity-30"></div>
                                <img src="{{ $image }}" alt="{{ $imageAlt }}" class="relative rounded-2xl shadow-xl w-full">
                            </div>
                        </div>
                    @endif
                </div>
            @else
                {{-- Centered or Background Image Layout --}}
                <div class="{{ $centered || $imagePosition === 'background' ? 'text-center' : '' }} {{ $imagePosition === 'background' ? 'max-w-4xl mx-auto px-4 sm:px-6 lg:px-8' : '' }}">
                    @if($subtitle)
                        <p class="text-base font-semibold {{ $imagePosition === 'background' ? 'text-white' : 'text-blue-600 dark:text-blue-400' }} mb-2">{{ $subtitle }}</p>
                    @endif
                    
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight {{ $imagePosition === 'background' ? 'text-white' : 'text-gray-900 dark:text-white' }} {{ $gradient && $imagePosition !== 'background' ? 'bg-gradient-to-r ' . $gradientClass . ' bg-clip-text text-transparent' : '' }}">
                        {{ $title }}
                    </h1>
                    
                    @if($description)
                        <p class="mt-6 text-lg sm:text-xl {{ $imagePosition === 'background' ? 'text-gray-100' : 'text-gray-600 dark:text-gray-300' }} {{ $centered ? 'mx-auto' : '' }} max-w-3xl">
                            {{ $description }}
                        </p>
                    @endif
                    
                    @if(isset($actions))
                        <div class="mt-10 flex items-center {{ $centered || $imagePosition === 'background' ? 'justify-center' : '' }} gap-4 flex-wrap">
                            {{ $actions }}
                        </div>
                    @endif

                    @if(isset($features))
                        <div class="mt-16">
                            {{ $features }}
                        </div>
                    @endif

                    @if($image && $imagePosition === 'none')
                        <div class="mt-16">
                            <img src="{{ $image }}" alt="{{ $imageAlt }}" class="rounded-2xl shadow-xl w-full max-w-4xl {{ $centered ? 'mx-auto' : '' }}">
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- Bottom Wave (optional) --}}
    @if(isset($wave) && $wave)
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-auto" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" 
                      class="fill-gray-50 dark:fill-gray-800"/>
            </svg>
        </div>
    @endif
</section>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>