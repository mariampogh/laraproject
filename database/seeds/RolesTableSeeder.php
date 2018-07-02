<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->delete();

      $roles = [
        ['id' => 1, 'name' => 'admin'],
        ['id' => 2, 'name' => 'guest'],

      ];

      DB::table('roles')->insert($roles);
    }

}
