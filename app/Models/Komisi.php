<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi extends Model
{
    use HasFactory;
    protected $table = 'komisi';
    protected $primaryKey = 'id_komisi';

    protected $fillable = [
       
        'NIK',
        'bulan_penjualan',
        'tanggal_komisi', 
        'total_kt_wine',
        'total_kt_spirit',
        'total_penjualan',
        'total_komisi',

    ];

    public function relasiKaryawan()
    {
      
        return $this->belongsTo(Karyawan::class, 'NIK', 'NIK');

    }

    public function relasiTransaksi()
    {
      
        return $this->belongsTo(Transaksi::class, 'nama_customer', 'nama_customer');

    }
}
