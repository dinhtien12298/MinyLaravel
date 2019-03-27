<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_subjects = ['toán học', 'văn học', 'tiếng Anh', 'lịch sử', 'địa lý', 'vật lý',
                        'sinh học', 'soạn văn', 'văn mẫu', 'tiếng Việt', 'đề thi'];
        $all_data = [];
        foreach ($all_subjects as $subject) {
            for ($i = 1; $i < 13; $i++) {
                array_push($all_data, ['subject' => $subject, 'class' => "lớp $i"]);
            }
        }

        foreach ($all_data as $data) {
            DB::table('subjects')->insert($data);
        }
    }
}
