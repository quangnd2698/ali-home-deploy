<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'phone' => 123456789,
        //     'password' => Hash::make('123456789'),
        // ]);
        $this->call(ProductSeeder::class);
        // $this->call(CartSeeder::class);
        // $this->call(AccumulatePointSeeder::class);
        // $this->call(InvoiceSeeder::class);
        // $this->call(InvoiceDetailSeeder::class);
        $this->call(AdminsTableSeeder::class);
        // $this->call(SalaryDetailSeeder::class);
        // $this->call(SalarySeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(WardsTableSeeder::class);
    }
}
