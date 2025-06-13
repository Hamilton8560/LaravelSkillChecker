{{-- 
    Button Group Component
    
    The color prop can be used to pass a consistent color theme to child buttons.
    Child buttons can access this via parent's data attributes.
    
    Available colors: default, primary, secondary, success, warning, error, info, cream
--}}
@props([
    'vertical' => false,
    'size' => 'md',
    'color' => null,
])

<div {{ $attributes->merge([
    'class' => 
        'inline-flex ' . 
        ($vertical ? 'flex-col' : 'flex-row') . ' ' .
        ($vertical ? '' : '-space-x-px') . ' ' .
        'rounded-md shadow-sm'
]) }}
    data-button-group-color="{{ $color }}"
    data-button-group-size="{{ $size }}"
    >
    {{ $slot }}
</div>

<style>
/* Ensure proper border radius for button groups */
.inline-flex:not(.flex-col) > *:first-child {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.inline-flex:not(.flex-col) > *:last-child {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.inline-flex:not(.flex-col) > *:not(:first-child):not(:last-child) {
    border-radius: 0;
}

/* Vertical button groups */
.inline-flex.flex-col > *:first-child {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.inline-flex.flex-col > *:last-child {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    margin-top: -1px;
}

.inline-flex.flex-col > *:not(:first-child):not(:last-child) {
    border-radius: 0;
    margin-top: -1px;
}
</style>