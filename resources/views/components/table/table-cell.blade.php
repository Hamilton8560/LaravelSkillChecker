@props([
    'align' => 'left',
    'compact' => false,
    'nowrap' => true,
])

@php
$alignmentClasses = [
    'left' => 'text-left',
    'center' => 'text-center',
    'right' => 'text-right',
];

$alignClass = $alignmentClasses[$align] ?? $alignmentClasses['left'];
@endphp

<td {{ $attributes->merge([
    'class' => 
        'px-6 ' . 
        ($compact ? 'py-2' : 'py-4') . ' ' .
        ($nowrap ? 'whitespace-nowrap' : '') . ' ' .
        $alignClass . ' ' .
        'text-sm text-gray-900 dark:text-gray-100'
]) }}>
    {{ $slot }}
</td>