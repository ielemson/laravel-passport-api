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
        factory(\App\User::class,5)->create()
        ->each(
            function($user){
                $user->role()->save(factory(\App\Role::class)->make());
            }
        );
    }
}
