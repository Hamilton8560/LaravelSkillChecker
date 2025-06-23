<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Illuminate\Pagination\LengthAwarePaginator;

use Livewire\Component;

class JournalTable extends Component
{
    public array $headers;
    public LengthAwarePaginator $journals;
    public function render()
    {
        return view('livewire.journal-table');
    }
}
