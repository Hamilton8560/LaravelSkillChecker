<x-layouts.app :title="__('Write')">
    <div class="w-96 sm:w-136 mx-auto">
        <x-form method="POST" action="{{ route('journal.store') }}">
            @csrf
            <x-input label="Title" name="title" placeholder="Journal Entry Title" icon="o-bolt"
                hint="You can wait until after writing" />
            <x-textarea label="Journal" name="content" placeholder="Give me your thoughts..." rows="15" inline
                hint="Just say what's on your mind" />


            <x-slot:actions>
                <a href="{{ route('journal.index') }}">
                    <x-button label="Cancel" type="button" />
                </a>
                <x-button label="Save" class="btn-primary" type="submit" />
            </x-slot:actions>
        </x-form>

    </div>

</x-layouts.app>