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
        // $this->call(UsersTableSeeder::class);
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            App\Student::create([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'address' => $faker->address,
                'matric_no' => $faker->randomNumber($nbDigits = null, $strict = false),
                'password' => $faker->password,
                'date_of_birth' => $faker->date,
                'department' => 'computer science',
            ]);
        }
    }
}
