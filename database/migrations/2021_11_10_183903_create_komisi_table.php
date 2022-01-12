<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komisi', function (Blueprint $table) {
            $table->id('id_komisi');
            $table->string('NIK');
            $table->string('bulan_penjualan');  
            $table->date('tanggal_komisi');  
            $table->double('total_kt_wine'); 
            $table->double('total_kt_spirit'); 
            $table->double('total_penjualan'); 
            $table->double('total_komisi'); 
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
        Schema::dropIfExists('komisi');
    }
}
