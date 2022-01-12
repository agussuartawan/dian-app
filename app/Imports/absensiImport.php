<?php

namespace App\Imports;

use App\Models\Absensi;
use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;

class absensiImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int{
        return 2; //ini buat ngambil baris yang ketiga diexcel biar gak masuk headernya
    }
    public function model(array $row)
    {
        $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]));
        // $time = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\TimeZone::excelToDateTimeObject($row[4]));

        

        if (!$row[1]==null)
         DB::table('absensi')->updateOrInsert([            
            // 'id_absensi' => $row[0],
            'NIK' => $row[0],
            'jam_masuk' => $row[1],
            'jam_pulang' => $row[2],
            'tanggal_absensi' => $date,
            'status_lembur' => $row[4]
        ]);

       
    }
}




//    if (!$row[1]==null)
//          Absensi::create([            
//             // 'id_absensi' => $row[0],
//             'NIK' => $row[0],
//             'jam_masuk' => $row[1],
//             'jam_pulang' => $row[2],
//             'tanggal_absensi' => $date,
//             'status_lembur' => $row[4]
//         ]);