<?php

namespace App\Livewire;

use App\Models\Objective;
use Livewire\Component;

class EditObjectives extends Component
{
    // Option A: Let Livewire auto-inject via property
    public Objective $objective;

    // Option B: Use mount() to assign it
    public function mount(Objective $objective)
    {
        $this->objective = $objective;
    }

    public function render()
    {
        return view('livewire.edit-objectives', [
            'objective' => $this->objective,
        ]);
    }
}
