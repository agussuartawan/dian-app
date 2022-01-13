<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Komisi;
use App\Models\Penggajian;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Data Karyawan';
        $data['q'] = $request->q;
        $data['rows'] = Karyawan::where('nama_karyawan', 'like', '%' . $request->q . '%')->get();
        return view('index-karyawan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-karyawan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIK' => 'required',
            'nama_karyawan' => 'required',
            'KTP' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            
            'telephone' => 'required',
            'gaji_pokok' => 'required',
            'divisi' => 'required',

        ]);
         
        if($request->divisi=='admin'){
            $level='admin';
        }
        elseif($request->divisi=='accounting'){
            $level='accounting';
        }
        elseif($request->divisi=='gudang'){
            $level='gudang';
        }
        elseif($request->divisi=='sales'){
            $level='sales';
        }
        $user=User::create([
            'username'=>$request->nama_karyawan,
            'password'=> bcrypt('user'),
            'level' => $level,      
        ]);

        $karyawan = new Karyawan();
        $karyawan->id_user=$user->id_user;
        $karyawan->NIK=$request->NIK;
        $karyawan->nama_karyawan=$request->nama_karyawan;
        $karyawan->KTP=$request->KTP;
        $karyawan->alamat=$request->alamat;
        $karyawan->jenis_kelamin=$request->jenis_kelamin;
        $karyawan->telephone=$request->telephone;
        $karyawan->gaji_pokok=$request->gaji_pokok;
        $karyawan->divisi=$request->divisi;

        $karyawan->save();

        return redirect('karyawan')->with('success','Tambah data berhasil');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        // $data['row'] = $user;
        // $data['levels'] = ['admin' => 'Admin', 'user' => 'User'];
        // return view('edit-user', $data);
        $data['row'] = $karyawan;
        $data['jenis'] = ['laki-laki'=> 'laki-laki', 'perempuan' => 'perempuan'];
        $data['divisi'] = ['admin'=> 'admin', 'accounting'=> 'accounting', 'gudang'=> 'gudang','sales'=>'sales'];
        return view('edit-karyawan',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {

        $request->validate([
            'NIK' => 'required',
            'nama_karyawan' => 'required',
            'KTP' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telephone' => 'required',
            'gaji_pokok' => 'required',
            'divisi' => 'required',
        ]);

        $karyawan->NIK =$request->NIK;
        $karyawan->nama_karyawan =$request->nama_karyawan;
        $karyawan->KTP =$request->KTP;
        $karyawan->alamat =$request->alamat;
        $karyawan->jenis_kelamin =$request->jenis_kelamin;
        $karyawan->telephone =$request->telephone;
        $karyawan->gaji_pokok =$request->gaji_pokok;
        $karyawan->divisi =$request->divisi;
        $karyawan->save();
        return redirect('karyawan')->with('success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        DB::transaction(function() use ($karyawan) {
            User::where('id_user', $karyawan->id_user)->delete();
            Absensi::where('NIK', $karyawan->NIK)->delete();
            Komisi::where('NIK', $karyawan->NIK)->delete();
            Penggajian::where('NIK', $karyawan->NIK)->delete();
            
            $karyawan->delete();
        });
        return redirect('karyawan')->with('success', 'Hapus Data Berhasil');
    }
}
