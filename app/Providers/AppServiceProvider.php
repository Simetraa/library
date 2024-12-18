<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('reserve-book', function(User $user, Book $book) {
            return $user->role === 'user';
        });

        Gate::define('show-reservation', function(User $user, Reservation $reservation) {
            return $user->is($reservation->user);
        });

        Gate::define('manage-reservation', function(User $user, Reservation $reservation) {
            return $user->role === 'admin';
        });

        Gate::define('manage-books', function(User $user) {
            return $user->role === 'admin';
        });


    }
}
