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
}
