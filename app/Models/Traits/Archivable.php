<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Archivable
{
    public function initializeArchivable()
    {
        $this->mergeCasts([
            'archived_at' => 'datetime'
        ]);
    }

    public function scopeNotArchived(Builder $query)
    {
        return $query->whereNull($this->getTable() . '.archived_at');
    }

    public function scopeArchived(Builder $query)
    {
        return $query->whereNotNull($this->getTable() . '.archived_at');
    }

    public function scopeLatesetArchived(Builder $query)
    {
        return $query->latest('archived_at');
    }
}
