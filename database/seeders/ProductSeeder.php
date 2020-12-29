<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product::truncate();
        // Product::factory()->times(30)->create();
        DB::disableQueryLog();
        DB::table('products')->truncate();
        $dataFile = base_path('database/seeders/products.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                'product_code' => $datas[$row][0],
                'product_name' => $datas[$row][1],
                'producer' => $datas[$row][2],
                'product_type' => $datas[$row][3],
                'size' => $datas[$row][4],
                'material' => $datas[$row][5],
                'color' => $datas[$row][6],
                'surface' => $datas[$row][7],
                'uses_for' => $datas[$row][8],
                'import_price' => $datas[$row][9],
                'sale_price' => $datas[$row][10],
                'type_code' => $datas[$row][11],
                'combo' => $datas[$row][12],
                'status' => 'active',
                'quantity' => 50,
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                Product::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            Product::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
