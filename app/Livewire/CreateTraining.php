<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class CreateTraining extends Component
{
    public $category_id;
    public $method_id;
    public $duration;
    public $RPE;
    public $notes;
    public $task_description;
    public $what_you_learned;
    //added last
    public $started_at;
    public $ended_at;

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:training_categories,id,user_id,' . Auth::id(),
            'method_id' => 'required|exists:training_methods,id,user_id,' . Auth::id(),
            'started_at' => 'required|date',
            'ended_at' => 'required|date|after:started_at',
            'duration' => 'required|integer|min:1',
            'RPE' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string',
            'task_description' => 'nullable|string',
            'what_you_learned' => 'nullable|string',

        ];
    }

    public function updatedStartedAt($value)
    {
        $this->calculateDuration();
    }

    public function updatedEndedAt($value)
    {
        $this->calculateDuration();
    }

    public function updatedDuration($value)
    {
        $this->calculateTimesFromDuration();
    }

    private function calculateDuration()
    {
        if ($this->started_at && $this->ended_at) {
            try {
                $start = Carbon::parse($this->started_at);
                $end = Carbon::parse($this->ended_at);

                // Ensure end time is after start time
                if ($end->greaterThan($start)) {
                    $this->duration = $start->diffInMinutes($end);
                } else {
                    $this->duration = null;
                }
            } catch (\Exception $e) {
                $this->duration = null;
            }
        } else {
            $this->duration = null;
        }
    }

    private function calculateTimesFromDuration()
    {
        if ($this->duration && is_numeric($this->duration) && $this->duration > 0) {
            try {
                $userTimezone = Auth::user()->timezone ?? config('app.timezone');

                // Set end time to now in user's timezone
                $this->ended_at = Carbon::now($userTimezone)->format('Y-m-d\TH:i');

                // Calculate start time by subtracting duration from end time
                $this->started_at = Carbon::now($userTimezone)
                    ->subMinutes($this->duration)
                    ->format('Y-m-d\TH:i');
            } catch (\Exception $e) {
                // If there's an error, don't update the times
            }
        }
    }

    public function setEndTimeToNow()
    {
        $userTimezone = Auth::user()->timezone ?? config('app.timezone');
        $this->ended_at = Carbon::now($userTimezone)->format('Y-m-d\TH:i');
        if ($this->started_at) {
            $this->calculateDuration();
        }
    }

    public function clearTimes()
    {
        $this->started_at = null;
        $this->ended_at = null;
        $this->duration = null;
    }

    public function updateUserTimezone($timezone)
    {
        if (Auth::check() && in_array($timezone, timezone_identifiers_list())) {
            $user = User::find(Auth::id());
            if ($user) {
                $user->update(['timezone' => $timezone]);
            }
        }
    }

    public function submit()
    {
        $this->validate();

        $userTimezone = Auth::user()->timezone ?? config('app.timezone');

        // Convert user's local times to UTC for storage
        $startedAtUtc = $this->started_at ?
            Carbon::createFromFormat('Y-m-d\TH:i', $this->started_at, $userTimezone)->utc() : null;
        $endedAtUtc = $this->ended_at ?
            Carbon::createFromFormat('Y-m-d\TH:i', $this->ended_at, $userTimezone)->utc() : null;

        Training::create([
            'user_id' => Auth::id(),
            'training_category_id' => $this->category_id,
            'training_method_id' => $this->method_id,
            'started_at' => $startedAtUtc,
            'ended_at' => $endedAtUtc,
            'duration' => $this->duration,
            'RPE' => $this->RPE,
            'notes' => $this->notes,
            'task_description' => $this->task_description,
            'what_you_learned' => $this->what_you_learned,
        ]);

        session()->flash('message', 'Training logged successfully.');
        $this->reset(['category_id', 'method_id', 'started_at', 'ended_at', 'duration', 'RPE', 'notes', 'task_description', 'what_you_learned']);

        // Redirect to the trainings list after successful submission
        $this->redirect(route('trainings.index'));
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();

        //===Question?===
        return view('livewire.training.create-training', [
            'categories' => $user->trainingCategories()->orderBy('name')->get(),
            'methods'    => $user->trainingMethods()->orderBy('name')->get(),
            // Pass all buffs so the user can “Activate” any of them
            'buffCatalog' => \App\Models\Buff::orderBy('name')->get(),
            // Pass current active buffs for display
            'activeBuffs' => \App\Models\UserBuff::where('user_id', $user->id)
                ->active()
                ->with('buff')
                ->get(),
        ]);
    }
}
