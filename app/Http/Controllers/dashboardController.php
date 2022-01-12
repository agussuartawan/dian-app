<?php

use App\Charts\dashboardChart;
namespace App\Http\Controllers;
use App\Models\Penggajian;
use App\Models\Transaksi;
use App\Models\Karyawan;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        $karyawan=Karyawan::where('divisi','sales')->get();
      
        $categories=[];
        $allcate=[];
        $tglsekarang = date('m');
        foreach($karyawan as  $k){
            $transaksi= Transaksi::where('sales',$k->nama_karyawan)->whereMonth('tgl_penjualan',$tglsekarang)->orderBy('tgl_penjualan', 'asc')->get();
            foreach($transaksi as  $t){
                $date = strtotime($t->tgl_penjualan);
                $day = intval(date('d', $date));
                if($day >= 1 && $day <= 7){
                    $allcate[0] = $t->total_penjualan;
                } elseif ($day >= 8 && $day <= 15){
                    $allcate[1]= $t->total_penjualan;
                } elseif ($day >= 16 && $day <= 22){
                    $allcate[2]= $t->total_penjualan;
                } elseif ($day >= 23 && $day <= 31){
                    $allcate[3]= $t->total_penjualan;
                }
            }
            // dd($allcate);
            $categories[] = [
                'name'=>$k->nama_karyawan,
                'data'=> $allcate
            ];   
        } 

        $kar=Karyawan::all();
        $categori=[];
        $categori_hari=[];

        foreach($kar as $k){
            $categori[]=$k->nama_karyawan;
            
            $penggajian = Penggajian::where('NIK',$k->NIK)->first();
            // dd($penggajian->hari_kerja);
            if($penggajian){
                $categori_hari[] = $penggajian->hari_kerja;        
            } else {
                $categori_hari[] = 0;   
            }

        }

        
        // $kategori[] = [
        //     'name'=>'eko',
        //     'data'=> [3000000, 2000000, 500000, 5000000]
           
        // ];
        // $kategori[] = [
        //     'name'=>'andar',
        //     'data'=> [3000000, 2000000, 500000, 5000000]
           
        // ];
        // return response()->json($categories);
        return view('dashboard',['categories'=>$categories,'karyawan'=>$karyawan,'categori'=>$categori, 'categori_hari' => $categori_hari]);
      
    }

     public function indexsales(Request $request)
    {      
        $karyawan=Karyawan::where('divisi','sales')->get();
      
        $categories=[];
        $allcate=[];
        $tglsekarang = date('m');
        foreach($karyawan as  $k){
            $transaksi= Transaksi::where('sales',$k->nama_karyawan)->whereMonth('tgl_penjualan',$tglsekarang)->orderBy('tgl_penjualan', 'asc')->get();
            foreach($transaksi as  $t){
                $date = strtotime($t->tgl_penjualan);
                $day = intval(date('d', $date));
                if($day >= 1 && $day <= 7){
                    $allcate[0] = $t->total_penjualan;
                } elseif ($day >= 8 && $day <= 15){
                    $allcate[1]= $t->total_penjualan;
                } elseif ($day >= 16 && $day <= 22){
                    $allcate[2]= $t->total_penjualan;
                } elseif ($day >= 23 && $day <= 31){
                    $allcate[3]= $t->total_penjualan;
                }
            }
            // dd($allcate);
            $categories[] = [
                'name'=>$k->nama_karyawan,
                'data'=> $allcate
            ];   
        } 

        // $kar=Karyawan::all();
        // $categori=[];
        // $categori_hari=[];

        // foreach($kar as $k){
        //     $categori[]=$k->nama_karyawan;
            
        //     $penggajian = Penggajian::where('NIK',$k->NIK)->first();
        //     // dd($penggajian->hari_kerja);
        //     if($penggajian){
        //         $categori_hari[] = $penggajian->hari_kerja;        
        //     } else {
        //         $categori_hari[] = 0;   
        //     }

        // }

        
        
        return view('dashboard-sales',['categories'=>$categories,'karyawan'=>$karyawan]);
      
    }

     public function indexkaryawan(Request $request)
    {      
        $karyawan=Karyawan::where('divisi','sales')->get();
      
        $categories=[];
        $allcate=[];
        $tglsekarang = date('m');
        foreach($karyawan as  $k){
            $transaksi= Transaksi::where('sales',$k->nama_karyawan)->whereMonth('tgl_penjualan',$tglsekarang)->orderBy('tgl_penjualan', 'asc')->get();
            foreach($transaksi as  $t){
                $date = strtotime($t->tgl_penjualan);
                $day = intval(date('d', $date));
                if($day >= 1 && $day <= 7){
                    $allcate[0] = $t->total_penjualan;
                } elseif ($day >= 8 && $day <= 15){
                    $allcate[1]= $t->total_penjualan;
                } elseif ($day >= 16 && $day <= 22){
                    $allcate[2]= $t->total_penjualan;
                } elseif ($day >= 23 && $day <= 31){
                    $allcate[3]= $t->total_penjualan;
                }
            }
            // dd($allcate);
            $categories[] = [
                'name'=>$k->nama_karyawan,
                'data'=> $allcate
            ];   
        } 

        $kar=Karyawan::all();
        $categori=[];
        $categori_hari=[];

        foreach($kar as $k){
            $categori[]=$k->nama_karyawan;
            
            $penggajian = Penggajian::where('NIK',$k->NIK)->first();
            // dd($penggajian->hari_kerja);
            if($penggajian){
                $categori_hari[] = $penggajian->hari_kerja;        
            } else {
                $categori_hari[] = 0;   
            }

        }

        
       
        return view('dashboard-karyawan',['categories'=>$categories,'karyawan'=>$karyawan,'categori'=>$categori, 'categori_hari' => $categori_hari]);
      
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
        $month = $request->get('month');
        $sales =$request->get('sales');

        $karyawan=Karyawan::where('divisi','sales')->get();
     
         $categories=[];
        $allcate=[];


       
               $transaksi= Transaksi::whereMonth('tgl_penjualan',$month)
                  ->where('sales',$sales)->orderBy('tgl_penjualan', 'asc')->get();
            if(count($transaksi)> 0){
                foreach($transaksi as $t){
                    $date = strtotime($t->tgl_penjualan);
                    $day = intval(date('d', $date));
                    if($day >= 1 && $day <= 7){
                        $allcate[0]= $t->total_penjualan;
                    } elseif ($day >= 8 && $day <= 15){
                        $allcate[1]= $t->total_penjualan;
                    } elseif ($day >= 16 && $day <= 22){
                        $allcate[2]= $t->total_penjualan;
                    }elseif ($day >= 23 && $day <= 31){
                        $allcate[3]= $t->total_penjualan;
                    }
                }
            }

            $categories[] = [
                'name'=>$sales,
                'data'=> $allcate
            ]; 
        
       

        return view('grafik-penjualan',['categories'=>$categories,'karyawan'=>$karyawan]);
    }

     public function storeSales(Request $request)
    {
        $month = $request->get('month');
        $sales =$request->get('sales');

        $karyawan=Karyawan::where('divisi','sales')->get();
     
         $categories=[];
        $allcate=[];


       
               $transaksi= Transaksi::whereMonth('tgl_penjualan',$month)
                  ->where('sales',$sales)->orderBy('tgl_penjualan', 'asc')->get();
            if(count($transaksi)> 0){
                foreach($transaksi as $t){
                    $date = strtotime($t->tgl_penjualan);
                    $day = intval(date('d', $date));
                    if($day >= 1 && $day <= 7){
                        $allcate[0]= $t->total_penjualan;
                    } elseif ($day >= 8 && $day <= 15){
                        $allcate[1]= $t->total_penjualan;
                    } elseif ($day >= 16 && $day <= 22){
                        $allcate[2]= $t->total_penjualan;
                    }elseif ($day >= 23 && $day <= 31){
                        $allcate[3]= $t->total_penjualan;
                    }
                }
            }

            $categories[] = [
                'name'=>$sales,
                'data'=> $allcate
            ]; 
        
       

        return view('grafik-penjualan',['categories'=>$categories,'karyawan'=>$karyawan]);
    }

    public function storekar(Request $request)
    {
         $month = $request->get('month');
         

        $kar=Karyawan::all();
        $categori=[];
    
        $categori_hari=[];

        foreach($kar as $k){
            $categori[]=$k->nama_karyawan;
        
            
            $filter = Absensi::where('NIK',$k->NIK)->whereMonth('tanggal_absensi',$month)->count();

            // dd($penggajian->hari_kerja);
            if($filter){
                $categori_hari[] = $filter;     
            } else {
                $categori_hari[] = 0;   
            }


        }
          return view('grafik-karyawan',['categori'=>$categori,'categori_hari'=>$categori_hari]);
    }

    public function storeKaryawan(Request $request)
    {
         $month = $request->get('month');
         

        $kar=Karyawan::all();
        $categori=[];
    
        $categori_hari=[];

        foreach($kar as $k){
            $categori[]=$k->nama_karyawan;
        
            
            $filter = Absensi::where('NIK',$k->NIK)->whereMonth('tanggal_absensi',$month)->count();

            // dd($penggajian->hari_kerja);
            if($filter){
                $categori_hari[] = $filter;     
            } else {
                $categori_hari[] = 0;   
            }


        }
          return view('grafik-karyawan',['categori'=>$categori,'categori_hari'=>$categori_hari]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
