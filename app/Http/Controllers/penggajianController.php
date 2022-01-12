<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penggajian;
use App\Models\Absensi;
use DateTime;
use Illuminate\Support\Carbon;
use PDF;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use DB;

class penggajianController extends Controller
{
    public function index(Request $request)
    {        
        $passfilter=false;
        $ubahfilter=false;
        $rows = Penggajian::with('relasiKaryawan')->has('relasiKaryawan')->get();
        

        return view('index-penggajian', compact('rows','passfilter','ubahfilter'));
    }

    public function indexSlipGajiPribadi(Request $request)
    {    
        if(Auth::user()->level == 'superadmin'){
            $rows = Penggajian::all();
        } elseif (Auth::user()->level == 'admin' || Auth::user()->level == 'accounting' || Auth::user()->level == 'gudang' ||  Auth::user()->level == 'sales') {
            $rows = Penggajian::join('karyawan','penggajian.NIK', '=', 'karyawan.NIK')
            ->where('karyawan.id_user', Auth::user()->id_user)
            ->get('penggajian.*');

            return view('index-slip-gaji-pribadi', compact('rows'));
        }
        
    }

    public function create()
    {
        return view('create-penggajian');
    }

    public function edit_range(Request $request)
    {
       
        $date['dari'] = $request->get('Dari');
        $date['ke'] = $request->get('Ke');
        $row= Penggajian::whereBetween('tanggal_penggajian',$date)->orderBy('tanggal_penggajian','asc')->first();
      
        return view('edit-penggajian',compact('row'));
    }
 

    public function store(Request $request)
    {
        // dd(Carbon::now('PST')->format('Y-m-d H:i:s.uO'));
        $month = $request->get('month');
        $year = $request->get('year');

       $dateObj   = Carbon::createFromFormat('m', $month);
       $monthName = $dateObj->format('F'); 
        $id_absen=[];     

        $karyawan = Karyawan::all();
        $abs = Absensi::where('status',0)->count();
        if ($abs > 0){
            foreach( $karyawan as $k){
                $absen = null;
                $absen = Absensi::where('NIK',$k->NIK)
                ->where('status',0)
                ->whereYear('tanggal_absensi','=', $year)
                ->whereMonth('tanggal_absensi','=',$month)->get();       
             
                
                if(count($absen) > 0){
                    $uang_makan=$request->uang_makan;
                    $komponen=$request->komponen;
                    $ket=$request->ket;
                    $total_makan=$uang_makan * count($absen);

                    $jumlah_lembur=0;

                    foreach($absen as $ab){
                        if($ab->status_lembur=='lembur'){
                            $jumlah_lembur++;
                        
                        }
                        $id_absen[]=$ab->id_absensi;

                    }

                

                    $uang_lembur=$request->get('uang_lembur')*$jumlah_lembur;

                    if($komponen){
                        $total_gaji=$total_makan + $k->gaji_pokok + $uang_lembur+$komponen;
                    }
                    else{

                    $total_gaji=$total_makan + $k->gaji_pokok + $uang_lembur;
                    }

                    Penggajian::create([
                        'NIK'=>$k->NIK,
                        'uang_makan'=>$uang_makan,
                        'uang_lembur'=>$uang_lembur,
                        'hari_kerja'=> count($absen),
                        'tanggal_penggajian'=> Carbon::now('PST')->format('Y-m-d'),
                        'bulan_gaji'=>$monthName,
                        'komponen'=>$komponen,
                        'keterangan'=>$ket,
                        'total_gaji'=>$total_gaji
                    ]);  
                    
                }
            }
            
        } else {
            return redirect('penggajian')->with('Error','Data Gaji Telah Diproses / Data Absen Tidak Ada');
            
        }
        Absensi::whereIn('id_absensi',$id_absen)
        ->update(['status'=>1]);

        return redirect('penggajian')->with('Success','Data Gaji Sudah Diproses');

    }

    public function update_gaji(Request $request)
    {
        $uang_makan=$request->uang_makan;
        $komponen=$request->komponen;
        $ket=$request->ket;
        $gaji_lama = Penggajian::where('bulan_gaji',$request->bulan_gaji)->first();
        $pgj = Penggajian::where('bulan_gaji',$request->bulan_gaji);
        $k_nik = $pgj->get();

        
        $nik = [];
        foreach($k_nik as $k){
            $nik[] = $k->NIK;
        }
        
        $karyawan = Karyawan::whereIn('NIK', $nik)->get();
        $month = $request->get('bulan_gaji');
        
        $pgj->delete();

        foreach($karyawan as $k){
            $absen = Absensi::where('NIK', $k->NIK)->get();   
        
            if(count($absen) > 0){
                $jumlah_absen = 0;
                foreach($absen as $a){
                    if(Carbon::parse($a->tanggal_absensi)->format('F') == $month){
                        $jumlah_absen++;
                    }
                }  

                $total_makan=$uang_makan * $jumlah_absen;

                $jumlah_lembur=0;

                foreach($absen as $ab){
                    if($ab->status_lembur=='lembur'){
                        $jumlah_lembur++;                    
                    }               
                }            

                $uang_lembur=$request->get('uang_lembur')*$jumlah_lembur;

                if($komponen){
                    $total_gaji=$total_makan + $k->gaji_pokok + $uang_lembur+$komponen;
                } else {
                    $total_gaji=$total_makan + $k->gaji_pokok + $uang_lembur;
                }

                Penggajian::create([
                    'NIK'=>$k->NIK,
                    'uang_makan'=>$uang_makan,
                    'uang_lembur'=>$uang_lembur,
                    'hari_kerja'=> $jumlah_absen,
                    'tanggal_penggajian'=>$gaji_lama->tanggal_penggajian,
                    'bulan_gaji'=>$month,
                    'komponen'=>$komponen,
                    'keterangan'=>$ket,
                    'total_gaji'=>$total_gaji
                ]);                  
            }             
        }
        return redirect('penggajian')->with('Success','Data Gaji Berhasil Diedit');
    }

   
    public function fetch_data(Request $request)
    {
        $passfilter=true;
        $ubahfilter=true;
        $date['fromDate'] = $request->fromDate;
        $date['toDate'] = $request->toDate;
        $rows= Penggajian::whereBetween('tanggal_penggajian',$date)->orderBy('tanggal_penggajian','asc')->get();
      

        return view('index-penggajian',compact('rows','passfilter','ubahfilter'));
    }

  

    public function show(Penggajian $penggajian)
    {
        return view('modal-penggajian',['penggajian'=>$penggajian]) ;
    }

   
    public function editbyone(Penggajian $penggajian)
    {
       
      
        return view('edit-penggajianbyone',['row'=>$penggajian]);
    }

    public function updatebyone(Request $request, Penggajian $penggajian)
    {
        $gaji= $penggajian;
        $penggajian->delete();
        $k = Karyawan::where('NIK', $gaji->NIK)->first();
        $absen = Absensi::where('NIK', $gaji->NIK)->get();
        if(count($absen) > 0){
                $uang_makan=$request->uang_makan;
                $komponen=$request->komponen;
                $ket=$request->ket;
                $total_makan=$uang_makan * count($absen);

                $jumlah_lembur=0;

                foreach($absen as $ab){
                    if($ab->status_lembur=='lembur'){
                        $jumlah_lembur++;
                    
                    }               
                }            

                $uang_lembur=$request->get('uang_lembur')*$jumlah_lembur;

                if($komponen){
                    $total_gaji=$total_makan + $k->gaji_pokok + $uang_lembur+$komponen;
                } else {
                    $total_gaji=$total_makan + $k->gaji_pokok + $uang_lembur;
                }

                Penggajian::create([
                    'NIK'=>$k->NIK,
                    'uang_makan'=>$uang_makan,
                    'uang_lembur'=>$uang_lembur,
                    'hari_kerja'=> count($absen),
                    'tanggal_penggajian'=>$gaji->tanggal_penggajian,
                    'bulan_gaji'=>$gaji->bulan_gaji,
                    'komponen'=>$komponen,
                    'keterangan'=>$ket,
                    'total_gaji'=>$total_gaji
                ]);                  
            } 
        return redirect('penggajian')->with('Success','Data Gaji Berhasil Diedit');
    }

    public function indexprintbyonegaji($id )
    {
        $rows= Penggajian::where('id_penggajian',$id)->first();
  
        $pdf = PDF::loadview('slip-penggajianbyone',['penggajian'=>$rows])->setPaper('a5', 'landscape');;
    	return $pdf->stream('slip-penggajian.pdf');
    }
}

