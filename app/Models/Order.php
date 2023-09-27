<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=['user_id','book_id','quantity','customer_name','customer_email',
        'customer_address','customer_phone','payment_method','total_amount',
        'status'];


    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
