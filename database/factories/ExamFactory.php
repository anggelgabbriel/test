<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => random_int(0, 2),
            'date' => '25/12/2022'
        ];
    }


    public function type($i)
    {
        return $this->state([
            'type' => $i,
        ]);
    }

}
