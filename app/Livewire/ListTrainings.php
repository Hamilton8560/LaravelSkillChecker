<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Training;

class ListTrainings extends Component
{
    use WithPagination;
    public $confirmingDeleteId = null;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    //==Question
    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // If the user has no trainings, flash a message and redirect them
        if ($user->trainings()->count() === 0) {
            session()->flash(
                'message',
                'No trainings found. Please log a training first.'
            );

            $this->redirect(route('trainings.create'));
        }
    }
    //== The routes look correct. The issue was that Livewire components cannot return redirect responses 
    //==from the render() method. I've moved the redirect logic to the mount() method, which runs once when
    //==the component is initialized. This is the proper way to handle redirects in Livewire components.
    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        //==Question?===
        $query = $user->trainings()
            ->with(['category', 'method'])
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->whereHas('category', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                        ->orWhereHas('method', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhere('notes', 'like', '%' . $this->search . '%')
                        ->orWhere('task_description', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        $trainings = $query->paginate($this->perPage);

        // Calculate stats for all trainings (not just current page)
        $stats = $user->trainings()
            ->selectRaw('
                COUNT(*) as total_sessions,
                SUM(duration) as total_duration,
                AVG(RPE) as avg_rpe,
                AVG(score) as avg_score
            ')
            ->first();

        // Render the list‐trainings view with the user's trainings
        return view('livewire.training.list-trainings', [
            'trainings' => $trainings,
            'stats' => $stats,
        ]);
    }
    public function goCategory()
    {
        return view('livewire.create-category');
    }

    public function confirmDelete($categoryId)
    {
        $this->confirmingDeleteId = $categoryId;
    }

    public function deleteTraining($trainingId)
    {
        // ===Question?
        /** @var \App\Models\User */
        $user = Auth::user();

        $training = $user->trainings()->findOrFail($trainingId);
        $training->delete();

        session()->flash('message', 'Training deleted successfully.');
        $this->confirmingDeleteId = null;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }
}
