<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','book_id','quantity_in_stock',
    ];


    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }


}
