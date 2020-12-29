<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('provinces')->truncate();
        $dataFile = base_path('database/seeders/provinces.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                'id' => $datas[$row][0],
                'name' => $datas[$row][1],
                'code' => $datas[$row][2],
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                Province::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            Province::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
