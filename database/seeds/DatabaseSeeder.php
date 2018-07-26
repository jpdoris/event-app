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
        $this->call(CountriesSeeder::class);
        $this->command->info('Seeded the countries table.');

        $this->call(StatesSeeder::class);
        $this->command->info('Seeded the states table.');

        $this->call(UsersTableSeeder::class);
        $this->command->info('Seeded the users table.');

        $this->call(SessionsTableSeeder::class);
        $this->command->info('Seeded the sessions table.');

        $this->call(SpeakersTableSeeder::class);
        $this->command->info('Seeded the speakers table.');

        $this->call(EventsTableSeeder::class);
        $this->command->info('Seeded the events table.');
    }
}
