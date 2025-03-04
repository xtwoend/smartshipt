<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'name' => 'Fleet Manage',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Fleet Threshold Sensor Setting',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Port Manage',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Download Report',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Fleet PIC Manage',
                'guard_name' => 'web'
            ]
        ]);
    }
}
