<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Training;
use App\Models\TrainingMethod;
use App\Models\TrainingCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // ← import your User model so phpdoc knows the type

class CreateTraining extends Component
{
    public $category_id;
    public $method_id;
    public $duration;
    public $RPE;
    public $notes;

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

        Training::create([
            'user_id'              => Auth::id(),
            'training_category_id' => $this->category_id,
            'training_method_id'   => $this->method_id,
            'duration'             => $this->duration,
            'RPE'                  => $this->RPE,
            'notes'                => $this->notes,
        ]);

        session()->flash('message', 'Training logged successfully.');
        $this->reset(['category_id', 'method_id', 'duration', 'RPE', 'notes']);
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('livewire.training.create-training', [
            'categories' => $user->trainingCategories()
                                 ->orderBy('name')
                                 ->get(),
            'methods'    => $user->trainingMethods()
                                 ->orderBy('name')
                                 ->get(),
        ]);
    }
}
