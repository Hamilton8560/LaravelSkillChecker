<div class="p-6">
    {{-- Header Section --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Training Sessions</h1>
        <p class="text-gray-600 dark:text-gray-400">Track and manage your training progress</p>
    </div>

    {{-- Flash message --}}
    @if (session()->has('message'))
        <div class="p-4 mb-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    {{-- Actions Bar --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        {{-- Search Input --}}
        <div class="w-full sm:w-96">
            <x-input type="search" wire:model.live.debounce.300ms="search"
                placeholder="Search by category, method, or notes..." icon="o-magnifying-glass" class="w-full" />
        </div>

        {{-- New Training Button --}}
        <x-button label="New Training" tooltip="New Training Session" icon="o-plus"
            link="{{ route('trainings.create') }}" class="btn-primary" />
        {{-- New Training Button --}}
        <x-button label="Category" tooltip="create new category" icon="o-plus" link="{{ route('categories.create') }}"
            class="btn-secondary" />
        <x-button tooltip="create new method" label="Method" icon="o-plus" link="{{ route('methods.create') }}"
            class="btn-tertiary" />
    </div>

    {{-- Stats Cards --}}
    @if($stats && $stats->total_sessions > 0)
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                <div class="text-sm text-blue-600 dark:text-blue-400">Total Sessions</div>
                <div class="text-2xl font-bold">{{ number_format($stats->total_sessions) }}</div>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                <div class="text-sm text-green-600 dark:text-green-400">Total Duration</div>
                <div class="text-2xl font-bold">{{ number_format($stats->total_duration) }} min</div>
            </div>
            <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                <div class="text-sm text-orange-600 dark:text-orange-400">Avg RPE</div>
                <div class="text-2xl font-bold">{{ number_format($stats->avg_rpe, 1) }}</div>
            </div>
            <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                <div class="text-sm text-purple-600 dark:text-purple-400">Avg Score</div>
                <div class="text-2xl font-bold">{{ number_format($stats->avg_score, 1) }}</div>
            </div>
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Date</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Category</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Method</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Duration</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            RPE</th>
                        <th
                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Score</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden lg:table-cell">
                            Task</th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($trainings as $training)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            {{-- Date --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-900 dark:text-gray-100">
                                        {{ $training->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-gray-500 dark:text-gray-400">
                                        {{ $training->created_at->format('g:i A') }}
                                    </div>
                                </div>
                            </td>

                            {{-- Category --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                    {{ $training->category?->name ?? 'N/A' }}
                                </span>
                            </td>

                            {{-- Method --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                    {{ $training->method?->name ?? 'N/A' }}
                                </span>
                            </td>

                            {{-- Duration --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="font-medium">{{ $training->duration }}</span>
                                <span class="text-sm text-gray-500">min</span>
                            </td>

                            {{-- RPE --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($training->RPE >= 8)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
                                        {{ $training->RPE }}/10
                                    </span>
                                @elseif($training->RPE >= 6)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                                        {{ $training->RPE }}/10
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                        {{ $training->RPE }}/10
                                    </span>
                                @endif
                            </td>

                            {{-- Score --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-lg font-bold">{{ number_format($training->score, 1) }}</div>
                            </td>

                            {{-- Task Description --}}
                            <td class="px-6 py-4 hidden lg:table-cell">
                                <p class="text-sm text-gray-600 dark:text-gray-400 truncate max-w-xs">
                                    {{ $training->task_description }}
                                </p>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <x-button label="Edit" link="{{ route('trainings.edit', $training->id) }}"
                                    class="btn-sm btn-outline" />

                                <x-button label="Delete" wire:click="confirmDelete({{ $training->id }})"
                                    class="btn-sm btn-danger ml-2" />
                            </td>
                        </tr>

                        {{-- Confirm delete --}}
                        @if ($confirmingDeleteId === $training->id)
                            <tr class="bg-red-50 dark:bg-red-900/20">
                                <td colspan="8" class="px-6 py-4 text-red-700 dark:text-red-300">
                                    Are you sure you want to delete this training session?
                                    <x-button label="Yes, Delete" wire:click="deleteTraining({{ $training->id }})"
                                        class="btn-sm btn-danger ml-4" />
                                    <x-button label="Cancel" wire:click="$set('confirmingDeleteId', null)"
                                        class="btn-sm btn-outline ml-2" />
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="text-gray-500 dark:text-gray-400">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No training
                                        sessions</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                        @if($search)
                                            No results match your search criteria.
                                        @else
                                            Get started by logging your first training session.
                                        @endif
                                    </p>
                                    @if(!$search)
                                        <div class="mt-6">
                                            <x-button label="Log Training" icon="o-plus" link="{{ route('trainings.create') }}"
                                                class="btn-primary" />
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($trainings->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $trainings->links() }}
            </div>
        @endif
    </div>
</div>