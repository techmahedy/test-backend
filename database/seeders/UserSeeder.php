<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();
        
        $a = 0;

        while ($a <= 10) {
            
            User::create([
                'name' => $faker->unique()->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('password')
            ]);

            $a++;

        }
    }
}
