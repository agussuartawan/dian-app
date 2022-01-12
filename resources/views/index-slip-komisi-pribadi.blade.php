@extends('layout.master')
@section('nama-form', 'Laporan Komisi Pribadi')
@section('content')

    <div class="card-header">
        <h5>Cari Tanggal Komisi:</h5>
        <div class="form-inline">
            <div class="form-group mr-1">
                <form method="GET" action="{{ route('daterangee') }}">
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
                    <th>Nama Sales</th>
                    <th>Bulan Penjualan</th>
                    <th>Tanggal Komisi</th>
                    <th>Total Penjualan</th>
                    <th>Total Komisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php $no = 1; ?>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->relasiKaryawan->nama_karyawan }}</td>
                    <td>{{ $row->bulan_penjualan }}</td>
                    <td>{{ $row->tanggal_komisi }} </td>
                    <td>{{ rupiah($row->total_penjualan) }}</td>
                    <td>{{ rupiah($row->total_komisi) }}</td>
                    <td>

                        {{-- <a class="btn btn-sm btn-warning"
                            href="{{ route('komisi.editbyone', $row->id_komisi) }}">Ubah</a> --}}
                        <a class="btn btn-sm btn-primary button-detail" data-toggle="modal" data-target="#exampleModal"
                            href="{{ route('komisi.show', $row->id_komisi) }}">Detail</a>

                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="exampleModal">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Perincian Komisi</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body modal-detail-body">

                                    </div>


                                    </form>
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




        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const from = urlParams.get('fromDate');
        console.log(from);
        const to = urlParams.get('toDate');
        $('#passtgl').click(function(event) {
            event.preventDefault();
            $('#fromDate').val(from);
            $('#toDate').val(to);

            $('#tgl').submit();
        });
    </script>


@endpush
