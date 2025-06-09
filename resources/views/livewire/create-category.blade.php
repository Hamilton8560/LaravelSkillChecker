{{-- resources/views/livewire/create-category.blade.php --}}
<div class="p-6 max-w-lg mx-auto">
    @if (session('message'))
    <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
        {{ session('message') }}
    </div>
@endif
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

         {{-- Type Select --}}
        <div class="mt-4">
            <x-select
                label="Type"
                wire:model="type"
                :options="[
                    ['value' => 'cognitive', 'label' => 'Cognitive'],
                    ['value' => 'physical', 'label' => 'Physical']
                ]"
                option-value="value"
                option-label="label"
                placeholder="Select type"
                icon="o-tag"
            />

            @error('type')
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
