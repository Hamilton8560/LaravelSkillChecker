@props([
    'title' => null,
    'footer' => null,
    'shadow' => 'md',
    'padding' => true,
    'border' => true,
])

<div {{ $attributes->merge(['class' => 
    'bg-white dark:bg-gray-800 rounded-lg ' . 
    ($shadow ? "shadow-{$shadow}" : '') . ' ' .
    ($border ? 'border border-gray-200 dark:border-gray-700' : '') . ' ' .
    'overflow-hidden'
]) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </h3>
        </div>
    @endif

    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
            {{ $footer }}
        </div>
    @endif
</div>