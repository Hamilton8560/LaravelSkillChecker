<?php

namespace App\Livewire;

use App\Models\training;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListMethods extends Component
{

    public $confirmingDeleteId = null;
    public function mount()
    {
        $user = Auth::user();
        if ($user->trainingMethods->count() === 0) {
            session()->flash(
                'message',
                'No training methods found, create one'
            );
            $this->redirect(route('methods.create'));
        }
    }

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $methods = $user
            ->trainingMethods()
            ->orderBy('name')
            ->get();
        return view('livewire.list-methods', [
            'methods' => $methods
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
