<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('carts')->truncate();
        $dataFile = base_path('database/seeders/cart.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                'id' => $datas[$row][0],
                'user_id' => $datas[$row][1],
                'product_id' => $datas[$row][2],
                'quantity' => $datas[$row][3],
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                Cart::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            Cart::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
