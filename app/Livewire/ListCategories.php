<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TrainingCategory;
use Illuminate\Support\Facades\Auth;



class ListCategories extends Component
{
    public $confirmingDeleteId = null;

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $categories = $user
            ->trainingCategories()
            ->orderBy('name')
            ->get();

        return view('livewire.list-categories', [
            'categories' => $categories,
        ]);
    }

    public function confirmDelete($categoryId)
    {
        $this->confirmingDeleteId = $categoryId;
    }

    public function deleteCategory($categoryId)
    {
        // ===Question?
        /** @var \App\Models\User */
        $user = Auth::user();

        $category = $user->trainingCategories()->findOrFail($categoryId);
        $category ->delete();

        session()->flash('message','Category deleted.');
        $this->confirmingDeleteId = null;
    }


}
