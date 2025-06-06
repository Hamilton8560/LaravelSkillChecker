<?php

namespace App\Livewire;

use App\Models\TrainingMethod;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateMethod extends Component
{
    //===Question?===
    public $name;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:training_methods,name,NULL,id,user_id,' . Auth::id(),
        ];
    }

    public function submit()
    {
        $this->validate();
        TrainingMethod::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
        ]);
        session()->flash('message', 'Training Method Created');
        $this->name = '';
        return redirect()->route('methods.index');
    }

    public function render()
    {
        return view('livewire.create-method');
    }
}
