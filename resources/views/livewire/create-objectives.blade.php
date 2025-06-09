<div class="p-6 max-w-lg mx-auto">
    @if (session('message'))
        <x-ui.alert type="success" class="mb-4">
            {{ session('message') }}
        </x-ui.alert>
    @endif

    <x-ui.card title="Create Learning Objective" class="mb-6">
        <x-form wire:submit="submit">
            {{-- Category Selection --}}
            <x-form.select 
                label="Category"
                wire:model="category_id"
                required
                :options="$categories->pluck('name', 'id')->prepend('Select a category', '')"
                class="mb-4"
            />

            {{-- Learning Objective --}}
            <x-form.textarea 
                label="Learning Objective"
                wire:model="objectives"
                required
                icon="o-academic-cap"
                hint="What do you want to learn? Be specific. Rule of thumb: practice 5 hours for every 1 hour of theory."
                rows="4"
                class="mb-4"
                placeholder="Example: Learn how to implement authentication in Laravel using Sanctum"
            />

            {{-- Submit Button --}}
            <x-slot:actions>
                <x-button
                    label="Create Objective"
                    type="submit"
                    class="btn-primary"
                    spinner="submit"
                />
            </x-slot:actions>
        </x-form>
    </x-ui.card>
</div>