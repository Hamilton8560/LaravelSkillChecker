{{-- resources/views/livewire/edit-training.blade.php --}}
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Edit Training</h1>

    {{-- Wrap in the same x-form you used for create --}}
    <x-form wire:submit="submit">
        {{-- Show overall validation errors --}}
        <x-errors title="Oops!" description="Please, fix the errors below." icon="o-face-frown" />

        {{-- Category --}}
        <div class="mt-4">
            <x-select
                label="Category"
                wire:model="category_id"
                :options="$categories"
                placeholder="Select Category"
                icon="o-archive-box"
            />

            @error('category_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Method --}}
        <div class="mt-4">
            <x-select
                label="Method"
                wire:model="method_id"
                :options="$methods"
                placeholder="Select Method"
                icon="o-cog"
            />

            @error('method_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Duration --}}
        <div class="mt-4">
            <x-input
                label="Duration (minutes)"
                wire:model="duration"
                type="number"
                min="1"
                placeholder="Enter duration"
                icon="o-clock"
            />

            @error('duration')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- RPE --}}
        <div class="mt-4">
            <x-input
                label="RPE (1–10)"
                wire:model="RPE"
                type="number"
                min="1"
                max="10"
                placeholder="Rate perceived exertion"
                icon="lucide.activity"
            />

            @error('RPE')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Notes --}}
        <div class="mt-4">
            <x-textarea
                label="Notes"
                wire:model="notes"
                rows="3"
                placeholder="Any additional notes..."
                icon="o-chat-bubble"
            />

            @error('notes')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Action Buttons --}}
        <x-slot:actions>
            <x-button
                label="Save Changes"
                type="submit"
                class="btn-primary"
                spinner="submit"
            />

            <x-button
                label="Cancel"
                link="{{ route('trainings.index') }}"
                no-wire-navigate
                class="btn-outline"
            />
        </x-slot:actions>
    </x-form>
</div>
