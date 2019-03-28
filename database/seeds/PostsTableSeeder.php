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

        for ($i = 0; $i < 600; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence(),
                'user_id' => $faker->randomElement([1, 2]),
                'view_num' => $faker->numberBetween(0, 123456),
                'like_num' => $faker->numberBetween(0, 1000),
                'subject_id' => $faker->numberBetween(1, 132),
                'content' => $faker->text(600),
            ]);
        }
    }
}
