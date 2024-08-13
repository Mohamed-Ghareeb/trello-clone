<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\Board;
use App\Models\Column;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Database\Eloquent\Builder;

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
    public function moved(array $items)
    {
        collect($items)->recursive()->each(function ($column) {
            $columnId = $column->get('value');
            $newOrderForCards = $column->get('items')->pluck('value')->toArray();
            $cards = Card::whereUserId(auth()->id())
                ->find($newOrderForCards)
                ->where('column_id', '!=', $columnId)
                ->each->update(['column_id' => $columnId]);

            Card::setNewOrder($newOrderForCards, modifyQuery: fn(Builder $query) => $query->whereBelongsTo(auth()->user()));    
        });

        
        // dd($items);
    }

    public function render()
    {
        return view('livewire.board-show', [
            'columns' => $this->board->columns()->ordered()->get()
        ]);
    }
}
