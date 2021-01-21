<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        Admin::create([
            'name' => 'Nguyễn Đình Quân',
            'email' => 'quannd@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'no where',
            'phone' => 01234565,
            'date_of_birth' => '2020/01/01',
            'gender' => 'nam',
            'permission' => 1,
        ]);
    }
}
