@props([
    'icon' => 'o-inbox',
    'title' => 'No data found',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'text-center py-12']) }}>
    <div class="text-gray-400 dark:text-gray-600">
        @if($icon)
            @if(str_starts_with($icon, '<svg'))
                {!! $icon !!}
            @else
                <x-icon :name="$icon" class="mx-auto h-12 w-12" />
            @endif
        @endif
        
        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">
            {{ $title }}
        </h3>
        
        @if($description)
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                {{ $description }}
            </p>
        @endif
        
        @if(isset($actions))
            <div class="mt-6">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>