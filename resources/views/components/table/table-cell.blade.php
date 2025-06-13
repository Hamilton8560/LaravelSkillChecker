@props([
    'align' => 'left',
    'compact' => false,
    'nowrap' => true,
    'color' => 'default', // default, primary, secondary, success, warning, error, info, cream, muted
    'weight' => 'normal', // normal, medium, semibold, bold
    'size' => 'sm', // xs, sm, base, lg
])

@php
$alignmentClasses = [
    'left' => 'text-left',
    'center' => 'text-center',
    'right' => 'text-right',
];

$colorClasses = [
    'default' => 'text-gray-900 dark:text-gray-100',
    'primary' => 'text-blue-700 dark:text-blue-300',
    'secondary' => 'text-gray-600 dark:text-gray-400',
    'success' => 'text-green-700 dark:text-green-300',
    'warning' => 'text-yellow-700 dark:text-yellow-300',
    'error' => 'text-red-700 dark:text-red-300',
    'info' => 'text-sky-700 dark:text-sky-300',
    'cream' => 'text-orange-800 dark:text-orange-200',
    'muted' => 'text-gray-500 dark:text-gray-400',
];

$weightClasses = [
    'normal' => 'font-normal',
    'medium' => 'font-medium',
    'semibold' => 'font-semibold',
    'bold' => 'font-bold',
];

$sizeClasses = [
    'xs' => 'text-xs',
    'sm' => 'text-sm',
    'base' => 'text-base',
    'lg' => 'text-lg',
];

$alignClass = $alignmentClasses[$align] ?? $alignmentClasses['left'];
$colorClass = $colorClasses[$color] ?? $colorClasses['default'];
$weightClass = $weightClasses[$weight] ?? $weightClasses['normal'];
$sizeClass = $sizeClasses[$size] ?? $sizeClasses['sm'];

$classes = implode(' ', array_filter([
    'px-6',
    $compact ? 'py-2' : 'py-4',
    $nowrap ? 'whitespace-nowrap' : '',
    $alignClass,
    $colorClass,
    $weightClass,
    $sizeClass,
]));
@endphp

<td {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</td>