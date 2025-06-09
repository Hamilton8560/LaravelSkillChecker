<?php

namespace App\Livewire;

use App\Models\TrainingCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateCategory extends Component
{
    public $name;
    public $type;

    protected function rules()
    {
        return [
            // ===Question?
            'name' => 'required|string|max:255|unique:training_categories,name,NULL,id,user_id,' . Auth::id(),
        ];
    }

    public function submit()
    {
        $this->validate();

        TrainingCategory::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'type' => $this->type,
        ]);
        session()->flash('message', 'Category created');
        $this->name = '';
        $this->type = '';

        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
