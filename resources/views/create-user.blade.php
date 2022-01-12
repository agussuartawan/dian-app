@extends('layout.master')
@section('nama-form', 'Tambah Data User')
@section('content')


    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Username <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="username" value="{{ old('username') }}" />
                </div>
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password" />
                </div>
                <div class="form-group">
                    <label>Level <span class="text-danger">*</span></label>
                    <select class="form-control" name="level" />
                    <option value="admin" selected>Admin</option>
                    <option value="user" selected>User</option>
                    <option value="sales" selected>Sales</option>
                    <option value="karyawan" selected>Karyawan</option>
                    {{-- @foreach ($levels as $key => $val)
                @if ($key == old('level'))
                <option value="{{ $key }}" selected>{{ $val }}</option>
                @else
                <option value="{{ $key }}">{{ $val }}</option>
                @endif
                @endforeach --}}
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Simpan</button>
                    <a class="btn btn-danger" href="{{ route('user.index') }}">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
