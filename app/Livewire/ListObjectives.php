<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListObjectives extends Component
{
    public function mount()
    {
        //==Question? learn about carbon===
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $hasToday = $user
            ->objectives()
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if (! $hasToday) {
            session()->flash(
                'message',
                'No Objectives have been created for today, create one'
            );
            return redirect()->route('objectives.create');
        }
    }

    public function render()
    {


        /** @var \App\Models\User $user */
        $user = Auth::user();
        // $objectives = DB::table('objectives')->where('user_id', $user)->whereDate('created_at', Carbon::today())->exists();
        $today = $user
            ->objectives()
            ->whereDate('created_at', Carbon::today())
            ->get();
        $all = $user
            ->objectives()
            ->get();
        $headers = [
            'Objectives',
            'Explained',
            'Training Category',
            'Started At',
            'Updated At'
        ];

        return view('livewire.list-objectives', [
            'todays_objectives' => $today,
            'all_objectives' => $all,
            'headers' => $headers,
        ]);
    }
}
