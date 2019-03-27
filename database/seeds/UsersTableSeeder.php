<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_users = [
            [
                'username' => 'dinhtien',
                'password' => bcrypt('123456'),
                'fullname' => 'Nguyễn Đình Tiến',
                'birth' => '1998-02-12',
                'phone' => '0912021998',
                'email' => 'dinhtiennguyen.1202@gmail.com',
                'working' => 'BK',
            ],
            [
                'username' => 'saomai',
                'password' => bcrypt('123456'),
                'fullname' => 'Lê Sao Mai',
                'birth' => '1996-09-17',
                'phone' => '0917091996',
                'email' => 'maismile@gmail.com',
                'working' => 'VH',
            ]
        ];
        foreach ($all_users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
