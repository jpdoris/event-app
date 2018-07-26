<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->truncate();
        DB::table('venues')->truncate();
        DB::table('sessions')->truncate();
        DB::table('speakers')->truncate();

        factory(App\Event::class, 10)->create();

        // Get all the sessions
        $sessions = App\Session::all();

        // Get all the speakers
        $sessions = App\Speaker::all();

// Populate the pivot table
        App\Event::all()->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
