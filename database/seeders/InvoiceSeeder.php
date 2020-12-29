<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('invoices')->truncate();
        $dataFile = base_path('database/seeders/invoice.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                // 'id' => $datas[$row][0],
                'invoice_code' => $datas[$row][1],
                // 'invoice_type' => $datas[$row][2],
                'staff_sale' => $datas[$row][2],
                'introduce_staff' => $datas[$row][3],
                'customer_name' => $datas[$row][4],
                'customer_phone' => $datas[$row][5],
                'total_cost' => $datas[$row][6],
                'preferential' => $datas[$row][7],
                'last_cost' => $datas[$row][8],
                'sales_channel' => $datas[$row][9],
                'created_at' => Carbon::createFromFormat('Y/m/d', $datas[$row][10])->format('Y-m-d H:i:s'),

            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                Invoice::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            Invoice::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
