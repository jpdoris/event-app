<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('attendees')->truncate();

        factory(App\User::class, 25)->create()->each(function($u) {
            $u->attendee()->saveMany(factory(App\Attendee::class, 3)->make());
        });
    }
}
