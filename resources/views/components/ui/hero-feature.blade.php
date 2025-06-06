@props([
    'icon' => null,
    'title' => '',
    'description' => '',
    'iconColor' => 'blue',
])

@php
$iconColors = [
    'blue' => 'text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/30',
    'green' => 'text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900/30',
    'purple' => 'text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-900/30',
    'red' => 'text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900/30',
    'yellow' => 'text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900/30',
    'gray' => 'text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-900/30',
];

$colorClass = $iconColors[$iconColor] ?? $iconColors['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'flex gap-4']) }}>
    @if($icon)
        <div class="flex-shrink-0">
            <div class="w-10 h-10 rounded-lg {{ $colorClass }} flex items-center justify-center">
                @if(str_starts_with($icon, '<svg'))
                    {!! $icon !!}
                @else
                    <x-icon :name="$icon" class="w-6 h-6" />
                @endif
            </div>
        </div>
    @endif
    
    <div>
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">{{ $title }}</h3>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $description }}</p>
    </div>
</div>