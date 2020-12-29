<?php

namespace Database\Seeders;

use App\Models\SalaryDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class SalaryDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('salary_details')->truncate();
        $dataFile = base_path('database/seeders/salary_details.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                'id' => $datas[$row][0],
                'admin_id' => $datas[$row][1],
                'staff_name' => $datas[$row][2],
                'basic_salary' => $datas[$row][3],
                'salary_type' => $datas[$row][4],
                'commission' => $datas[$row][5],
                'allowance' => $datas[$row][6],
                'workdays' => $datas[$row][7],
                'amercement' => $datas[$row][8],
                'advance_money' => $datas[$row][9],
                'insurrance' => $datas[$row][10],
                'last_salary' => $datas[$row][11],
                'salary_code' => $datas[$row][12],
                'created_at' => now(),
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                SalaryDetail::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            SalaryDetail::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
