<?php

namespace App\Livewire;

use App\Models\Objective;
use App\Models\TrainingCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditObjectives extends Component
{
    // Option A: Let Livewire auto-inject via property
    public Objective $objective;
    public TrainingCategory $category;
    public $explained;
    public $how_you_learned;


    // Option B: Use mount() to assign it
    public function mount(Objective $objective)
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->objective = $objective;
        $this->category = $objective->category;
        $this->explained = $objective->explained;
        $this->how_you_learned = $objective->how_you_learned;
    }

    public function rules()
    {
        return [
            'category.id' => 'required|exists:training_categories,id',
            'explained' => 'nullable|string',
            'how_you_learned' => 'nullable|string'
        ];
    }

    public function update()
    {
        $this->validate();
        $this->objective->training_category_id = $this->category->id;
        $this->objective->explained = $this->explained;
        $this->objective->how_you_learned = $this->how_you_learned;
        $this->objective->save();

        session()->flash('message', 'Objective updated Successfully');
        return redirect()->route('objectives.index');
    }

    public function render()
    {


        return view('livewire.edit-objectives', [
            'objective' => $this->objective,
        ]);
    }
}
