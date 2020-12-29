<?php

namespace Database\Seeders;

use App\Models\AccumulatePoint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class AccumulatePointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('accumulate_points')->truncate();
        $dataFile = base_path('database/seeders/accumulate_point.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                // 'id' => $datas[$row][0],
                'customer_phone' => $datas[$row][1],
                'name' => $datas[$row][2],
                'point' => $datas[$row][3],
                'rank' => $datas[$row][4],
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                AccumulatePoint::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            AccumulatePoint::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
