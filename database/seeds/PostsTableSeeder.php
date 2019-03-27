<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 200; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence(),
                'user_id' => $faker->randomElement([1, 2]),
                'view_num' => $faker->randomNumber(),
                'like_num' => $faker->randomNumber(),
                'subject_id' => $faker->numberBetween(1, 132),
                'content' => $faker->text(600),
            ]);
        }
    }
}
