<?php

use Illuminate\Database\Seeder;

class ActorMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actor_factory = factory(App\Actor::class);
        $actors = array(
            $actor_factory->create(['name' => 'Al Pacino'])->id,
            $actor_factory->create(['name' => 'Marlon Brandon'])->id,
            $actor_factory->create(['name' => 'Robert De Niro'])->id
        );

        $movie_factory = factory(App\Movie::class);

        $movie_1 = $movie_factory
            ->create(['name' => 'El Padrino'])
            ->actors()->attach([$actors[0], $actors[1]]);

        $movie_2 = $movie_factory
            ->create(['name' => 'Buenos Muchachos'])
            ->actors()->attach([$actors[2]]);

        $movie_3 = $movie_factory
            ->create(['name' => 'Apocalypse Now'])
            ->actors()->attach([$actors[1]]);
    }
}

