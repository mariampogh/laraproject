<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->delete();

      $users = [
        ['id' => 1, 'name' => 'mariam', 'email' => 'm@m.m', 'password' => bcrypt('mariam'), 'role'=> 1],
        ['id' => 2, 'name' => 'arman', 'email' => 'a@a.a', 'password' => bcrypt('arman1'), 'role'=> 2],

      ];

    DB::table('users')->insert($users);
    }
}
