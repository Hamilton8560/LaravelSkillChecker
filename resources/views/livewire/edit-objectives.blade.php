<div class="p-6 max-w-lg mx-auto">
    @if (session('message'))
        <x-ui.alert type="success" class="mb-4">
            {{ session('message') }}
        </x-ui.alert>
    @endif

    <x-ui.card title="Edit Learning Objective" class="mb-6">
        {{-- Display Category --}}

        <x-form.input
        class="h-12"
        label="Category"
        placeholder="{{$objective->category->name }}"
        />
 
      

        <x-form wire:submit="update">
            {{-- Learning Objective --}}
            <x-form.textarea 
                label="Learning Objective"
                wire:model="objectives"
                required
                placeholder="{{$objective->objectives}}"
                icon="o-academic-cap"
                hint="Update your learning objective if needed"
                rows="4"
                class="mb-4"
            />

            {{-- How You Learned --}}
            <x-form.textarea 
                label="How You Learned"
                wire:model="how_you_learned"
                hint="Describe the methods or resources you used"
                rows="3"
                class="mb-4"
                placeholder="What methods, resources, or approaches did you use?"
            />

            {{-- Explanation --}}
            <x-form.textarea 
                label="Explain What You Learned"
                wire:model="explained"
                hint="Explain in your own words to reinforce your understanding"
                rows="4"
                class="mb-4"
                placeholder="Describe what you learned and how you can apply it..."
            />

            {{-- Submit Button --}}
            <x-slot:actions>
                <x-button
                    label="Update Objective"
                    type="submit"
                    class="btn-primary"
                    spinner="submit"
                />
                <x-button
                    label="Back to List"
                    link="{{ route('objectives.index') }}"
                    class="btn-outline"
                />
            </x-slot:actions>
        </x-form>
    </x-ui.card>
</div>