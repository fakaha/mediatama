<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'id' => 1,
                'name' => 'admin'
            ),
            array(
                'id' => 2,
                'name' => 'customer'
            )
        );

        DB::table('roles')->insert($data);
    }
}
