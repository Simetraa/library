<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function branch(): BelongsTo {
        return $this->belongsTo(Branch::class);
    }

    public function book(): HasMany {
        return $this->hasMany(Book::class);
    }
}
