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
        //Seed the countries
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');

        $this->call(StatesSeeder::class);
        $this->command->info('Seeded the states!');

         $this->call(UsersTableSeeder::class);

//        factory(App\User::class, 50)->create()->each(function ($u) {
//            $u->posts()->save(factory(App\Post::class)->make());
//        });
    }
}
