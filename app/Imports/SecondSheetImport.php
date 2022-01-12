<?php

namespace App\Imports;

use App\Models\Transaksi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Carbon\Carbon;


class SecondSheetImport implements ToCollection, WithStartRow, WithCalculatedFormulas
{
    public function startRow(): int{
        return 3; //ini buat ngambil baris yang ketiga diexcel biar gak masuk headernya
    }

    public function collection(Collection $rows)
    {
        
        foreach($rows as $row){
            $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]));
            $date2 = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]));

            dump($row);
            if($row[1]){
            Transaksi::create([   
                'tgl_penjualan' => $date,
                'no_transaksi' => $row[1],
                'nama_customer' => $row[2],
                'nama_barang'=> $row[3],
                'qty_barang'=> $row[4],
                'harga'=> $row[5],
                'sub_total'=> $row[6],
                'total_penjualan'=> $row[7],
                'sales'=> $row[8],
                'tgl_bayar'=> $date2,
                'bukti_bayar'=> $row[10],
                'total_bayar'=> $row[11],
                'kategori_barang'=> $row[12]
            ]);     
        }    
        }                                                   

     
    }
}
    

