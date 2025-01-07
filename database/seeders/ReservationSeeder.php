<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);
        $branches = Branch::all();

        foreach ($branches as $branch) {
            // Create two reservations, one collected and one pending

            $book = $branch->books->where('id', 1)->first();

            $reservation = $user->reservations()->create([
                'branch_id' => $branch->id,
                'book_id' => $book['id'],
                'quantity' => 1,
                'status' => 'pending',
            ]);

            $book = $branch->books->where('id', 2)->first();

            $reservation = $user->reservations()->create([
                'branch_id' => $branch->id,
                'book_id' => $book['id'],
                'quantity' => 1,
                'status' => 'collected',
            ]);


//            $book = $branch->books->first();
//
//            $reservation = $user->reservations()->create([
//                'branch_id' => $branch->id,
//                'book_id' => $book->id,
//                'quantity' => 1,
//                'status' => 'pending',
//            ]);
//
//            $book = $branch->books->where('id', 2);
//
//            $reservation = $user->reservations()->create([
//                'branch_id' => $branch->id,
//                'book_id' => $book->id,
//                'quantity' => 1,
//                'status' => 'collected',
//            ]);
        }


    }
}
