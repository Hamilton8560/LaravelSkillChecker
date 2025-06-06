<?php

namespace App\Livewire;

use App\Models\Training;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateTraining extends Component
{
    public $category_id;

    public $method_id;

    public $duration;

    public $RPE;

    public $notes;

    public $task_description;

    public $what_you_learned;

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:training_categories,id,user_id,' . Auth::id(),
            'method_id' => 'required|exists:training_methods,id,user_id,' . Auth::id(),
            'duration' => 'required|integer|min:1',
            'RPE' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string',
            'task_description' => 'nullable|string',
            'what_you_learned' => 'nullable|string',
        ];
    }

    public function submit()
    {
        $this->validate();

        Training::create([
            'user_id' => Auth::id(),
            'training_category_id' => $this->category_id,
            'training_method_id' => $this->method_id,
            'duration' => $this->duration,
            'RPE' => $this->RPE,
            'notes' => $this->notes,
            'task_description' => $this->task_description,
            'what_you_learned' => $this->what_you_learned,
        ]);

        session()->flash('message', 'Training logged successfully.');
        $this->reset(['category_id', 'method_id', 'duration', 'RPE', 'notes', 'task_description', 'what_you_learned']);

        // Redirect to the trainings list after successful submission
        $this->redirect(route('trainings.index'));
    }

    public function render()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('livewire.training.create-training', [
            'categories' => $user->trainingCategories()->orderBy('name')->get(),
            'methods' => $user->trainingMethods()->orderBy('name')->get(),
        ]);
    }
}
