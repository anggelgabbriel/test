<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Exam;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Romerito GMAIL';
        $user->email = 'romerito.campos@gmail.com';
        $user->isadmin = true;
        $user->password = \Hash::make('12341234');
        $user->save();

        $user = new User;
        $user->name = 'Romerito GMAIL';
        $user->email = 'romerito.campos1@gmail.com';
        $user->isadmin = true;
        $user->password = \Hash::make('12341234');
        $user->save();

        User::factory(8)->create()->each(function ($user) {
            $user->exam()->save(Exam::factory()->type(NULL)->make());
        });

        User::factory(8)->create()->each(function ($user) {
            $user->exam()->save(Exam::factory()->type(-1)->make());
        });

        User::factory(12)->create()->each(function ($user) {
            $user->exam()->save(Exam::factory()->make());
        });



    }
}



