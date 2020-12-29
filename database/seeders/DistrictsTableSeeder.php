<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('districts')->truncate();
        $dataFile = base_path('database/seeders/districts.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                'id' => $datas[$row][0],
                'name' => $datas[$row][1],
                'prefix' => $datas[$row][2],
                'province_id' => $datas[$row][3],
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                District::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            District::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
