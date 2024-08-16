<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\CreateCard;
use App\Livewire\Forms\EditColumn;

class Column extends Component
{
    public \App\Models\Column $column;
    public EditColumn $editColumnForm;
    public CreateCard $createCardForm;

    protected $listeners = [
        'column-{column.id}-updated' => '$refresh'
    ];

    public function mount()
    {
        $this->editColumnForm->title = $this->column->title;
    }

    public function createCard()
    {
        $this->createCardForm->validate();

        $card = $this->column->cards()->make($this->createCardForm->only('title'));
        $card->user()->associate(auth()->user());
        $card->save();

        $this->createCardForm->reset();

        $this->dispatch('card-created');
    }

    public function updateColumn()
    {
        $this->editColumnForm->validate();
        $this->column->update($this->editColumnForm->only('title'));
        $this->dispatch('column-updated');
    }

    public function archiveColumn()
    {
        $this->column->update([
            'archived_at' => now()
        ]);

        $this->dispatch('board-updated');
    }

    public function render()
    {
        return view('livewire.column', [
            'cards' => $this->column->cards()->notArchived()->ordered()->get()
        ]);
    }
}
