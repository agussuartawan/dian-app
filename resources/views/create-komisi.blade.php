@extends('layout.master')
@section('nama-form', 'Pilih Bulan Komisi')
@section('content')


    <div class="row">
        <div class="col-md-8">
            <div class="card-header">
                <div class="form-inline">
                    <div class="form-group mr-1">
                        <form method="POST" action="{{ route('komisi.store') }}" id="formFilter">
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
                                    <div class="d-flex justify-content-center">
                                        <div class="form-inline">
                                            <div class="form-group mb-2">
                                                <button id="btn-seleksi" type="submit" class="btn btn-success">Proses
                                                    Komisi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
