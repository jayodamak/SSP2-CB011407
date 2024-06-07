<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;    
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $password = Hash::make('1234');
        $password = bcrypt('1234');

        $adminRecords = [
            [
                'id' => '2',
                'name' => 'Sumith',
                'type' => 'admin',
                'mobile' => '0778457125',
                'email' => 'sumith@admin.com',
                'password' => $password,
                'image' => '',
                'status' => 1
            ],
            [
                'id' => '3',
                'name' => 'Amith',
                'type' => 'marketing manager',
                'mobile' => '0704369201',
                'email' => 'amith@admin.com',
                'password' => $password,
                'image' => '',
                'status' => 1
            ],
        ];
        Admin::insert($adminRecords);
    }
}
