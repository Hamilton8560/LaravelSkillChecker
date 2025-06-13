@props([
    'title' => null,
    'footer' => null,
    'shadow' => 'md',
    'padding' => true,
    'border' => true,
    'color' => 'default', // default, primary, secondary, success, warning, error, info, cream
    'variant' => 'solid', // solid, outline, gradient
    'rounded' => 'lg', // none, sm, default, md, lg, xl, 2xl, 3xl, full
])

@php
$colorClasses = [
    'default' => [
        'solid' => 'bg-white dark:bg-gray-800',
        'outline' => 'bg-transparent',
        'gradient' => 'bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900',
        'border' => 'border-gray-200 dark:border-gray-700',
        'header' => 'border-gray-200 dark:border-gray-700',
        'headerText' => 'text-gray-900 dark:text-white',
        'footer' => 'bg-gray-50 dark:bg-gray-900/50 border-gray-200 dark:border-gray-700',
    ],
    'primary' => [
        'solid' => 'bg-blue-50 dark:bg-blue-950',
        'outline' => 'bg-transparent',
        'gradient' => 'bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-950 dark:to-blue-900',
        'border' => 'border-blue-200 dark:border-blue-800',
        'header' => 'border-blue-200 dark:border-blue-800',
        'headerText' => 'text-blue-900 dark:text-blue-100',
        'footer' => 'bg-blue-100 dark:bg-blue-900 border-blue-200 dark:border-blue-800',
    ],
    'secondary' => [
        'solid' => 'bg-gray-50 dark:bg-gray-900',
        'outline' => 'bg-transparent',
        'gradient' => 'bg-gradient-to-br from-gray-100 to-gray-50 dark:from-gray-900 dark:to-gray-800',
        'border' => 'border-gray-300 dark:border-gray-700',
        'header' => 'border-gray-300 dark:border-gray-700',
        'headerText' => 'text-gray-700 dark:text-gray-200',
        'footer' => 'bg-gray-100 dark:bg-gray-800 border-gray-300 dark:border-gray-700',
    ],
    'success' => [
        'solid' => 'bg-green-50 dark:bg-green-950',
        'outline' => 'bg-transparent',
        'gradient' => 'bg-gradient-to-br from-green-50 to-green-100 dark:from-green-950 dark:to-green-900',
        'border' => 'border-green-200 dark:border-green-800',
        'header' => 'border-green-200 dark:border-green-800',
        'headerText' => 'text-green-900 dark:text-green-100',
        'footer' => 'bg-green-100 dark:bg-green-900 border-green-200 dark:border-green-800',
    ],
    'warning' => [
        'solid' => 'bg-yellow-50 dark:bg-yellow-950',
        'outline' => 'bg-transparent',
        'gradient' => 'bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-950 dark:to-yellow-900',
        'border' => 'border-yellow-200 dark:border-yellow-800',
        'header' => 'border-yellow-200 dark:border-yellow-800',
        'headerText' => 'text-yellow-900 dark:text-yellow-100',
        'footer' => 'bg-yellow-100 dark:bg-yellow-900 border-yellow-200 dark:border-yellow-800',
    ],
    'error' => [
        'solid' => 'bg-red-50 dark:bg-red-950',
        'outline' => 'bg-transparent',
        'gradient' => 'bg-gradient-to-br from-red-50 to-red-100 dark:from-red-950 dark:to-red-900',
        'border' => 'border-red-200 dark:border-red-800',
        'header' => 'border-red-200 dark:border-red-800',
        'headerText' => 'text-red-900 dark:text-red-100',
        'footer' => 'bg-red-100 dark:bg-red-900 border-red-200 dark:border-red-800',
    ],
    'info' => [
        'solid' => 'bg-sky-50 dark:bg-sky-950',
        'outline' => 'bg-transparent',
        'gradient' => 'bg-gradient-to-br from-sky-50 to-sky-100 dark:from-sky-950 dark:to-sky-900',
        'border' => 'border-sky-200 dark:border-sky-800',
        'header' => 'border-sky-200 dark:border-sky-800',
        'headerText' => 'text-sky-900 dark:text-sky-100',
        'footer' => 'bg-sky-100 dark:bg-sky-900 border-sky-200 dark:border-sky-800',
    ],
    'cream' => [
        'solid' => 'bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-950 dark:to-amber-950',
        'outline' => 'bg-transparent',
        'gradient' => 'bg-gradient-to-br from-orange-100 via-amber-50 to-yellow-50 dark:from-orange-900 dark:via-amber-950 dark:to-yellow-950',
        'border' => 'border-orange-300 dark:border-orange-700',
        'header' => 'border-orange-200 dark:border-orange-800',
        'headerText' => 'text-orange-900 dark:text-orange-100',
        'footer' => 'bg-gradient-to-r from-orange-100 to-amber-100 dark:from-orange-900 dark:to-amber-900 border-orange-200 dark:border-orange-800',
    ],
];

$shadowClasses = [
    'none' => '',
    'sm' => 'shadow-sm',
    'default' => 'shadow',
    'md' => 'shadow-md',
    'lg' => 'shadow-lg',
    'xl' => 'shadow-xl',
    '2xl' => 'shadow-2xl',
];

$roundedClasses = [
    'none' => 'rounded-none',
    'sm' => 'rounded-sm',
    'default' => 'rounded',
    'md' => 'rounded-md',
    'lg' => 'rounded-lg',
    'xl' => 'rounded-xl',
    '2xl' => 'rounded-2xl',
    '3xl' => 'rounded-3xl',
    'full' => 'rounded-full',
];

$currentColor = $colorClasses[$color] ?? $colorClasses['default'];
$bgClass = $currentColor[$variant] ?? $currentColor['solid'];

$containerClasses = implode(' ', array_filter([
    $bgClass,
    $roundedClasses[$rounded] ?? $roundedClasses['lg'],
    $shadowClasses[$shadow] ?? '',
    $border ? 'border ' . $currentColor['border'] : '',
    'overflow-hidden',
]));
@endphp

<div {{ $attributes->merge(['class' => $containerClasses]) }}>
    @if($title)
        <div class="px-6 py-4 border-b {{ $currentColor['header'] }}">
            <h3 class="text-lg font-semibold {{ $currentColor['headerText'] }}">
                {{ $title }}
            </h3>
        </div>
    @endif

    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-6 py-4 {{ $currentColor['footer'] }} border-t">
            {{ $footer }}
        </div>
    @endif
</div>