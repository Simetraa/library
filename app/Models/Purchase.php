<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{
    protected $guarded = [];
    public function book(): BelongsTo {
        return $this->belongsTo(Book::class);
    }

    public function branch(): BelongsTo {
        return $this->belongsTo(Branch::class);
    }
}
