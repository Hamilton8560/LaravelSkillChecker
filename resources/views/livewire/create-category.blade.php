{{-- resources/views/livewire/create-category.blade.php --}}
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-semibold mb-4">New Training Category</h1>

    <x-form wire:submit="submit">
        <x-errors title="Oops!" description="Please fix the errors below." icon="o-face-frown" />

        {{-- Category Name --}}
        <div class="mt-4">
            <x-input
                label="Category Name"
                wire:model="name"
                placeholder="Enter category..."
                icon="o-archive-box"
            />

            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Actions --}}
        <x-slot:actions>
            <x-button
                label="Create Category"
                type="submit"
                class="btn-primary"
                spinner="submit"
            />
            <x-button
                label="Cancel"
                link="{{ route('categories.index') }}"
                no-wire-navigate
                class="btn-outline"
            />
        </x-slot:actions>
    </x-form>
</div>
