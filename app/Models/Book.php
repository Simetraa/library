<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Class News
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @mixin \Eloquent
 * @package App
 */
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

    public function getQuantityAttribute() {
        // count the number of this book book in all branches
        return DB::table('book_branch')->where('book_id', $this->id)->count();
    }

    public function reservations(): HasMany {
        return $this->hasMany(Reservation::class);
    }

    public function sales(): BelongsToMany {
        return $this->belongsToMany(Sale::class);
    }

    function getPrice(): string {
        $price = $this->attributes['price'];
        return "£" . number_format($price, 2, ".", '');
    }
}

