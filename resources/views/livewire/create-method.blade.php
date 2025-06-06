{{-- resources/views/livewire/create-method.blade.php --}}
<div class="p-6 max-w-lg mx-auto">
    @if (session('message'))
    <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
        {{ session('message') }}
    </div>
@endif
    <h1 class="text-2xl font-semibold mb-4">New Training Method</h1>

    <x-form wire:submit="submit">
        <x-errors title="Oops!" description="Please fix the errors below." icon="o-face-frown" />

        {{-- Method Name --}}
        <div class="mt-4">
            <x-input
                label="Method Name"
                wire:model="name"
                placeholder="Enter method..."
                icon="o-archive-box"
            />

            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Actions --}}
        <x-slot:actions>
            <x-button
                label="Create Training Method"
                type="submit"
                class="btn-primary"
                spinner="submit"
            />
            <x-button
                label="Cancel"
                link="{{ route('methods.index') }}"
                no-wire-navigate
                class="btn-outline"
            />
        </x-slot:actions>
    </x-form>
</div>
