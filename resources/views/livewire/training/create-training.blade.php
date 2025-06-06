{{-- resources/views/livewire/create-training.blade.php --}}
<div class="p-6 max-w-lg mx-auto">
    @if (session('message'))
    <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
        {{ session('message') }}
    </div>
@endif
    <h1 class="text-2xl font-semibold mb-4">Log New Training</h1>

    {{-- Display full error bag if needed --}}
    <x-form wire:submit="submit">
        {{-- Show overall validation errors above individual fields --}}
        <x-errors title="Oops!" description="Please, fix the errors below." icon="o-face-frown" /> 

        {{-- Category --}}
        <div>
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
        <div>
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
        <div>
            <x-input
                label="Duration (minutes)"
                wire:model="duration"
                type="number"
                min="1"
                placeholder="Enter duration in minutes"
            /> 

            @error('duration')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- RPE --}}
        <div>
            <x-input
                label="RPE (1–10)"
                wire:model="RPE"
                type="number"
                min="1"
                max="10"
                placeholder="Rate perceived exertion"
            /> 

            @error('RPE')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Notes --}}
        <div>
            <x-textarea
                label="Notes"
                wire:model="notes"
                rows="3"
                placeholder="Any additional notes..."
            /> 

            @error('notes')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- task_description --}}
        <div>
            <x-textarea
                label="Task Description"
                wire:model="task_description"
                rows="3"
                placeholder="What exactly did you do..."
            /> 

            @error('task_description')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

         {{-- what_you_learned--}}
        <div>
            <x-textarea
                label="What did you learn"
                wire:model="what_you_learned"
                rows="3"
                placeholder="Give a list of 3 things you learned..."
            /> 

            @error('what_you_learned')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        

        {{-- Action Buttons --}}
        <x-slot:actions>
            <x-button
                label="Save Training"
                class="btn-primary"
                type="submit"
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
