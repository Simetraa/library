<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReservationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('http://library.test/login')
                    ->type('email', 'testing@example.com')
                    ->type('password', 'password')
                    ->press('Login')
                    ->visit('http://library.test/books/1')
                    ->type('quantity', '1')
                    ->select('branch_id', '1')
                    ->click('button[type="submit"]')
                    ->assertPathIs('/')
                    ->visit('http://library.test/account/reservations')
                    ->assertSeeAnythingIn('.reserved-book-info');
        });
    }
}
