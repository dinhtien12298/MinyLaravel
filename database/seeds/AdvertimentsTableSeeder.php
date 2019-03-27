<?php

use Illuminate\Database\Seeder;

class AdvertimentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advertiments')->insert([
            'link' => 'https://www.xwatch.vn/',
            'title' => 'x-watch',
            'image' => '/images/detail/advertiment.png',
        ]);
    }
}
