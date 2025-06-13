@props([
    'hoverable' => true,
    'striped' => false,
    'clickable' => false,
    'color' => 'default', // default, primary, secondary, success, warning, error, info, cream
    'selected' => false,
])

@php
$hoverClasses = [
    'default' => 'hover:bg-gray-50 dark:hover:bg-gray-700',
    'primary' => 'hover:bg-blue-100 dark:hover:bg-blue-900',
    'secondary' => 'hover:bg-gray-100 dark:hover:bg-gray-800',
    'success' => 'hover:bg-green-100 dark:hover:bg-green-900',
    'warning' => 'hover:bg-yellow-100 dark:hover:bg-yellow-900',
    'error' => 'hover:bg-red-100 dark:hover:bg-red-900',
    'info' => 'hover:bg-sky-100 dark:hover:bg-sky-900',
    'cream' => 'hover:bg-orange-100 dark:hover:bg-orange-900',
];

$selectedClasses = [
    'default' => 'bg-gray-100 dark:bg-gray-700',
    'primary' => 'bg-blue-100 dark:bg-blue-900',
    'secondary' => 'bg-gray-200 dark:bg-gray-800',
    'success' => 'bg-green-100 dark:bg-green-900',
    'warning' => 'bg-yellow-100 dark:bg-yellow-900',
    'error' => 'bg-red-100 dark:bg-red-900',
    'info' => 'bg-sky-100 dark:bg-sky-900',
    'cream' => 'bg-gradient-to-r from-orange-100 to-amber-100 dark:from-orange-900 dark:to-amber-900',
];

$currentHoverClass = $hoverClasses[$color] ?? $hoverClasses['default'];
$currentSelectedClass = $selectedClasses[$color] ?? $selectedClasses['default'];

$classes = implode(' ', array_filter([
    $selected ? $currentSelectedClass : '',
    $hoverable && !$selected ? $currentHoverClass : '',
    $clickable ? 'cursor-pointer' : '',
    'transition-colors',
]));
@endphp

<tr {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</tr>