@props([
    'color' => 'primary',
    'size' => 'md',
    'rounded' => 'full',
    'icon' => null,
])

@php
$colorClasses = [
    'primary' => 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100',
    'secondary' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100',
    'success' => 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100',
    'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100',
    'error' => 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100',
    'info' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100',
];

$sizeClasses = [
    'sm' => 'px-2 py-0.5 text-xs',
    'md' => 'px-2.5 py-0.5 text-sm',
    'lg' => 'px-3 py-1 text-base',
];

$roundedClasses = [
    'full' => 'rounded-full',
    'md' => 'rounded-md',
    'lg' => 'rounded-lg',
    'none' => 'rounded-none',
];

$bgColor = $colorClasses[$color] ?? $colorClasses['primary'];
$sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
$roundedClass = $roundedClasses[$rounded] ?? $roundedClasses['full'];
@endphp

<span {{ $attributes->merge([
    'class' => "inline-flex items-center font-semibold $bgColor $sizeClass $roundedClass"
]) }}>
    @if($icon)
        <x-icon :name="$icon" class="{{ $size === 'sm' ? 'w-3 h-3' : ($size === 'lg' ? 'w-5 h-5' : 'w-4 h-4') }} mr-1" />
    @endif
    
    {{ $slot }}
</span>