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

        factory(App\Event::class, 10)->create();

        // Get all the sessions
        $sessions = App\Session::all();

        // Get all the speakers
        $speakers = App\Speaker::all();

        // Populate the pivot tables
        App\Event::all()->each(function ($event) use ($sessions) {
            $event->sessions()->attach(
                $sessions->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        App\Session::all()->each(function ($session) use ($speakers) {
            $session->speakers()->attach(
                $speakers->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
