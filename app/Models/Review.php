<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'book_id',
        'customer_id',
        'rating',
        'review_text',
        'review_date',
    ];
}
