<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateColumn;
use App\Models\Card;
use App\Models\Board;
use App\Models\Column;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Database\Eloquent\Builder;

class BoardShow extends Component
{
    public Board $board;

    public CreateColumn $createColumnForm;

    protected $listeners = [
        'board-updated' => '$refresh'
    ];
    
    public function mount()
    {
        $this->authorize('show', $this->board);
    }

    public function sortOrder(array $items)
    {
        $newOrder = collect($items)->pluck('value')->toArray();
        Column::setNewOrder($newOrder, modifyQuery: fn(Builder $query) => $query->whereBelongsTo(auth()->user()));
    }
    public function moved(array $items)
    {
        collect($items)->recursive()->each(function ($column) {
            $columnId = $column->get('value');
            $newOrderForCards = $column->get('items')->pluck('value')->toArray();
            Card::whereBelongsTo(auth()->user())
                ->find($newOrderForCards)
                ->where('column_id', '!=', $columnId)
                ->each->update(['column_id' => $columnId]);

            Card::setNewOrder($newOrderForCards, modifyQuery: fn(Builder $query) => $query->whereBelongsTo(auth()->user()));
        });
    }

    public function createColumn()
    {
        $this->createColumnForm->validate();

        $column = $this->board->columns()->make($this->createColumnForm->only('title'));
        $column->user()->associate(auth()->user());
        $column->save();

        $this->createColumnForm->reset();

        $this->dispatch('column-created');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.board-show', [
            'columns' => $this->board->columns()->notArchived()->ordered()->get()
        ]);
    }
}
