<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Branch;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
//        Gate::define('reserve-book', function(User $user, Book $book) {
//            return $user->role === 'user';
//        });
//
//        Gate::define('show-reservation', function(User $user, Reservation $reservation) {
//            return $user->is($reservation->user);
//        });
//
//        Gate::define('manage-reservation', function(User $user, Reservation $reservation) {
//            return $user->role === 'admin';
//        });

        Gate::define('access-staff-and-admin-pages', function(User $user) {
            return $user->role === 'staff' || $user->role === 'admin';
        });

        Gate::define('access-staff-pages', function(User $user) {
            return $user->role === 'staff';
        });

        Gate::define('access-admin-pages', function(User $user) {
            return $user->role === 'admin';
        });

        Gate::define('access-user-pages', function(User $user) {
            return $user->role === 'user';
        });

        Gate::define('access-staff-account-page', function(){
            $userPageOwner = request()->route('user');
            return $userPageOwner->is(Auth::user()) || Auth::user()->role === 'admin';
        });
    }
}
