<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;

class BookSale extends Model
{
    protected $table = 'book_sale';
    public $timestamps = false;
    protected $fillable = ['returned', 'quantity', 'price']; // Add any pivot attributes you want to be mass assignable

}
