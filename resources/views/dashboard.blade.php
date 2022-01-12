 @extends('layout.master')
 @section('nama-form', 'Halaman Dashboard')
 @section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                <div class="card-stats-title">Jumlah Karyawan
                    
                </div>
                <div class="card-stats-items">
                    <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $admin }}</div>
                    <div class="card-stats-item-label">Admin</div>
                    </div>
                    <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $akunting }}</div>
                    <div class="card-stats-item-label">Akunting</div>
                    </div>
                    <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $sales }}</div>
                    <div class="card-stats-item-label">Sales</div>
                    </div>
                </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Karyawan</h4>
                </div>
                <div class="card-body">
                    {{ $total_karyawan }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                <div class="card-stats-title">Jumlah Gaji Yang Telah Diproses
                    
                </div>
                <div class="card-stats-items">
                    <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $gaji_admin }}</div>
                    <div class="card-stats-item-label">Admin</div>
                    </div>
                    <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $gaji_akunting }}</div>
                    <div class="card-stats-item-label">Akunting</div>
                    </div>
                    <div class="card-stats-item">
                    <div class="card-stats-item-count">{{ $gaji_sales }}</div>
                    <div class="card-stats-item-label">Sales</div>
                    </div>
                </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Gaji Yang Telah Diproses</h4>
                </div>
                <div class="card-body">
                    {{ $total_gaji }}
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card gradient-bottom">
                <div class="card-header">
                    <h4>Sales Dengan Penjualan Tertinggi</h4>
                </div>
                <div class="card-body" id="top-5-scroll">
                <ul class="list-unstyled list-unstyled-border">
                    @foreach($komisi as $k)
                        <li class="media">
                        <div class="media-body">
                            <div class="media-title">{{ $k->relasiKaryawan->nama_karyawan }}</div>
                            <div class="mt-1">
                            <div class="budget-price">
                                <div class="budget-price-square bg-primary" data-width="{{ round(($k->total_kt_wine / $total_penjualan) * 100) }}%"></div>
                                <div class="budget-price-label">{{ rupiah($k->total_kt_wine) }}</div>
                            </div>
                            <div class="budget-price">
                                <div class="budget-price-square bg-danger" data-width="{{ round(($k->total_kt_spirit / $total_penjualan) * 100) }}%"></div>
                                <div class="budget-price-label">{{ rupiah($k->total_kt_spirit) }}</div>
                            </div>
                            </div>
                        </div>
                        </li>
                    @endforeach
                </div>
                <div class="card-footer pt-3 d-flex justify-content-center">
                <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-primary" data-width="20"></div>
                    <div class="budget-price-label">Wine</div>
                </div>
                <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-danger" data-width="20"></div>
                    <div class="budget-price-label">Spirit</div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card ">
        <div class="card-header">
            <h5>Grafik Penjualan Sales</h5>
        </div>
        <div class="form-inline">

            <form method="GET" action="{{ route('dashboardpenjualan') }}" id="dashpenjualan">

                <div class="form-inline">
                    <div class="form-group mb-2">
                        <label for="max" class="col-sm-2 col-form-label">Bulan</label>
                        <select class="form-control" style="cursor: pointer; margin-top:1.5em; margin-bottom:1.5em"
                            name="month" id="month">
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
                        <label for="max" class="col-sm-2 col-form-label">Sales</label>
                        <select class="form-control" style="cursor: pointer; margin-top:1.5em; margin-bottom:1.5em"
                            name="sales" id="sales">
                            <option value="0" selected disabled>Pilih Sales</option>
                            @foreach ($karyawan as $k)
                                <option value="{{ $k->nama_karyawan }}">{{ $k->nama_karyawan }}</option>

                            @endforeach
                        </select>
                    </div>
                    <button id="btn-seleksi" type="submit" class="btn btn-success">Cari</button>
                </div>
            </form>
        </div>
        <div class="row" id="dsbsales">
            @include('grafik-penjualan')
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h5>Grafik Kinerja Karyawan</h5>
        </div>



        <div class="form-inline">

            <form method="GET" action="{{ route('dashboardkar') }}" id="dashkar">

                <div class="form-inline">
                    <div class="form-group mb-2">
                        <label for="max" class="col-sm-2 col-form-label">Bulan</label>
                        <select class="form-control" style="cursor: pointer; margin-top:1.5em; margin-bottom:1.5em"
                            name="month" id="bulan">
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
                    <button id="btnseleksi" type="submit" class="btn btn-success">Cari</button>
                </div>
            </form>
        </div>

        <div class="row" id="dsbkar">
            @include('grafik-karyawan')
        </div>


    </div>

 @endsection

 @push('after-script')
     <script>
         $('#btn-seleksi').click(function(event) {
             event.preventDefault();
             var me = $('#dashpenjualan'),
                 url = me.attr('action'),
                 month = $('#month').val(),
                 sales = $('#sales').val();

             $.ajax({
                 url: url,
                 method: 'GET',
                 dataType: 'html',
                 data: {
                     month: month,
                     sales: sales
                 },
                 success: function(response) {
                     $('#dsbsales').html(response);
                 }
             });

         });


         $('#btnseleksi').click(function(event) {
             event.preventDefault();
             var me = $('#dashkar'),
                 url = me.attr('action'),
                 month = $('#bulan').val();


             $.ajax({
                 url: url,
                 method: 'GET',
                 dataType: 'html',
                 data: {
                     month: month
                 },
                 success: function(response) {
                     $('#dsbkar').html(response);
                 }
             });

         });
     </script>

 @endpush
