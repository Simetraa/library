<?php

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_book', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Reservation::class)->constrained();
            $table->foreignIdFor(Book::class)->constrained();
            $table->integer('quantity');
        });    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_book');

    }
};
