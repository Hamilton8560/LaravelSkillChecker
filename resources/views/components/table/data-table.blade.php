@props([
    'headers' => [],
    'striped' => true,
    'hoverable' => true,
    'compact' => false,
    'color' => 'default', // default, primary, secondary, success, warning, error, info, cream
    'bordered' => false,
    'borderless' => false,
    'shadow' => 'default', // none, sm, default, md, lg, xl
    'rounded' => 'lg', // none, sm, default, md, lg, xl, 2xl, 3xl, full
])

@php
$colorClasses = [
    'default' => [
        'container' => 'bg-white dark:bg-gray-800',
        'header' => 'bg-gray-50 dark:bg-gray-700',
        'headerText' => 'text-gray-500 dark:text-gray-300',
        'body' => 'bg-white dark:bg-gray-800',
        'divider' => 'divide-gray-200 dark:divide-gray-700',
        'border' => 'border-gray-200 dark:border-gray-700',
    ],
    'primary' => [
        'container' => 'bg-blue-50 dark:bg-blue-950',
        'header' => 'bg-blue-100 dark:bg-blue-900',
        'headerText' => 'text-blue-700 dark:text-blue-300',
        'body' => 'bg-blue-50 dark:bg-blue-950',
        'divider' => 'divide-blue-200 dark:divide-blue-800',
        'border' => 'border-blue-200 dark:border-blue-800',
    ],
    'secondary' => [
        'container' => 'bg-gray-50 dark:bg-gray-900',
        'header' => 'bg-gray-100 dark:bg-gray-800',
        'headerText' => 'text-gray-600 dark:text-gray-400',
        'body' => 'bg-gray-50 dark:bg-gray-900',
        'divider' => 'divide-gray-300 dark:divide-gray-700',
        'border' => 'border-gray-300 dark:border-gray-700',
    ],
    'success' => [
        'container' => 'bg-green-50 dark:bg-green-950',
        'header' => 'bg-green-100 dark:bg-green-900',
        'headerText' => 'text-green-700 dark:text-green-300',
        'body' => 'bg-green-50 dark:bg-green-950',
        'divider' => 'divide-green-200 dark:divide-green-800',
        'border' => 'border-green-200 dark:border-green-800',
    ],
    'warning' => [
        'container' => 'bg-yellow-50 dark:bg-yellow-950',
        'header' => 'bg-yellow-100 dark:bg-yellow-900',
        'headerText' => 'text-yellow-700 dark:text-yellow-300',
        'body' => 'bg-yellow-50 dark:bg-yellow-950',
        'divider' => 'divide-yellow-200 dark:divide-yellow-800',
        'border' => 'border-yellow-200 dark:border-yellow-800',
    ],
    'error' => [
        'container' => 'bg-red-50 dark:bg-red-950',
        'header' => 'bg-red-100 dark:bg-red-900',
        'headerText' => 'text-red-700 dark:text-red-300',
        'body' => 'bg-red-50 dark:bg-red-950',
        'divider' => 'divide-red-200 dark:divide-red-800',
        'border' => 'border-red-200 dark:border-red-800',
    ],
    'info' => [
        'container' => 'bg-sky-50 dark:bg-sky-950',
        'header' => 'bg-sky-100 dark:bg-sky-900',
        'headerText' => 'text-sky-700 dark:text-sky-300',
        'body' => 'bg-sky-50 dark:bg-sky-950',
        'divider' => 'divide-sky-200 dark:divide-sky-800',
        'border' => 'border-sky-200 dark:border-sky-800',
    ],
    'cream' => [
        'container' => 'bg-orange-50 dark:bg-orange-950',
        'header' => 'bg-gradient-to-r from-orange-100 to-amber-100 dark:from-orange-900 dark:to-amber-900',
        'headerText' => 'text-orange-800 dark:text-orange-200',
        'body' => 'bg-gradient-to-b from-orange-50 to-amber-50 dark:from-orange-950 dark:to-amber-950',
        'divider' => 'divide-orange-200 dark:divide-orange-800',
        'border' => 'border-orange-300 dark:border-orange-700',
    ],
];

$currentColor = $colorClasses[$color] ?? $colorClasses['default'];

$shadowClasses = [
    'none' => '',
    'sm' => 'shadow-sm',
    'default' => 'shadow',
    'md' => 'shadow-md',
    'lg' => 'shadow-lg',
    'xl' => 'shadow-xl',
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

$containerClasses = implode(' ', array_filter([
    $currentColor['container'],
    $roundedClasses[$rounded] ?? $roundedClasses['lg'],
    $shadowClasses[$shadow] ?? $shadowClasses['default'],
    $bordered ? 'border ' . $currentColor['border'] : '',
    'overflow-hidden',
]));
@endphp

<div class="{{ $containerClasses }}">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'w-full']) }}>
            @if(count($headers) > 0)
                <thead class="{{ $currentColor['header'] }}">
                    <tr>
                        @foreach($headers as $header)
                            <th class="px-6 {{ $compact ? 'py-2' : 'py-3' }} text-left text-xs font-medium {{ $currentColor['headerText'] }} uppercase tracking-wider">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            @endif
            
            <tbody class="{{ $currentColor['body'] }} {{ $striped && !$borderless ? 'divide-y ' . $currentColor['divider'] : '' }}">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>