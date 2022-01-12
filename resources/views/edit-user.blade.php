@extends('layout.master')
@section('nama-form', 'Edit Data User')
@section('content')


    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <form action="{{ route('user.update', $row) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama User <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="username"
                        value="{{ old('username', $row->username) }}" />
                </div>
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password" />
                    <p class="form-text">Kosongkan jika tidak ingin mengubah password.</p>
                </div>
                <div class="form-group">
                    <label>Level <span class="text-danger">*</span></label>
                    <select class="form-control" name="level">
                        <option value="admin" @if ($row->level == 'admin') selected @endif>Admin</option>
                        <option value="user" @if ($row->level == 'user') selected @endif>User</option>
                        <option value="sales" @if ($row->level == 'sales') selected @endif>Sales</option>
                        <option value="karyawan" @if ($row->level == 'karyawan') selected @endif>Karyawan</option>
                        {{-- @foreach ($levels as $key => $val)
                @if ($key == old('level', $row->level))
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
