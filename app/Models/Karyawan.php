<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'id_karyawan',
        'id_user',
        'nama_karyawan',
        'KTP',
        'alamat',
        'jenis_kelamin',
        'no_ktp',
        'telephone',
        'gaji_pokok',
        'divisi',
    
    ];

    public function relasiUser()
    {
      
        return $this->belongsTo(User::class);

    }
}
