<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Training;
use App\Models\User;               // ← make sure you import User
use Illuminate\Support\Facades\Auth;

class EditTraining extends Component
{
    public Training $training;

    public $category_id;
    public $method_id;
    public $duration;
    public $RPE;
    public $notes;

    public function mount(Training $training)
    {
        /** @var User $user */
        $user = Auth::user();

        // Now $user->trainings() is known to Intelephense
        $this->training = $user
            ->trainings()
            ->findOrFail($training->id);

        // Pre-fill form fields
        $this->category_id = $this->training->training_category_id;
        $this->method_id   = $this->training->training_method_id;
        $this->duration    = $this->training->duration;
        $this->RPE         = $this->training->RPE;
        $this->notes       = $this->training->notes;
    }

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:training_categories,id,user_id,' . Auth::id(),
            'method_id'   => 'required|exists:training_methods,id,user_id,'   . Auth::id(),
            'duration'    => 'required|integer|min:1',
            'RPE'         => 'required|integer|min:1|max:10',
            'notes'       => 'nullable|string',
        ];
    }

    public function submit()
    {
        $this->validate();

        $this->training->update([
            'training_category_id' => $this->category_id,
            'training_method_id'   => $this->method_id,
            'duration'             => $this->duration,
            'RPE'                  => $this->RPE,
            'notes'                => $this->notes,
        ]);

        session()->flash('message', 'Training updated successfully.');

        return redirect()->route('trainings.index');
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('livewire.training.edit-training', [
            'categories' => $user
                             ->trainingCategories()
                             ->orderBy('name')
                             ->get(),
            'methods'    => $user
                             ->trainingMethods()
                             ->orderBy('name')
                             ->get(),
        ]);
    }
}
