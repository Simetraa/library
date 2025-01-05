<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;


class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $guarded = [];


    protected $casts = [
        'subjects' => 'array',
    ];

    public function branches(): BelongsToMany {
        return $this->belongsToMany(Branch::class)
            ->withPivot('quantity');
    }

    public function getTotalQuantity() {
        // count the number of this book book in all branches
        return DB::table('book_branch')->where('book_id', $this->id)->sum('quantity');
    }

    public function reservations(): HasMany {
        return $this->hasMany(Reservation::class);
    }

    public function sales(): BelongsToMany {
        return $this->belongsToMany(Sale::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function getPrice(): string {
        $price = $this->attributes['price'];
        return "£" . number_format($price, 2, ".", '');
    }

    public function getSalesQuantity(string $period){
        $totalSales = 0;
        foreach($this->sales as $sale){
                $totalSales += $sale->books->sum("quantity");
            }
        return $totalSales;
    }
}

