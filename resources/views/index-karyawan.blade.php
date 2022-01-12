@extends('layout.master')
@section('nama-form', 'Data Karyawan')
@section('content')


    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <div class="card card-default">
        <div class="card-header">
            <form class="form-inline">
                <div class="form-group mr-1">
                    <input class="form-control" type="text" name="q" value="{{ $q }}"
                        placeholder="Pencarian..." />
                </div>
                <div class="form-group mr-1">
                    <button class="btn btn-success">Cari</button>
                </div>
                <div class="form-group mr-1">
                    <a class="btn btn-primary" href="{{ route('karyawan.create') }}">Tambah</a>
                </div>
            </form>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>No KTP</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Telephone</th>
                        <th>Gaji Pokok</th>
                        <th>Divisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php $no = 1; ?>
                @foreach ($rows as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->NIK }}</td>
                        <td>{{ $row->nama_karyawan }}</td>
                        <td>{{ $row->KTP }}</td>
                        <td>{{ $row->alamat }} </td>
                        <td>{{ $row->jenis_kelamin }}</td>
                        <td>{{ $row->telephone }}</td>
                        <td>{{ rupiah($row->gaji_pokok) }}</td>
                        <td>{{ $row->divisi }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('karyawan.edit', $row) }}">Ubah</a>
                            <form method="POST" action="{{ route('karyawan.destroy', $row) }}"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $('.table').DataTable({
            "dom": 'rtip'
        });
    </script>
@endpush
