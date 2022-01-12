<h5>PT. TRISNO MITRA BALI</h5>
<div class="row">
    <div class="col-6" style="border: 1px solid black">

        <tr>
            <td>Nama Karyawan :</td>
            <td>{{ $penggajian->relasiKaryawan->nama_karyawan }}</td>
        </tr>
        <br>
        <br>
        <tr>
            <td>Gaji Bulan :</td>
            <td>{{ $penggajian->bulan_gaji }}</td>
        </tr>

    </div>

    <div class="col-6" style="border: 1px solid black">

        <tr>
            <td>Tanggal Penggajian :</td>
            <td>{{ Carbon\Carbon::parse($penggajian->tanggal_penggajian)->isoFormat('DD MMMM Y') }}</td>
        </tr>
        <br>
        <br>
        <tr>
            <td>Divisi :</td>
            <td>{{ $penggajian->relasiKaryawan->divisi }}</td>
        </tr>
    </div>

</div>
</div>
<br>
<h5>Perincian</h5>
<div class="row">
    <div class="col-md-6">
        <tr>
            <td>Gaji Pokok </td>
        </tr>
        <br>
        <tr>
            <td>Uang Makan </td> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <td>{{ $penggajian->hari_kerja }} hari X {{ rupiah($penggajian->uang_makan) }} </td>
        </tr>
        <br>
        <tr>
            <td>Uang Lembur </td>
        </tr>
        <br>
        <tr>
            <td>Komponen Lain </td> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <td>THR/Tunjangan</td>
        </tr>
        <br><br>
        <tr>
            <td>Jumlah Perincian </td>
        </tr>
        <br>
        <tr>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <td>Jumlah Yang dibayarkan </td>
        </tr>
    </div>
    <div class="col-md-3">
        <tr>
            <td>: &emsp; {{ rupiah($penggajian->relasiKaryawan->gaji_pokok) }}</td>
        </tr>
        <br>
        <tr>
            <td>: &emsp; {{ rupiah($penggajian->hari_kerja * $penggajian->uang_makan) }} </td>
        </tr>
        <br>
        <tr>
            <td>: &emsp; @if ($penggajian->uang_lembur == 0)
                    --
                @else
                    {{ rupiah($penggajian->uang_lembur) }}
                @endif
            </td>
        </tr>
        <br>
        <tr>
            <td>: &emsp; @if ($penggajian->komponen == 0)
                    --
                @else
                    {{ rupiah($penggajian->komponen) }}
                @endif
            </td>
        </tr>
        <br><br>
        <tr>
            <td>: &emsp; {{ rupiah($penggajian->total_gaji) }}</td>
        </tr>
        <br>
        <tr>
            <td>: &emsp; {{ rupiah($penggajian->total_gaji) }}</td>
        </tr>
    </div>
    <div class="col-md-3 p-0" style="border: 1px solid black">
        <div class="fluid text-center" style="border: 1px solid black; height: 20px; width:100%">
            <label>Penerima</label>
        </div>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-12">
        <div class="modal-footer bg-whitesmoke br">
            <a href="{{ route('printbyonegaji', $penggajian->id_penggajian) }}"
                class="
                btn btn-primary col-md-12">Print Out</a>

        </div>
    </div>
</div>
