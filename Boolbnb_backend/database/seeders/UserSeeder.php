<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Faker\Provider\it_IT\Person as ItalianPerson;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $faker->addProvider(new ItalianPerson($faker));
        $faker->locale('it_IT');
        for ($i = 0; $i <= 10; $i++) {
            User::create([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'birth_date' => $faker->date($format = 'Y-m-d', $max = '2005-12-31'),
                'phone_number' => $faker->phoneNumber(),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt($faker->password(5, 15)),
            ]);
        }
    }
}
