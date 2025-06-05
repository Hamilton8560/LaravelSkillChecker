{{-- resources/views/livewire/list-categories.blade.php --}}
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">My Categories</h1>

    {{-- Flash message --}}
    @if (session()->has('message'))
        <div class="p-2 mb-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    {{-- “+ New Category” --}}
    <div class="mb-4">
        <x-button
            label="+ New Category"
            link="{{ route('categories.create') }}"
            class="btn-primary"
        />
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full table-auto border  border-gray-200">
            <thead class="bg-slate-700">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $cat)
                    <tr class="border-b hover:bg-black">
                        <td class="px-4 py-2">{{ $cat->name }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <x-button
                                label="Edit"
                                link="{{ route('categories.edit', $cat->id) }}"
                                class="btn-sm btn-outline"
                            />

                            <x-button
                                label="Delete"
                                wire:click="confirmDelete({{ $cat->id }})"
                                class="btn-sm btn-danger"
                            />
                        </td>
                    </tr>

                    {{-- Confirm delete --}}
                    @if ($confirmingDeleteId === $cat->id)
                        <tr class="bg-red-50">
                            <td colspan="2" class="px-4 py-2 text-red-700">
                                Are you sure?
                                <x-button
                                    label="Yes, Delete"
                                    wire:click="deleteCategory({{ $cat->id }})"
                                    class="btn-sm btn-danger"
                                />
                                <x-button
                                    label="Cancel"
                                    wire:click="$set('confirmingDeleteId', null)"
                                    class="btn-sm btn-outline"
                                />
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-center text-gray-500">
                            No categories yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
