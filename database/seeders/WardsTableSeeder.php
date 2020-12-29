<?php

namespace Database\Seeders;

use App\Models\Ward;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class WardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('wards')->truncate();
        $dataFile = base_path('database/seeders/wards.csv');
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
                'district_id' => $datas[$row][4],
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                Ward::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            Ward::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
