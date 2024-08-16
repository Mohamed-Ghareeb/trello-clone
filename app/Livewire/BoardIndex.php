<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class BoardIndex extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.board-index', [
            'boards' => auth()->user()->boards
        ]);
    }
}
