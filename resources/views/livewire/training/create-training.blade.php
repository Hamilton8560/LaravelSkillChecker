{{-- resources/views/livewire/training/create-training.blade.php --}}
<div class="p-6 max-w-lg mx-auto">

    @if (session('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <h1 class="text-2xl font-semibold mb-4">Log New Training</h1>

    {{-- === 1. Show Available Buffs === --}}
    <div class="mb-6">
        <h2 class="font-semibold mb-2">Available Buffs</h2>
        <div class="space-y-2">
            @foreach($buffCatalog as $buff)
                <livewire:activate-buff :buff="$buff" :key="$buff->id" />
            @endforeach
        </div>
    </div>

    {{-- === 2. Show Active Buffs (real-time countdown) === --}}
    @if($activeBuffs->count())
        <div class="mb-6">
            <h2 class="font-semibold mb-2">Active Buffs</h2>
            <div class="space-y-2">
                @foreach($activeBuffs as $userBuff)
                    <div class="flex items-center justify-between bg-gray-100 p-2 rounded">
                        <div class="text-sm">
                            {{ $userBuff->buff->name }}
                            (+{{ $userBuff->buff->multiplier * 100 }}%)
                        </div>
                        <div class="text-xs text-gray-500" wire:poll.60s>
                            ends in {{ $userBuff->ends_at->diffForHumans(null, true) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- === 3. Existing “Log New Training” Form === --}}
    <x-form wire:submit="submit">
        <x-errors title="Oops!" description="Please, fix the errors below." icon="o-face-frown" />

        {{-- Category --}}
        <div class="mb-4">
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
        <div class="mb-4">
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

        {{-- Start Time --}}
        <div class="mb-4">
            <x-input
                label="Start Time"
                type="datetime-local"
                wire:model="started_at"
                id="started_at"
                placeholder="YYYY-MM-DD HH:MM"
            />
            @error('started_at')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- End Time --}}
        <div class="mb-4">
            <x-input
                label="End Time"
                type="datetime-local"
                wire:model="ended_at"
                id="ended_at"
                placeholder="YYYY-MM-DD HH:MM"
            />
            @error('ended_at')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Duration Input with Helper Buttons --}}
        <div class="mb-4">
            <x-input
                label="Duration (minutes)"
                type="number"
                wire:model="duration"
                id="duration"
                placeholder="Enter duration or calculate from times"
                min="1"
            />
            <div class="mt-2 flex gap-2">
                <button 
                    type="button"
                    wire:click="setEndTimeToNow"
                    class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600"
                >
                    Set End Time to Now
                </button>
                <button 
                    type="button"
                    wire:click="clearTimes"
                    class="px-3 py-1 bg-gray-500 text-white text-sm rounded hover:bg-gray-600"
                >
                    Clear Times
                </button>
            </div>
            @error('duration')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- RPE --}}
        <div class="mb-4">
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
        <div class="mb-4">
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

        {{-- Task Description --}}
        <div class="mb-4">
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

        {{-- What You Learned --}}
        <div class="mb-4">
            <x-textarea
                label="What You Learned"
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
