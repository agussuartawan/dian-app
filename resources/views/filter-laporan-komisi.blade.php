@extends('layout.master')
@section('nama-form', 'Laporan Komisi')
@section('content')


    <div class="row">
        <form method="GET" action="{{ route('laporankomisi') }}" target="_blank">
            <div class="form-group mb-2">
                <label for="max" class="col-sm-2 col-form-label">Dari</label>
                <input type="date" class="datepicker-here form-control" autocomplete="off" data-language="en"
                    data-date-format="yyyy-mm-dd" name="from" id="from" class="form-control" />
            </div>
            <div class="form-group mb-2">
                <label for="max" class="col-sm-2 col-form-label">Sampai</label>
                <input type="date" class="datepicker-here form-control" autocomplete="off" data-language="en"
                    data-date-format="yyyy-mm-dd" name="to" id="to" class="form-control" />
            </div>
            <button id="btn-seleksi" type="submit" class="btn btn-success">Filter</button>
    </div>
    </div>
    </form>
    </div>

@endsection
