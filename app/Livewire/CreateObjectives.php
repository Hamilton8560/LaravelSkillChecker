<?php

namespace App\Livewire;

use App\Models\Objective;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateObjectives extends Component
{
    public $category_id;
    public $objectives;

    public function rules()
    {
        return [
            'category_id' => 'required|exists:training_categories,id,user_id,' . Auth::id(),
            'objectives' => 'required|string',
        ];
    }

    public function submit()
    {
        $this->validate();
        Objective::create([
            'user_id' => Auth::id(),
            'objectives' => $this->objectives,
            'training_category_id' => $this->category_id,
        ]);

        session()->flash('message', 'Learning Objective Created Successfully!');
        $this->reset(['category_id', 'objectives']);
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('livewire.create-objectives', [
            'categories' => $user->trainingCategories()->orderBy('name')->get()
        ]);
    }
}
