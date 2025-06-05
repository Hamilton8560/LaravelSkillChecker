<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrainingCategory;
use Illuminate\Support\Facades\Auth;

class EditCategory extends Component
{
    public TrainingCategory $category;
    public $name;

    public function mount(TrainingCategory $category)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        //Ensure the category belongs to the logged-in user; otherwise 404
        $this->category = $user
            ->trainingCategories()
            ->findOrFail($category->id);

        $this->name = $this->category->name;
    }

    protected function rules()
    {
        return [
            // Unique per user, ignoring current category ID
            // ===Question?
            'name' => 'required|string|max:255|unique:training_categories,name,' . $this->category->id . ',id,user_id,' . Auth::id(),
        ];
    }

    public function submit()
    {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
        ]);
        
        session()->flash('message', 'Category updated successfully.');
        
        return redirect()->route('categories.index');
    
    }

    public function render()
    {
        return view('livewire.edit-category');
    }
}
