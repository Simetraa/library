<?php

namespace Database\Seeders;

use App\Models\BookSale;
use App\Models\Branch;
use App\Models\Purchase;
use App\Models\Reservation;
use App\Models\ReservationBook;
use App\Models\Sale;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BookSeeder::class,
            BranchSeeder::class,
            PurchaseSeeder::class,
            UserSeeder::class,
            SaleSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
