<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        // 'id_absensi',
        'NIK',
        'jam_masuk',
        'jam_pulang',
        'tanggal_absensi',
        'status_lembur',
        'status'
    
    ];

    public function RelasiAbsen(){
       
        return $this->belongsTo(Karyawan::class, 'NIK', 'NIK');
        // manggil foreign key NIK yang ada di tabel abensi dan manggil NIK yang ada di tabel karyawan;
        
      
    }
}
