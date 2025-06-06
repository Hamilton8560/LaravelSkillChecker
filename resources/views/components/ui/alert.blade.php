@props([
    'type' => 'info',
    'dismissible' => false,
    'icon' => true,
])

@php
$typeStyles = [
    'success' => [
        'bg' => 'bg-green-50 dark:bg-green-900/20',
        'border' => 'border-green-400 dark:border-green-600',
        'text' => 'text-green-800 dark:text-green-200',
        'icon' => 'o-check-circle',
    ],
    'error' => [
        'bg' => 'bg-red-50 dark:bg-red-900/20',
        'border' => 'border-red-400 dark:border-red-600',
        'text' => 'text-red-800 dark:text-red-200',
        'icon' => 'o-x-circle',
    ],
    'warning' => [
        'bg' => 'bg-yellow-50 dark:bg-yellow-900/20',
        'border' => 'border-yellow-400 dark:border-yellow-600',
        'text' => 'text-yellow-800 dark:text-yellow-200',
        'icon' => 'o-exclamation-triangle',
    ],
    'info' => [
        'bg' => 'bg-blue-50 dark:bg-blue-900/20',
        'border' => 'border-blue-400 dark:border-blue-600',
        'text' => 'text-blue-800 dark:text-blue-200',
        'icon' => 'o-information-circle',
    ],
];

$styles = $typeStyles[$type] ?? $typeStyles['info'];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition
     {{ $attributes->merge(['class' => "rounded-md p-4 border {$styles['bg']} {$styles['border']} {$styles['text']}"]) }}>
    <div class="flex">
        @if($icon)
            <div class="flex-shrink-0">
                <x-icon :name="$styles['icon']" class="h-5 w-5" />
            </div>
        @endif
        
        <div class="{{ $icon ? 'ml-3' : '' }} flex-1">
            <div class="text-sm font-medium">
                {{ $slot }}
            </div>
        </div>
        
        @if($dismissible)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="show = false" 
                            type="button" 
                            class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 hover:bg-opacity-20 hover:bg-gray-600">
                        <span class="sr-only">Dismiss</span>
                        <x-icon name="o-x-mark" class="h-5 w-5" />
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>