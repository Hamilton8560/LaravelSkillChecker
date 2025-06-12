<?php

use Livewire\Volt\Component;
use App\Models\Training;

new class extends Component {
    public function with(): array
    {
        $trainings = Training::with('category')->get();
        $durationsByCategory = $trainings
            ->groupBy(fn($t) => $t->category->name ?? 'Uncategorized')
            ->map(fn($group) => $group->sum('duration'));
        return [
            // eager-load category & method
            'durationsByCategory' => $durationsByCategory,
            'training' => Training::with(['category', 'method'])->get(),
            'sumDuration' => Training::sum('duration'),
            'avg_RPE' => Training::average('RPE'),
            'avg_duration' => round(Training::average('duration'), 2),
        ];
    }

    public function rounding($item)
    {
        return round($item, 2);
    }
}; ?>

<div class="p-6">
    <h1 class="text-xl font-bold mb-4">My Trainings</h1>
    <div class="flex-col sm:flex-row flex gap-6">
        <x-ui.stat-card class=" px-12  sm:w-36 text-center" color="black" title="Total Duration" :value=$sumDuration>
        </x-ui.stat-card>
        <x-ui.stat-card class="px-12 sm:w-36 text-center" color="black" title="Average RPE" :value=$avg_RPE>
        </x-ui.stat-card>
        <x-ui.stat-card class="pr-12 sm:w-36 text-center" color="black" title="Average Duration" :value=$avg_duration>
        </x-ui.stat-card>
    </div>
    @foreach ($durationsByCategory as $category => $total)
        <li>
            <strong>{{$category}}</strong>
            {{ number_format($total, 2) }} mins
        </li>
    @endforeach
    {{-- <ul class="space-y-2">


        @foreach ($training as $item)

        <li>
            <strong>Category:</strong>
            {{ $item->category->name }}<br>
            <strong>Method:</strong>
            {{ $item->method->name }}<br>
            <strong>Duration:</strong>
            {{ $item->duration }} mins
        </li>
        @endforeach
    </ul> --}}
</div>