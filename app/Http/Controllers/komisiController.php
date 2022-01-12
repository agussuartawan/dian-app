<?php

namespace App\Http\Controllers;

use App\Models\Komisi;
use App\Models\Karyawan;
use App\Models\Transaksi;
use DateTime;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;

class komisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pasfilter=false;
        $rows = Komisi::all();
        return view('index-komisi', compact('rows','pasfilter'));
    }

    public function indexSlipKomisiPribadi(Request $request)
    {    
        if(Auth::user()->level == 'superadmin'){
            $rows = Komisi::all();
        } elseif (Auth::user()->level == 'admin' || Auth::user()->level == 'accounting' || Auth::user()->level == 'gudang' ||  Auth::user()->level == 'sales') {
            $rows = Komisi::join('karyawan','komisi.NIK', '=', 'karyawan.NIK')
            ->where('karyawan.id_user', Auth::user()->id_user)
            ->get('komisi.*');

            return view('index-slip-komisi-pribadi', compact('rows'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-komisi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $month = $request->get('month');
        $nama_bulan=DateTime::createFromFormat('!m',$month);
        $bulan=$nama_bulan->format('F');
        $year = $request->get('year');
        $sales= Karyawan::where('divisi','sales')->get();
        $id_transaksi=[];

        foreach($sales as $s){
            $transaksi = Transaksi::where('sales',$s->nama_karyawan)
            ->where('status',0)
            ->whereYear('tgl_penjualan','=', $year)
            ->whereMonth('tgl_penjualan','=',$month)->get();
            
            // $spirit=$transaksi->where('kategori_barang','S')->get();
            // $wine=$transaksi->where('kategori_barang','W')->get();
            if(count($transaksi)>=1){
            $spirit = [];
            $wine = [];
            foreach($transaksi as $t){
                if($t->kategori_barang == 'S'){
                    $spirit[] = $t;
                }
                if($t->kategori_barang == 'W'){
                    $wine[] = $t;
                }
                $id_transaksi[]=$t->id_transaksi_penjualan;
            }

            $total_kategorisp=0;
            foreach($spirit as $sp){
                if($sp->total_bayar !=null){
                    $total_kategorisp=$total_kategorisp+$sp->total_penjualan;
                    
                }
            }
            $total_kategoriwn=0;
            foreach($wine as $wn){
                if($wn->total_bayar !=null){
                    $total_kategoriwn=$total_kategoriwn+$wn->total_penjualan;
                }
            }

            $total_penjualan=$total_kategorisp + $total_kategoriwn;

           $total_spirit=$total_kategorisp * 0.02;
           $total_wine=$total_kategoriwn * 0.01;
           $total_komisi=$total_spirit + $total_wine;

           Komisi::create([
            'NIK'=>$s->NIK,
            'bulan_penjualan'=>$bulan,
            'tanggal_komisi'=>now(),
            'total_kt_wine'=>$total_kategoriwn,
            'total_kt_spirit'=>$total_kategorisp,
            'total_penjualan'=>$total_penjualan,
            'total_komisi'=>$total_komisi,
           ]);
        } else{
               return redirect('komisi')->with('Error','Data Komisi Sudah ada / Data Transaksi Penjualan Belum ada');
               }
        }
        
    Transaksi::whereIn('id_transaksi_penjualan',$id_transaksi)
        ->update(['status'=>1]);

        
        return redirect('komisi')->with('Succes','Data Komisi Berhasil Diproses');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komisi  $komisi
     * @return \Illuminate\Http\Response
     */
    public function show(Komisi $komisi)
    {
        return view('modal-komisi',['komisi'=>$komisi]) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komisi  $komisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Komisi $komisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Komisi  $komisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komisi $komisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komisi  $komisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Komisi $komisi)
    {
        //
    }

    public function fetch_data(Request $request)
    {
        $pasfilter=true;
        $date['fromDate'] = $request->fromDate;
        $date['toDate'] = $request->toDate;
        $rows= Komisi::whereBetween('tanggal_komisi',$date)->orderBy('tanggal_komisi','asc')->get();
      

        return view('index-komisi',compact('rows','pasfilter'));

    }

     public function indexprintbyonekomisi($id )
    {
        $rows= Komisi::where('id_komisi',$id)->first();
      
  
        $pdf = PDF::loadview('slip-komisibyone',['komisi'=>$rows])->setPaper('a5', 'landscape');;
    	return $pdf->stream('slip-komisi.pdf');
    }

}
