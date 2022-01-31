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
        $user->password = \Hash::make('123');
        $user->save();

        User::factory(10)->create()->each(function ($user) {
            $user->exam()->save(Exam::factory()->make());
        });

    }
}
