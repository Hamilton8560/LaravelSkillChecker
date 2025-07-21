<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
//   protected $fillable = [
//         'user_id',
//         'training_category_id',
//         'training_method_id',
//         'duration',
//         'RPE',
//         'notes',
//         'score',
//         'task_description',
//         'what_you_learned',
//         'started_at',
//         'ended_at',
//     ];

    public function __invoke(Request $request)
    {

        $trainings = Training::where('user_id', Auth::user()->id)
            ->with(['category', 'method'])
            ->orderBy('started_at', 'desc')
            ->get();

        $totalsByCategory = $trainings->groupBy(fn($training) => $training->category->name)
            ->map(function ($group) {
                return [
                    'name' => $group->first()->category->name,
                    'count' => $group->count(),
                    'total_duration' => $group->sum('duration'),
                    'avg_duration' => round($group->avg('duration'), 1),
                    'RPE' => round($group->avg('RPE'), 1),
                    'total_score' => $group->sum('score'),
                    'avg_score' => round($group->avg('score'), 1),
                ];
            })
            ->sortByDesc('total_duration');

        // Calculate overall statistics
        $totalStats = [
            'total_trainings' => $trainings->count(),
            'total_hours' => round($trainings->sum('duration') / 60, 1),
            'avg_rpe' => round($trainings->avg('RPE'), 1),
            'total_score' => $trainings->sum('score'),
            'this_week' => $trainings->filter(fn($t) => $t->started_at && $t->started_at >= now()->startOfWeek())->count(),
            'this_month' => $trainings->filter(fn($t) => $t->started_at && $t->started_at >= now()->startOfMonth())->count(),
        ];

        // Get recent trainings
        $recentTrainings = $trainings->take(5);

        return view('dashboard', [
            'trainings' => $trainings,
            'totalsByCategory' => $totalsByCategory,
            'totalStats' => $totalStats,
            'recentTrainings' => $recentTrainings,
        ]);
    }
}
