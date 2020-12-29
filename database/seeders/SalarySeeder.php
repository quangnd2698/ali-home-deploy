<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Carbon\Carbon;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('salaries')->truncate();
        $dataFile = base_path('database/seeders/salaries.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                'id' => $datas[$row][0],
                'salary_code' => $datas[$row][1],
                'total_cost' => $datas[$row][2],
                'month' => $datas[$row][3],
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                Salary::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            Salary::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
