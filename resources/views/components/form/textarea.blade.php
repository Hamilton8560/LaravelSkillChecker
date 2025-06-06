@props([
    'label' => null,
    'error' => null,
    'hint' => null,
    'required' => false,
    'rows' => 4,
])

<div>
    @if($label)
        <label for="{{ $attributes->get('id') ?? $attributes->get('name') }}" 
               class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <textarea {{ $attributes->merge([
        'rows' => $rows,
        'class' => 
            'block w-full rounded-md shadow-sm ' .
            ($error 
                ? 'border-red-300 dark:border-red-600 text-red-900 dark:text-red-100 placeholder-red-300 dark:placeholder-red-400 focus:ring-red-500 focus:border-red-500' 
                : 'border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500'
            )
    ]) }}>{{ $slot }}</textarea>

    @if($hint && !$error)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $hint }}</p>
    @endif

    @error($attributes->get('name'))
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror

    @if($error)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif
</div>