<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function columns(): HasMany
    {
        return $this->hasMany(Column::class);
    }
}
