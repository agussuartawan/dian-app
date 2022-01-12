<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;
    protected $table = 'penggajian';
    protected $primaryKey = 'id_penggajian';

    protected $fillable = [
        'NIK',
        'uang_makan',
        'uang_lembur',
        'hari_kerja',
        'tanggal_penggajian',
        'komponen',
        'keterangan',
        'bulan_gaji',
        'total_gaji',
       
    
    ];

    public function relasiKaryawan()
    {
      
        return $this->belongsTo(Karyawan::class, 'NIK', 'NIK');

    }    
}
