<?php

use App\Models\Book;
use App\Models\Sale;
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
        Schema::create('book_sale', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sale::class);
            $table->foreignIdFor(Book::class);
            $table->integer('quantity');
            $table->decimal('price', 9, 3);
            $table->boolean('returned');  // TODO: improve status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_books');
    }
};
