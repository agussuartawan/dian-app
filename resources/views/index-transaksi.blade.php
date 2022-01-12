@extends('layout.master')
@section('nama-form', 'Data Transaksi Penjualan')
@section('content')


    @if (session('Success'))
        <p class="alert alert-success">{{ session('Success') }}</p>
    @endif
    <div class="card card-default">
        <div class="card-header">
            <div class="form-inline">
                <form method="GET" action="{{ route('caritrans') }}">
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
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('import_transaksi') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="file" name="file" required>
                                        </div>
                                    </div>


                                    <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-header">
        <h5>Cari Tanggal Transaksi Penjualan:</h5>
        <div class="form-inline">
            <div class="form-group mr-1">
                <form method="GET" action="{{ route('filltrans') }}">
                    <div class="d-flex justify-content-center">
                        <div class="form-inline">
                            <div class="form-group mb-2">
                                <label for="max" class="col-sm-2 col-form-label">Dari</label>
                                <input type="date" class="datepicker-here form-control" autocomplete="off"
                                    data-language="en" data-date-format="yyyy-mm-dd" name="fromDate" id="from"
                                    class="form-control" />
                            </div>
                            <div class="form-group mb-2">
                                <label for="max" class="col-sm-2 col-form-label">Sampai</label>
                                <input type="date" class="datepicker-here form-control" autocomplete="off"
                                    data-language="en" data-date-format="yyyy-mm-dd" name="toDate" id="to"
                                    class="form-control" />
                            </div>
                            <button id="btn-seleksi" type="submit" class="btn btn-success">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="card-body p-0 table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Penjualan</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Customer</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        <th>Total Penjualan</th>
                        <th>Sales</th>
                        <th>Tanggal Bayar</th>
                        <th>Bukti Bayar</th>
                        <th>Total Bayar</th>
                        <th>Kategori</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <?php $no = 1; ?>
                @foreach ($rows as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ Carbon\Carbon::parse($row->tgl_penjualan)->isoFormat('DD MMMM Y') }}</td>
                        <td>{{ $row->no_transaksi }}</td>
                        <td>{{ $row->nama_customer }}</td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>{{ $row->qty_barang }}</td>
                        <td>{{ rupiah($row->harga) }}</td>
                        <td>{{ rupiah($row->sub_total) }}</td>
                        <td>{{ rupiah($row->total_penjualan) }}</td>
                        <td>{{ $row->sales }}</td>
                        <td>{{ Carbon\Carbon::parse($row->tgl_bayar)->isoFormat('DD MMMM Y') }}</td>
                        <td>{{ $row->bukti_bayar }}</td>
                        <td>{{ rupiah($row->total_bayar) }} </td>
                        <td>{{ $row->kategori_barang }}</td>
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
