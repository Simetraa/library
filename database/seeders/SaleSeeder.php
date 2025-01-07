<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookBranch;
use App\Models\BookSale;
use App\Models\Branch;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = Branch::all();
        $books = Book::all();

        foreach ($branches as $branch) {
            // generate random number of sales
            foreach(range(0, 3) as $i) {
                $user = User::first();

                $sale = Sale::create([
                    'user_id' => $user->id,
                    'branch_id' => $branch->id,
                ]);
                $branchBooks = fake()->randomElements($branch->books, 3);

                foreach($branchBooks as $book) {

                    if($book->pivot->quantity <= 0) {
                        continue;
                    }

                    $price = $book->price;


                    BookSale::create([
                        'sale_id' => $sale['id'],
                        'book_id' => $book['id'],
                        'quantity' => 1,
                        'price' => $price,
                        'returned' => false,
                    ]);
                }
            }

            // manually set 3 books quantity to 0

            $toZero = fake()->randomElements($branch->books, 3);

            foreach($toZero as $book) {
                $book->pivot->quantity = 0;
                $this->command->info("Setting {$branch->id} / {$book->id} quantity to 0");
                $book->pivot->save();
            }
    }
}}
