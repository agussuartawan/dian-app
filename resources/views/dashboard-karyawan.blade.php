 @extends('layout.master')
 @section('nama-form', 'Halaman Dashboard Karyawan')
 @section('content')

     <div class="card">
         <div class="card-header">
             <h5>Grafik Kinerja Karyawan</h5>
         </div>



         <div class="form-inline">

             <form method="GET" action="{{ route('dashboardpenjualankaryawan') }}" id="dashkar">

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
