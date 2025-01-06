<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TransferQuantityTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://library.test/login')
                    ->type('email', 'admin@example.com')
                    ->type('password', 'password')
                    ->press('Login')
                    ->visit('http://library.test/branches/1/inventory/1')
                    ->type('quantity', '5')
                    ->select('branch_id', '22')
                    ->press('Transfer')
                    ->visit('http://library.test/branches/2/inventory')
                    ->assertSeeAnythingIn('#book_id');
        });
    }
}
