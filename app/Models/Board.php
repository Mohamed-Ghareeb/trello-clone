<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Board extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function columns(): HasMany
    {
        return $this->hasMany(Column::class);
    }

    public function cards(): HasManyThrough
    {
        return $this->hasManyThrough(Card::class, Column::class);
    }
}
