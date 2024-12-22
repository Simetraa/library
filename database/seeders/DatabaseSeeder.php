<?php

namespace Database\Seeders;

use App\Models\BookSale;
use App\Models\Branch;
use App\Models\Reservation;
use App\Models\ReservationBook;
use App\Models\Sale;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Branch::factory(5)
            ->hasAttached(
                Book::factory()->count(5),
                ['quantity' => fake()->randomNumber(3)]
            )
            ->create();

        Branch::factory()
            ->count(5)
            ->hasAttached(Book::factory()->count(3), function() {
                return ['quantity' => fake()->randomNumber(3)];
            })
            ->create();

        User::factory()->create([
            'email' => 'test@example.com',
            'branch_id' => 1,
        ]);

        User::factory()->create([
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
//
        Reservation::create([
            'user_id' => 1,
            'branch_id' => 1,
            'book_id' => 1,
            'quantity' => 1,
            'status' => 'pending',
        ]);

        Sale::create([
            'user_id' => 1,
            'branch_id' => 1,
        ]);

        BookSale::create([
            'sale_id' => 1,
            'book_id' => 1,
            'quantity' => 1,
            'price' => 10.00,
            'returned' => false,
        ]);
        BookSale::create([
            'sale_id' => 1,
            'book_id' => 1,
            'quantity' => 1,
            'price' => 10.00,
            'returned' => false,
        ]);
        BookSale::create([
            'sale_id' => 1,
            'book_id' => 1,
            'quantity' => 1,
            'price' => 10.00,
            'returned' => false,
        ]);
        BookSale::create([
            'sale_id' => 1,
            'book_id' => 1,
            'quantity' => 1,
            'price' => 10.00,
            'returned' => false,
        ]);

        BookSale::create([
            'sale_id' => 1,
            'book_id' => 3,
            'quantity' => 15,
            'price' => 1.00,
            'returned' => false,
        ]);
//
//        Book::create([
//            "title" => "James & the Giant Peach",
//            "author" => "Roald Dahl",
//            "cover_url" => "",
//            "description" => "description",
//            "price" => "14",
//            "subjects" =>["Arts"],
//            "publication_date" => "2021-01-01"]);
//
//        Branch::create([
//            'name' => 'Sheffield',
//        ]);
//
//        User::factory()->create([
//            'email' => 'test@example.com',
//            'branch_id' => 1,
//        ]);
//
//        Sale::create([
//            'user_id' => 1,
//            'branch_id' => 1
//        ]);
//
//        BookSale::create([
//            'sale_id' => 1,
//            'book_id' => 1,
//            'quantity' => 1,
//            'price' => 10.00,
//            'returned' => false
//        ]);



    }
}
