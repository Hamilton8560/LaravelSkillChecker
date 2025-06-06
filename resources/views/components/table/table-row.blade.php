@props([
    'hoverable' => true,
    'striped' => false,
    'clickable' => false,
])

<tr {{ $attributes->merge([
    'class' => 
        ($hoverable ? 'hover:bg-gray-50 dark:hover:bg-gray-700 ' : '') .
        ($clickable ? 'cursor-pointer ' : '') .
        'transition-colors'
]) }}>
    {{ $slot }}
</tr>