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
        // seed the countries
        $this->call(CountriesSeeder::class);
        $this->command->info('Seeded the countries table.');

        // seed the states
        $this->call(StatesSeeder::class);
        $this->command->info('Seeded the states table.');

        // seed the users table
        $this->call(UsersTableSeeder::class);
        $this->command->info('Seeded the users table.');

        // seed the sessions table
        $this->call(SessionsTableSeeder::class);
        $this->command->info('Seeded the sessions table.');

        // seed the speakers table
        $this->call(SpeakersTableSeeder::class);
        $this->command->info('Seeded the speakers table.');

        // seed the events table
        $this->call(EventsTableSeeder::class);
        $this->command->info('Seeded the events table.');
    }
}
