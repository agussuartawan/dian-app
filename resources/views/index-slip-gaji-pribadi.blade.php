@extends('layout.master')
@section('nama-form', 'Laporan Penggajian Pribadi')
@section('content')


    <div class="card-header">
        <h5>Cari Tanggal Penggajian:</h5>
        <div class="form-inline">
            <div class="form-group mr-1">

                <form method="GET" action="{{ route('daterange') }}">
                    <div class="d-flex justify-content-center">
                        <div class="form-inline">
                            <div class="form-group mb-2">
                                <label for="max" class="col-sm-2 col-form-label">Dari</label>
                                <input type="date" class="datepicker-here form-control" autocomplete="off" data-language="en"
                                    data-date-format="yyyy-mm-dd" name="fromDate" id="from" class="form-control" />
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


    </div>


    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Tanggal Penggajian</th>
                    <th>Gaji Bulan</th>
                    <th>Total Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php $no = 1; ?>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->relasiKaryawan->nama_karyawan }}</td>
                    <td> {{ $row->relasiKaryawan->divisi }} </td>
                    <td>{{ Carbon\Carbon::parse($row->tanggal_penggajian)->isoFormat('DD MMMM Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($row->bulan_gaji)->format('F') }}</td>
                    <td>{{ rupiah($row->total_gaji) }}</td>
                    <td>

                        <a class="btn btn-sm btn-primary button-detail" data-toggle="modal" data-target="#exampleModal"
                            href="{{ route('penggajian.show', $row->id_penggajian) }}">Detail</a>

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="exampleModal">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Detail Perincian Gaji</h6>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body modal-detail-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <form method="POST" action="{{ route('penggajian.', $row) }}" style="display: inline-block;"> --}}
                        {{-- @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data?')">Hapus</button>
                    </form> --}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    </div>

@endsection

@push('after-script')
    <script>
        $(document).ready(function() {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const from = urlParams.get('fromDate');
            const to = urlParams.get('toDate');
            $('#dari').val(from);
            $('#ke').val(to);
            $('#fromDate').val(from);
            $('#toDate').val(to);


            //buat modal
            $('.table').DataTable({
                "dom": 'rtip'
            });


            $('body').on('click', '.button-detail', function(event) {
                event.preventDefault();

                var me = $(this),
                    url = me.attr('href'),
                    title = me.attr('title');

                $('.modal-title').text(title);
                $.ajax({
                    url: url,
                    dataType: 'html',
                    success: function(response) {
                        $('.modal-detail-body').html(response);
                    }
                });
                $('#exampleModal').modal('show');
            });
        })
    </script>


@endpush
