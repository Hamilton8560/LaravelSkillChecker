<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListCategories extends Component
{
    public $confirmingDeleteId = null;

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // If the user has no categories, flash a message and redirect them
        if ($user->trainingCategories()->count() === 0) {
            session()->flash(
                'message',
                'No categories found. Please create a category first.'
            );

            $this->redirect(route('categories.create'));
        }
    }

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
        $category->delete();

        session()->flash('message', 'Category deleted.');
        $this->confirmingDeleteId = null;
    }
}
