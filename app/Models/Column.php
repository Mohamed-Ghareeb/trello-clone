<?php

namespace App\Models;

use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Column extends Model implements Sortable
{
    use HasFactory, SortableTrait;
    
    protected $guarded = ['id'];

    protected $casts = [
        'archived_at' => 'datetime'
    ];
    
    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }
    
    public function scopeNotArchived(Builder $query)
    {
        return $query->whereNull('archived_at');
    }
}
