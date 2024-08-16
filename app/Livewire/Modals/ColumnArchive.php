<?php

namespace App\Livewire\Modals;

use App\Models\Board;
use LivewireUI\Modal\ModalComponent;

class ColumnArchive extends ModalComponent
{
    public Board $board;

    public function unarchiveColumn($id)
    {
        $column = $this->board->columns()->findOrFail($id);

        $column->update([
            'archived_at' => null
        ]);

        $this->dispatch('board-updated');
    }
    public function render()
    {
        return view('livewire.modals.column-archive', [
            'columns' => $this->board->columns()->archived()->latesetArchived()->get()
        ]);
    }
}
