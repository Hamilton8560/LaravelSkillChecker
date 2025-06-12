@props([
    'title' => '',
    'value' => '',
    'icon' => null,
    'color' => 'blue',
    'trend' => null,
    'trendValue' => null,
])

@php
$colorClasses = [
    'blue' => 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400',
    'green' => 'bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400',
    'orange' => 'bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400',
    'purple' => 'bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400',
    'red' => 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400',
    'yellow' => 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400',
    'black' => 'bg-white dark:text-white text-black dark:bg-slate-950'
];

$bgColor = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div {{ $attributes->merge(['class' => "$bgColor p-6 rounded-lg"]) }}>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium opacity-75">{{ $title }}</p>
            <p class="text-3xl font-bold mt-1">{{ $value }}</p>
            
            @if($trend)
                <div class="flex items-center mt-2 text-sm">
                    @if($trend === 'up')
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    @else
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                        </svg>
                    @endif
                    
                    @if($trendValue)
                        <span class="font-medium">{{ $trendValue }}</span>
                    @endif
                </div>
            @endif
        </div>
        
        @if($icon)
            <div class="opacity-50">
                @if(str_starts_with($icon, 'o-'))
                    <x-icon :name="$icon" class="w-8 h-8" />
                @else
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @switch($icon)
                            @case('chart-bar')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                @break
                            @case('clock')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @break
                            @case('fire')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path>
                                @break
                            @case('trophy')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                @break
                            @case('users')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                @break
                            @default
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        @endswitch
                    </svg>
                @endif
            </div>
        @endif
    </div>
</div>