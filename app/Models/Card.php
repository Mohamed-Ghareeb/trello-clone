<?php

namespace App\Models;

use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $guarded = ['id'];
    
    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
