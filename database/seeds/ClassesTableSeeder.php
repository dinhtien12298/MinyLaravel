<?php

use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert(
            ['class' => 'lớp 1'],
            ['class' => 'lớp 2'],
            ['class' => 'lớp 3'],
            ['class' => 'lớp 4'],
            ['class' => 'lớp 5'],
            ['class' => 'lớp 6'],
            ['class' => 'lớp 7'],
            ['class' => 'lớp 8'],
            ['class' => 'lớp 9'],
            ['class' => 'lớp 10'],
            ['class' => 'lớp 11'],
            ['class' => 'lớp 12']
        );
        for ($i = 1; $i < 13; $i++) {
            DB::table('classes')->insert(['class' => "lớp $i"]);
        }
    }
}
