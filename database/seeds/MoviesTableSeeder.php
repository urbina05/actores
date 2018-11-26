<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Movie::class, 10)->create()->each(function($u) {
            $u->actors()->save(factory(App\Actor::class)->make());
        });
    }
}
