<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AdvertimentsTableSeeder::class);
        $this->call(ClassesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
    }
}
