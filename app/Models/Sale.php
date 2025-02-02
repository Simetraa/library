<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function books(): BelongsToMany {
        return $this->belongsToMany(Book::class)->withPivot('price', 'quantity', 'returned');
    }

    public function branch(): BelongsTo {
        return $this->belongsTo(Branch::class);
    }

    public function totalPrice()
    {
        $total = 0;
        foreach ($this->books as $book) {
            $total += $book->pivot->price * $book->pivot->quantity;
        }
        return $total;
    }
}

//    public function processSale() {
//        $this->books->each(function($book) {
//            $book->decrement($book->quantity);
//        });
//    }
//

//}
