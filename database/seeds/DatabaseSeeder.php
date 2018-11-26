<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed para generar actores genericos sin Peliculas asociadas
        // $this->call('ActorsTableSeeder');

        // Seed para generar peliculas genericas con actores asociados
        // $this->call('MoviesTableSeeder');

        // Seed para generar peliculas dadas en el ejemplo con
        // sus actores asociados
        $this->call('ActorMovieTableSeeder');
    }
}
