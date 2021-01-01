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
        // factory(Admin::class, 100)->create();
        Admin::truncate();
        Admin::create([
            'name' => 'Nguyễn Đình Quang',
            'email' => 'admin01@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'no where',
            'phone' => 01234565,
            'date_of_birth' => '2020/01/01',
            'gender' => 'nam',
            'permission' => 1,
        ]);
        Admin::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'admin02@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'no where',
            'phone' => 012345657,
            'date_of_birth' => '2020/01/01',
            'gender' => 'nam',
            'basic_salary' => '8000000',
            'permission' => 2,
        ]);
        Admin::create([
            'name' => 'Nguyễn Văn A1',
            'email' => 'admin11@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'no where',
            'phone' => 0123456571,
            'date_of_birth' => '2020/01/01',
            'basic_salary' => '7000000',
            'gender' => 'nam',
            'permission' => 2,
        ]);
        Admin::create([
            'name' => 'Nguyễn Văn B',
            'email' => 'admin03@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'no where',
            'phone' => 012345645,
            'date_of_birth' => '2020/01/01',
            'basic_salary' => '8000000',
            'gender' => 'nam',
            'permission' => 3,
        ]);
        Admin::create([
            'name' => 'Nguyễn Văn C',
            'email' => 'admin04@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'no where',
            'phone' => 012345650,
            'date_of_birth' => '2020/01/01',
            'basic_salary' => '2000000',
            'gender' => 'nam',
            'permission' => 4,
        ]);
        // Admin::factory()->times(5)->create();
    }
}
