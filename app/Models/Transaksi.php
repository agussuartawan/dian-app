<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $table = 'transaksi_penjualan';
    protected $primaryKey = 'id_transaksi_penjualan';

    protected $fillable = [
      'tgl_penjualan',
      'no_transaksi',
      'nama_customer',
      'nama_barang',
      'qty_barang',
      'harga',
      'sub_total',
      'total_penjualan',
      'sales',
      'tgl_bayar',
      'bukti_bayar',
      'total_bayar',
      'kategori_barang',
      'status'

    ];
}
