<?php

use Livewire\Volt\Component;
use App\Models\Training;

new class extends Component {

    private function getRankForScore(int $score, array $ranks): array
    {
        // Ranks are already sorted by threshold ascending, which is perfect.
        foreach ($ranks as $rank) {
            // If the score is less than or equal to the rank's upper limit, we've found our match.
            if ($score <= $rank['threshold']) {
                return $rank;
            }
        }

        // If the score is higher than all thresholds, it must be the highest rank (Grandmaster).
        return $ranks[count($ranks) - 1];
    }


    public function with(): array
    {

        $ranks = config('training.ranks');



        $trainings = Training::with(['category', 'method'])->get();
        $durationsByCategory = $trainings
            ->groupBy(fn($t) => $t->category->name ?? 'Uncategorized')
            ->map(fn($group) => $group->sum('duration'));




        $scoresByCategory = $trainings
            ->groupBy(fn($t) => $t->category->name ?? 'Uncategorized')
            ->map(fn($group) => $group->sum('score'));

        $statsByCategory = $trainings
            ->groupBy(fn($t) => $t->category->name ?? 'Uncategorized')
            ->map(fn($group) => [
                'duration' => $group->sum('duration'),
                'score' => $group->sum('score'),
                // you can add more per-category stats here if you want
                'avgRPE' => round($group->avg('RPE'), 2),
            ]);

        $rankedStats = $statsByCategory->map(function ($stats) use ($ranks) {
            // Use our helper function to find the correct rank for the category's score
            $rankData = $this->getRankForScore((int) $stats['score'], $ranks);

            // Add the found rank data directly to the stats array
            $stats['rank_name'] = $rankData['name'];
            $stats['rank_description'] = $rankData['description'];

            return $stats;
        });



        return [
            // eager-load category & method
            'durationsByCategory' => $durationsByCategory,
            'training' => $trainings,
            'sumDuration' => Training::sum('duration'),
            'avg_RPE' => round(Training::average('RPE'), 2),
            'avg_duration' => round(Training::average('duration'), 2),
            'scoresByCategory' => $scoresByCategory,
            'scoreCard' => $rankedStats,
            'headers' => ['Category', 'Rank', 'Score', 'Total Duration'],
            'ranks' => $ranks
        ];
    }

    public function rounding($item)
    {
        return round($item, 2);
    }
}; ?>

<div class="p-6">



    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Overall Training Summary</h1>
        <div class="flex flex-col sm:flex-row gap-6 mb-8">
            <x-ui.stat-card class="flex-1 text-center" color="success" title="Total Duration" :value="$sumDuration . ' mins'" />
            <x-ui.stat-card class="flex-1 text-center" color="info" title="Average RPE" :value="$avg_RPE" />
            <x-ui.stat-card class="flex-1 text-center" color="cream" title="Average Duration" :value="$avg_duration . ' mins'" />
        </div>

        {{-- A SINGLE TABLE FOR ALL CATEGORY RANKS --}}
        <h2 class="mt-8 text-lg font-bold">Ranks by Category</h2>
        <x-table.data-table :headers="$headers">
            @forelse ($scoreCard as $category => $stats)
                <x-table.table-row>
                    {{-- Category Name --}}
                    <x-table.table-cell class="font-semibold">{{ $category }}</x-table.table-cell>

                    {{-- Rank Name --}}
                    <x-table.table-cell>
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            {{ $stats['rank_name'] }}
                        </span>
                    </x-table.table-cell>

                    {{-- Score --}}
                    <x-table.table-cell>{{ number_format($stats['score']) }}</x-table.table-cell>

                    {{-- Duration --}}
                    <x-table.table-cell>{{ number_format($stats['duration']) }} mins</x-table.table-cell>
                </x-table.table-row>
            @empty
                <x-table.table-row>
                    <x-table.table-cell colspan="{{ count($headers) }}">
                        No training data found to calculate ranks.
                    </x-table.table-cell>
                </x-table.table-row>
            @endforelse
        </x-table.data-table>


        {{-- RANK MILESTONES TABLE (This part is fine as is) --}}
        <h2 class="mt-8 text-lg font-bold">Rank Milestones</h2>
        <x-table.data-table :headers="['Rank', 'Points Required (Up To)', 'Description']">
            @foreach($ranks as $rank)
                <x-table.table-row>
                    <x-table.table-cell>{{ $rank['name'] }}</x-table.table-cell>
                    <x-table.table-cell>{{ number_format($rank['threshold']) }}</x-table.table-cell>
                    <x-table.table-cell>{{ $rank['description'] }}</x-table.table-cell>
                </x-table.table-row>
            @endforeach
        </x-table.data-table>
    </div>

</div>