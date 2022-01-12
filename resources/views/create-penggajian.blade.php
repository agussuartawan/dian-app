@extends('layout.master')
@section('nama-form', 'Tambah Komponen Penggajian')
@section('content')



    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <form action="{{ route('penggajian.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Uang Makan <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="uang_makan" />
                </div>

                <div class="form-group">
                    <label>Uang Lembur</label>
                    <input class="form-control" type="text" name="uang_lembur" />
                </div>
                <div class="form-group">
                    <label>Komponen Lain</label>
                    <input class="form-control" type="text" name="komponen" />

                    <select class="form-control" style="cursor: pointer; margin-top:1.5em; margin-bottom:1.5em" name="ket"
                        id="tag_select">
                        <option value="0" selected disabled>Pilih Keterangan</option>
                        <option value="thr">THR</option>
                        <option value="tunjangan">Tunjangan</option>
                    </select>
                </div>

                <div class="card-header">
                    <div class="form-inline">
                        <div class="form-group mr-1">
                            {{-- <form method="GET" action="{{ route('penggajian.store')}}" id="formFilter" >
                        @csrf --}}
                            <div class="d-flex justify-content-center">
                                <div class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="max" class="col-sm-2 col-form-label">Bulan</label>
                                        <select class="form-control"
                                            style="cursor: pointer; margin-top:1.5em; margin-bottom:1.5em" name="month"
                                            id="tag_select">
                                            <option value="0" selected disabled>Pilih Bulan</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April </option>
                                            <option value="05">Mei </option>
                                            <option value="06">Juni </option>
                                            <option value="07">Juli </option>
                                            <option value="08">Agustus </option>
                                            <option value="09">September </option>
                                            <option value="10">Oktober </option>
                                            <option value="11">November </option>
                                            <option value="12">Desember </option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="max" class="col-sm-2 col-form-label">Tahun</label>
                                        <select class="form-control"
                                            style="cursor: pointer; margin-top:1.5em; margin-bottom:1.5em" name="year"
                                            id="tag_select">
                                            <option value="0" selected disabled>Pilih Tahun</option>
                                            <?php
                                            $year = date('Y');
                                            $min = $year - 10;
                                            $max = $year;
                                            for ($i = $max; $i >= $min; $i--) {
                                                echo '<option value=' . $i . '>' . $i . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                    {{-- <button id="btn-seleksi" type="submit" class="btn btn-success">Filter</button> --}}
                                </div>
                            </div>
                            {{-- </form> --}}

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <button class="btn btn-success">Proses Gaji</button>
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
