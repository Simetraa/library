<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookBranch;
use App\Models\Branch;
use App\Models\Purchase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

//        $branches = fake()->shuffle(Branch::all()->toArray());
//        $books = fake()->shuffle(Book::all()->toArray());

        $branches = Branch::all();
        $books = Book::all();

        foreach ($branches as $branch) {
            foreach ($books as $book) {
                // insert to book purchase



                $purchase = Purchase::create([
                    'branch_id' => $branch['id'],
                    'book_id' => $book['id'],
                    'quantity' => fake()->numberBetween(1, 10),
                    'price' => $book['price'],
                    'supplier' => fake()->randomElement(['Random House', 'HarperCollins', 'Hachette', 'Simon & Schuster']),
                ]);

                BookBranch::create([
                    'branch_id' => $branch['id'],
                    'book_id' => $book['id'],
                    'quantity' => $purchase->quantity,
                ]);

            }
        }
    }
}
