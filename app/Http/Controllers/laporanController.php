<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penggajian;
use App\Models\Komisi;
use PDF;

class laporanController extends Controller
{
    public function index()
    {
        return view('filter-laporan-penggajian');
    }
    public function indexKom()
    {
        return view('filter-laporan-komisi');
    }
  
     public function indexSlipGajipribadi()
    {
        return view('index-slip-gaji-pribadi');
    }

    public function laporanPenggajian(Request $request)
    {
        $date['from'] = $request->from;
        $date['to'] = $request->to;
        $rows= Penggajian::whereBetween('tanggal_penggajian',$date)->orderBy('tanggal_penggajian','asc')->get();
      
        $pdf = PDF::loadview('laporan-penggajian',['rows'=>$rows, 'date' => $date]);
    	return $pdf->stream('laporan-penggajian.pdf');
    }
    public function laporanKomisi(Request $request)
    {
        $date['from'] = $request->from;
        $date['to'] = $request->to;
        $rows= Komisi::whereBetween('tanggal_komisi',$date)->orderBy('tanggal_komisi','asc')->get();
      
        $pdf = PDF::loadview('laporan-komisi',['rows'=>$rows, 'date' => $date]);
    	return $pdf->stream('laporan-komisi.pdf');
    }

    public function laporanSlipGaji(Request $request)
    {

        $date['from'] = $request->from;
        $date['to'] = $request->to;
        $rows= Penggajian::whereBetween('tanggal_penggajian',$date)->orderBy('tanggal_penggajian','asc')->get();

        $pdf = PDF::loadview('slip-penggajian',['rows'=>$rows, 'date' => $date])->setPaper('a5', 'landscape');;
    	return $pdf->stream('slip-penggajian.pdf');
    }

    public function LaporanSlipKomisi(Request $request)
    {
        $date['from'] = $request->from;
        $date['to'] = $request->to;
        $rows= Komisi::whereBetween('tanggal_komisi',$date)->orderBy('tanggal_komisi','asc')->get();

        $pdf = PDF::loadview('slip-komisi',['rows'=>$rows, 'date' => $date])->setPaper('a5', 'landscape');
    	return $pdf->stream('slip-komisi.pdf');
    }

    
}
