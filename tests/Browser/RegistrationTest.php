<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://library.test/register')
                    ->type('email', 'test2@example.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->select('branch_id')
                    ->click('button')
                    ->assertPathIs('/');
        });
    }
}
