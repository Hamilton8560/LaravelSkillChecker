<div class="flex items-center space-x-2">
    <button
        wire:click="activate"
        class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm"
    >
        Activate {{ $buff->name }}
    </button>
    <span class="text-sm text-gray-600">
        (+{{ $buff->multiplier * 100 }}%, {{ $buff->duration }} min)
    </span>

    @error('buff')
        <div class="text-red-600 text-xs ml-2">{{ $message }}</div>
    @enderror
</div>
