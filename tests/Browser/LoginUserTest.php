<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginUserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('http://library.test/login')
                    ->type('email', 'test@example.com')
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/');
        });
    }
}
