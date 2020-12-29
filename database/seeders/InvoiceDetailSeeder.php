<?php

namespace Database\Seeders;

use App\Models\InvoiceDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Carbon\Carbon;

class InvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        DB::table('invoice_details')->truncate();
        $dataFile = base_path('database/seeders/invoice_detail.csv');
        $reader = new CSV();
        $datas = $reader->load($dataFile)->getActiveSheet()->toArray();
        $insertDatas = [];
        $row = 1;
        $maxCount = count($datas);
        while ($row < $maxCount) {
            array_push($insertDatas, [
                // 'id' => $datas[$row][0],
                'invoice_code' => $datas[$row][1],
                'product_code' => $datas[$row][2],
                'product_name' => $datas[$row][3],
                'quantity_product' => $datas[$row][4],
                'price_product' => $datas[$row][5],
                'total_price' => $datas[$row][6],
                'created_at' => now(),
            ]);

            $row++;

            if (count($insertDatas) === 100) {
                // Insert batch 100 records
                InvoiceDetail::insert($insertDatas);
                $insertDatas = [];
            }
        }

        // Insert remaining records
        if (count($insertDatas)) {
            InvoiceDetail::insert($insertDatas);
        }

        DB::enableQueryLog();
    }
}
