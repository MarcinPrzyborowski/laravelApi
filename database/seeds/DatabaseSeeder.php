<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    const TEST_EMAIL = 'testing@dot.net';
    const TEST_PASSWORD = 'feqwdf34523rqefwgrht';

    /**
     * Seed the application's database.
     */
    public function run()
    {
        factory(\App\Models\Publisher::class, 3)->create()->each(function ($publisher) {
            factory(\App\Models\Magazine::class, 10)->create(['publisher_id' => $publisher->id]);
        });

        factory(\App\Models\User::class)->create();
        factory(\App\Models\User::class)->create(['email' => self::TEST_EMAIL, 'password' => Hash::make(self::TEST_PASSWORD)]);
    }
}
