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
        //
//        $user = new User;
//        $user->name = 'Romerito GMAIL';
//        $user->email = 'romerito.campos@gmail.com';
//        $user->password = \Hash::make('123');
//        $user->save();
//
//        $user = new User;
//        $user->name = 'Romerito IFRN';
//        $user->email = 'romerito.campos@ifrn.edu.br';
//        $user->password = \Hash::make('123');
//        $user->save();
//
//        $user = new User;
//        $user->name = 'Romerito IFRN';
//        $user->email = 'romerito.campos@editor';
//        $user->password = \Hash::make('123');
//        $user->save();

//        $exam = new Exam;
//        $exam->user_id = 0;
//        $exam->type = 0;
//        $exam->save();

//        User::factory(10)->create();
//        Exam::factory(10)->create();
        User::factory(10)->create()->each(function ($user) {
            $user->exam()->save(Exam::factory()->make());
        });

    }
}
