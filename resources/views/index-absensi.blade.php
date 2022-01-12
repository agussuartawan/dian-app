@extends('layout.master')
@section('nama-form', 'Data Absensi')
@section('content')


    @if (session('Success'))
        <p class="alert alert-success">{{ session('Success') }}</p>
    @endif
    <div class="card card-default">
        <div class="card-header">
            <div class="form-inline">
                <form method="GET" action="{{ route('cariabsensi') }}">
                    <div class="form-group mr-1">
                        <input class="form-control" type="text" name="cari" value="{{ old('cari') }}"
                            placeholder="Pencarian..." />

                        <button class="btn btn-success">Cari</button>
                    </div>
                </form>
                <div class="form-group mr-1">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Import
                    </button>

                    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Import Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('import_absensi') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="file" name="file" required>
                                        </div>
                                        <a href="{{ asset('template/dataAbsenkaryawan.xlsx') }}"> Download template excel</a>
                                    </div>


                                    <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <a class="btn btn-primary" href="{{ route('absensi.index') }}" data-toggle="modal" data-target="#exampleModal">Import</a> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="card-header">
        <h5>Cari Bulan dan Tahun Absensi:</h5>
        <div class="form-inline">
            <div class="form-group mr-1">
                <form method="GET" action="{{ route('filter') }}" id="formFilter">
                    @csrf
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
                                    $min = $year - 60;
                                    $max = $year;
                                    for ($i = $max; $i >= $min; $i--) {
                                        echo '<option value=' . $i . '>' . $i . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <button id="btn-seleksi" type="submit" class="btn btn-success">Filter</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>




    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal Absensi</th>
                    <th>jam Masuk</th>
                    <th>Jam Pulang</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <?php $no = 1; ?>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>@if ($row->RelasiAbsen->nama_karyawan) {{ $row->RelasiAbsen->nama_karyawan }} @else @continue @endif</td>
                    <td> {{ Carbon\Carbon::parse($row->tanggal_absensi)->isoFormat('DD MMMM Y') }} </td>
                    <td>{{ $row->jam_masuk }}</td>
                    <td>{{ $row->jam_pulang }}</td>
                    {{-- <td>
                    <a class="btn btn-sm btn-warning" href="{{ route('absensi.edit', $row) }}">Ubah</a>
                    <form method="POST" action="{{ route('absensi.destroy', $row) }}" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data?')">Hapus</button>
                    </form>
                </td> --}}
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
