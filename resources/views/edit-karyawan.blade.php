@extends('layout.master')
@section('nama-form', 'Edit Data Karyawan')
@section('content')

    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <form action="{{ route('karyawan.update', $row) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>NIK <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="NIK" value="{{ old('NIK', $row->NIK) }}" />
                </div>
                <div class="form-group">
                    <label>Nama Karyawan <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="nama_karyawan"
                        value="{{ old('nama_karywan', $row->nama_karyawan) }}" />
                </div>
                <div class="form-group">
                    <label>No KTP <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="KTP" value="{{ old('KTP', $row->KTP) }}" />
                </div>
                <div class="form-group">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="alamat" value="{{ old('alamat', $row->alamat) }}" />
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-control" name="jenis_kelamin">
                        @foreach ($jenis as $key => $val)
                            @if ($key == old('janis_kelamin', $row->jenis_kelamin))
                                <option value="{{ $key }}" selected>{{ $val }}</option>
                            @else
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Telephone <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="telephone"
                        value="{{ old('telephone', $row->telephone) }}" />
                </div>
                <div class="form-group">
                    <label>Gaji Pokok <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="gaji_pokok"
                        value="{{ old('gaji_pokok', $row->gaji_pokok) }}" />
                </div>
                <div class="form-group">
                    <label>Divisi <span class="text-danger">*</span></label>
                    <select class="form-control" name="divisi">
                        @foreach ($divisi as $key => $val)
                            @if ($key == old('divisi', $row->divisi))
                                <option value="{{ $key }}" selected>{{ $val }}</option>
                            @else
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Edit</button>
                    <a class="btn btn-danger" href="{{ route('user.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>

@endsection
