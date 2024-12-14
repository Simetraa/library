<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public static function getBranches(){
        $branches = Branch::all();
        $list = [];
        foreach ($branches as $branch){
            array_push($list, [$branch->name, $branch->id]);
        }
        return $list;
    }
}
