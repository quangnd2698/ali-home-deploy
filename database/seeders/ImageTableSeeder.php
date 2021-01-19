<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Models\Image;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
    *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('images')->truncate();
        $dataFile = base_path('database/seeders/images.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                'product_code' => $datas[$row][0],
                'name' => $datas[$row][1] . '.jpg',
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                Image::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            Image::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
