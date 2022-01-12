<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\absensiImport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//route untuk login
Route::get('login', [App\Http\Controllers\loginController::class, 'index'])->name('indexlogin');
Route::post('login', [\App\Http\Controllers\loginController::class , 'authenticate'])->name('login');

Route::get('logout', [App\Http\Controllers\loginController::class, 'logout'])->name('logout');

//route untuk dashboard



//route untuk middleware selain admin tidak bisa melihat route yang ada di dalam ini
Route::group(['middleware' => 'auth'],function(){
    
        //khusus untuk route admin
    Route::group(['middleware' => ['cek_login:superadmin,user,accounting,admin,gudang,sales']],function(){
        Route::get('dashboard',[App\Http\Controllers\dashboardController::class,'index'])->name('dashboard.index');
       
        Route::get('fill',[App\Http\Controllers\dashboardController::class,'store'])->name('dashboardpenjualan');
       
         Route::get('fillkar',[App\Http\Controllers\dashboardController::class,'storekar'])->name('dashboardkar');

        Route::get('filter-laporan-penggajian', [\App\Http\Controllers\laporanController::class, 'index'])->name('filter-laporan-gaji');
        
        Route::get('filter-laporan-komisi', [\App\Http\Controllers\laporanController::class, 'indexKom'])->name('filter-laporan-komisi');
        Route::get('laporan-slip-gaji', [\App\Http\Controllers\laporanController::class, 'LaporanSlipGaji'])->name('laporan-slip-gaji');
        Route::get('laporan-slip-komisi', [\App\Http\Controllers\laporanController::class, 'LaporanSlipKomisi'])->name('laporan-slip-komisi');
        Route::get('laporan-penggajian', [\App\Http\Controllers\laporanController::class, 'laporanPenggajian'])->name('laporanGaji');
        Route::get('laporan-komisi', [\App\Http\Controllers\laporanController::class, 'laporanKomisi'])->name('laporankomisi');

         Route::get('index-slip-gaji-pribadi', [\App\Http\Controllers\penggajianController::class, 'indexSlipGajiPribadi'])->name('index-slip-gaji-pribadii');
        Route::get('index-slip-komisi-pribadi', [\App\Http\Controllers\komisiController::class, 'indexSlipKomisiPribadi'])->name('index-slip-komisi-pribadii');


         //route untuk dashboard sales
         Route::get('dashboardsales',[App\Http\Controllers\dashboardController::class,'indexsales'])->name('dashboardsales.index');
         Route::get('fillsales',[App\Http\Controllers\dashboardController::class,'storeSales'])->name('dashboardpenjualansales');
       
          //route untuk dashboard karyawan
         Route::get('dashboardkar',[App\Http\Controllers\dashboardController::class,'indexkaryawan'])->name('dashboardkar.index');
         Route::get('fillkarya',[App\Http\Controllers\dashboardController::class,'storeKaryawan'])->name('dashboardpenjualankaryawan');
       

        
    });

        Route::group(['middleware' => ['cek_login:superadmin']],function(){
        Route::get('user', [\App\Http\Controllers\UserController::class, 'index']);
        Route::resource('user', \App\Http\Controllers\UserController::class);
    });
    
       

        //route untuk absensi
        Route::get('filter', [\App\Http\Controllers\absensiController::class , 'inboxFilter'])->name('filter');
        Route::post('importAbsensi', [\App\Http\Controllers\absensiController::class , 'importExcel'])->name('import_absensi');
        Route::resource('absensi',\App\Http\Controllers\absensiController::class);
        Route::get('cariabsensi', [\App\Http\Controllers\absensiController::class, 'cari'])->name('cariabsensi');
     

        //route untuk transaksi
        Route::post('importTransaksi', [\App\Http\Controllers\transaksiController::class , 'importExcel'])->name('import_transaksi');
        Route::resource('transaksi',\App\Http\Controllers\transaksiController::class);
        Route::get('filltrans', [\App\Http\Controllers\transaksiController::class, 'fetch_data'])->name('filltrans');
        Route::get('caritrans', [\App\Http\Controllers\transaksiController::class, 'cari'])->name('caritrans');
    
        Route::get('edit_range', [\App\Http\Controllers\penggajianController::class, 'edit_range'])->name('penggajian.edit_range');
        Route::put('update_gaji', [\App\Http\Controllers\penggajianController::class, 'update_gaji'])->name('penggajian.update_gaji');
        Route::get('editbyone/{penggajian}', [\App\Http\Controllers\penggajianController::class, 'editbyone'])->name('penggajian.editbyone');
        Route::put('updatebyone/{penggajian}', [\App\Http\Controllers\penggajianController::class, 'updatebyone'])->name('penggajian.updatebyone');
        Route::resource('penggajian', App\Http\Controllers\penggajianController::class);
        Route::get('daterange', [\App\Http\Controllers\penggajianController::class, 'fetch_data'])->name('daterange');
     
         Route::get('daterangegajipribadi', [\App\Http\Controllers\penggajianController::class, 'fetch_data_pribadi'])->name('daterangepenggajianpribadi');
        Route::get('indexprint/{penggajian}', [\App\Http\Controllers\penggajianController::class, 'indexprintbyonegaji'])->name('printbyonegaji');


        Route::resource('karyawan', App\Http\Controllers\karyawanController::class);

        Route::resource('komisi', App\Http\Controllers\komisiController::class);
        Route::get('daterangee', [\App\Http\Controllers\komisiController::class, 'fetch_data'])->name('daterangee');
        Route::get('indexprints/{komisi}', [\App\Http\Controllers\komisiController::class, 'indexprintbyonekomisi'])->name('printbyonekomisi');
});







// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
