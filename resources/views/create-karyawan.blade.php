@extends('layout.master')
@section('nama-form', 'Tambah Data Karyawan')
@section('content')



    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <form action="{{ route('karyawan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>NIK <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="NIK" />
                </div>

                <div class="form-group">
                    <label>Nama Karyawan <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="nama_karyawan" value="{{ old('nama_karyawan') }}" />
                </div>
                <div class="form-group">
                    <label>No KTP <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="KTP" value="{{ old('KTP') }}" />
                </div>
                <div class="form-group">
                    <label>Telephone </label>
                    <input class="form-control" type="text" name="telephone" />
                </div>
                <div class="form-group">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="alamat" value="{{ old('alamat') }}" />
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-control" type="text" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                        <option selected disabled>--Pilih Jenis Kelamin--</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Gaji Pokok <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="dengan-rupiah" name="gaji_pokok" />
                </div>
                <div class="mb-3">
                    <label>Divisi <span class="text-danger">*</span></label>
                    <select class="form-control" type="text" name="divisi" value="{{ old('divisi') }}">
                        <option selected>--Pilih Divisi--</option>
                        <option value="admin">admin</option>
                        <option value="accounting">accounting</option>
                        <option value="gudang">gudang</option>
                        <option value="sales">sales</option>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Simpan</button>
                    <a class="btn btn-danger" href="{{ route('karyawan.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('after-script')
    {{-- <script>

var dengan_rupiah = document.getElementById('dengan-rupiah');
dengan_rupiah.addEventListener('keyup',
function(e)
{ 
    dengan_rupiah.value=formatRupiah(this.value, 'Rp. ');

});

function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3/gi});

        if (ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !=undefined ? rupiah + ',' + split[1] : rupiah;

        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : ''); --}}
    {{-- } --}}

    {{-- </script> --}}

@endpush
