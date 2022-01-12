<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Imports\transaksiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class transaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $rows = Transaksi::all();
      
	
        return view('index-transaksi', compact('rows'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $rows = DB::table('transaksi_penjualan')
		->where('nama_customer','like',"%".$cari."%")->get();
        // dd($rows);
        return view('index-transaksi', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function importExcel(Request $request){
        try{
            $data = $request->file('file');

            $namafile= rand().$data->getClientOriginalName();
            $data->move('TransaksiData',$namafile); //masukin hasil import ke dalam folder transaksidata
    
            $import = new transaksiImport;
            $import->onlySheets('ABADI VILLA-EKO','AM MART-EKO','AMALA COLLECTIVE THE PT- EKO','ARTE CANGGU-ANDAR','BACK ROOM CANGGU-EKO','BGC RIVERSIDE BAR-ANDAR','BALI BEACH SHACK-EKO','BALI BEACH GLAMPING-ANDAR','BALI NICE BAR & RESTO-ANDAR');
            

            Excel::import($import, \public_path('/TransaksiData/'. $namafile) );
    
            // return \redirect()->back();
            return redirect('transaksi')->with('Success','Data Absensi Berhasil Di Import');
        }catch(\Exception $e){
            dd($e);
        };
    }

     public function fetch_data(Request $request)
    {
       
        $date['fromDate'] = $request->fromDate;
        $date['toDate'] = $request->toDate;
        $rows= Transaksi::whereBetween('tgl_penjualan',$date)->orderBy('tgl_penjualan','asc')->get();
      

        return view('index-transaksi',compact('rows'));

    }
}
