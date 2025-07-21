<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        
        <!-- Welcome Section -->
        <div class="mb-2">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Training Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400">Track your progress and performance</p>
        </div>

        <!-- Key Metrics Cards -->
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Trainings Card -->
            <x-card class="relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Trainings</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalStats['total_trainings'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                            {{ $totalStats['this_week'] }} this week
                        </p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                        <x-icon name="o-chart-bar" class="w-8 h-8 text-blue-600 dark:text-blue-400" />
                    </div>
                </div>
            </x-card>

            <!-- Total Hours Card -->
            <x-card class="relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Hours</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalStats['total_hours'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                            {{ $totalStats['this_month'] }} sessions this month
                        </p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                        <x-icon name="o-clock" class="w-8 h-8 text-green-600 dark:text-green-400" />
                    </div>
                </div>
            </x-card>

            <!-- Average RPE Card -->
            <x-card class="relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Average RPE</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalStats['avg_rpe'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                            Rate of Perceived Exertion
                        </p>
                    </div>
                    <div class="p-3 bg-orange-100 dark:bg-orange-900 rounded-full">
                        <x-icon name="o-fire" class="w-8 h-8 text-orange-600 dark:text-orange-400" />
                    </div>
                </div>
            </x-card>

            <!-- Total Score Card -->
            <x-card class="relative overflow-hidden">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Score</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalStats['total_score']) }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                            Points earned
                        </p>
                    </div>
                    <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-full">
                        <x-icon name="o-trophy" class="w-8 h-8 text-purple-600 dark:text-purple-400" />
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Category Breakdown -->
        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Categories Performance -->
            <div class="lg:col-span-2">
                <x-card class="h-full">
                    <x-slot:title>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Training by Category</h3>
                            <x-icon name="o-academic-cap" class="w-5 h-5 text-gray-400" />
                        </div>
                    </x-slot:title>

                    <div class="space-y-4">
                        @forelse($totalsByCategory as $category)
                            <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-medium text-gray-900 dark:text-white">{{ $category['name'] }}</h4>
                                    <span class="text-sm text-gray-500">{{ $category['count'] }} sessions</span>
                                </div>
                                
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Total Time</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ round($category['total_duration'] /60, 2) }} hours</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Avg Duration</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $category['avg_duration'] }} min</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Avg RPE</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $category['RPE'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400">Total Score</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ number_format($category['total_score']) }}</p>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                @php
                                    $percentage = $totalStats['total_trainings'] > 0 ? round(($category['count'] / $totalStats['total_trainings']) * 100) : 0;
                                @endphp
                                <div class="mt-3">
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $percentage }}% of total trainings</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center py-8">No training data available yet.</p>
                        @endforelse
                    </div>
                </x-card>
            </div>

            <!-- Recent Trainings -->
            <div>
                <x-card class="h-full">
                    <x-slot:title>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Trainings</h3>
                            <x-icon name="o-clock" class="w-5 h-5 text-gray-400" />
                        </div>
                    </x-slot:title>

                    <div class="space-y-3">
                        @forelse($recentTrainings as $training)
                            <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <x-icon name="o-academic-cap" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $training->category->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $training->method->name ?? 'N/A' }} • {{ $training->duration }} min
                                    </p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                        {{ $training->started_at ? $training->started_at->diffForHumans() : 'No date' }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0 text-right">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">RPE</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $training->RPE }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center py-8">No recent trainings.</p>
                        @endforelse
                    </div>

                    @if($recentTrainings->count() > 0)
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('trainings.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                                View all trainings
                                <x-icon name="o-arrow-right" class="w-4 h-4 ml-1" />
                            </a>
                        </div>
                    @endif
                </x-card>
            </div>
        </div>
    </div>
</x-layouts.app>