<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('brands')->truncate();
        $dataFile = base_path('database/seeders/brands.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                'brand_name' => $datas[$row][0],
                'type_product' => $datas[$row][1],
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                Brand::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            Brand::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
