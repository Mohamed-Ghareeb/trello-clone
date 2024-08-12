<?php

namespace App\Livewire;

use App\Models\Board;
use App\Models\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BoardShow extends Component
{
    public Board $board;
    
    #[Layout('layouts.app')]    
    
    public function mount()
    {
        $this->authorize('show', $this->board);
    }
    public function sortOrder(array $items)
    {
        $newOrder = collect($items)->pluck('value')->toArray();
        Column::setNewOrder($newOrder, modifyQuery: fn (Builder $query) => $query->whereBelongsTo(auth()->user()));
    }

    public function render()
    {
        return view('livewire.board-show', [
            'columns' => $this->board->columns()->ordered()->get()
        ]);
    }
}
