<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\absensiImport;
use Maatwebsite\Excel\Facades\Excel;

class absensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = Absensi::with('RelasiAbsen')->has('RelasiAbsen')->get();
                
        return view('index-absensi', compact('rows'));

        // $data['title'] = 'Data Absensi';
        // $data['q'] = $request->q;
        // $data['rows'] = Absensi::where('NIK', 'like', '%' . $request->q . '%')->get();
        // return view('index-absensi',$data);

        // $rows = Absensi::all();
        // return view('index-absensi', compact('rows'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
       $rows= Absensi::join('karyawan','absensi.NIK', '=', 'karyawan.NIK')
        ->where('karyawan.nama_karyawan','like',"%".$cari."%")->get('absensi.*');
        // $rows = DB::table('karyawan')
		// ->where('nama_karyawan','like',"%".$cari."%")->get();
        
        return view('index-absensi', compact('rows'));
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
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }

    public function importExcel(Request $request){
        $data = $request->file('file');

        $namafile= rand().$data->getClientOriginalName();
        $data->move('AbsensiData',$namafile); //masukin hasil import ke dalam folder absensidata

        Excel::import(new absensiImport, \public_path('/AbsensiData/'. $namafile) );

        // return \redirect()->back();
         return redirect('absensi')->with('Success','Data Absensi Berhasil Di Import');

    }
    public function inboxFilter(Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');

        $rows = Absensi::whereYear('tanggal_absensi','=', $year)->whereMonth('tanggal_absensi','=',$month)->get();

        return view('index-absensi',compact('rows'));
    }
}
