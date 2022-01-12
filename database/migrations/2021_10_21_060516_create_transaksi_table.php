<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penjualan', function (Blueprint $table) {
            $table->id('id_transaksi_penjualan');
            $table->string('tgl_penjualan');
            $table->string('no_transaksi');
            $table->string('nama_customer');
            $table->string('nama_barang');
            $table->string('qty_barang');
            $table->double('harga');
            $table->double('sub_total');
            $table->double('total_penjualan');
            $table->string('sales');
            $table->string('tgl_bayar')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->double('total_bayar')->nullable();
            $table->string('kategori_barang');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_absensi');
    }
}
