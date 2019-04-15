<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Publisher::class,3)->create()->each(function ($publisher) {
            factory(\App\Magazine::class,10)->create(['publisher_id' => $publisher->id]);
        });

        factory(\App\User::class)->create();
    }
}
