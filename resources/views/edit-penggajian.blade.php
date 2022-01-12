@extends('layout.master')
@section('nama-form', 'Edit Penggajian')
@section('content')



    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <form action="{{ route('penggajian.update_gaji') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Uang Makan <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="uang_makan" value="{{ $row->uang_makan }}" />
                </div>

                <div class="form-group">
                    <label>Uang Lembur</label>
                    <input class="form-control" type="text" name="uang_lembur" value="{{ $row->uang_lembur }}" />
                </div>
                <div class="form-group">
                    <label>Komponen Lain</label>
                    <input class="form-control" type="text" name="komponen" value="{{ $row->komponen }}" />


                    <select class="form-control" style="cursor: pointer; margin-top:1.5em; margin-bottom:1.5em" name="ket"
                        id="tag_select">
                        <option value="0" selected disabled>Pilih Keterangan</option>
                        <option value="thr" @if ($row->keterangan == 'thr') selected @endif>THR
                        </option>
                        <option value="tunjangan" @if ($row->keterangan == 'tunjangan') selected @endif>Tunjangan</option>
                    </select>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" name="bulan_gaji" id="bulan_gaji" value="{{ $row->bulan_gaji }}" hidden>
                </div>



                <div class="form-group">
                    <button class="btn btn-success">Ubah Gaji</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('after-script')

@endpush
