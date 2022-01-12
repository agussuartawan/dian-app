<h5>PT. TRISNO MITRA BALI</h5>
<div class="row">
    <div class="col-6" style="border: 1px solid black">

        <tr>
            <td>Nama Karyawan :</td>
            <td>{{ $komisi->relasiKaryawan->nama_karyawan }}</td>
        </tr>
        <br>
        <br>
        <tr>
            <td>Komisi Bulan :</td>
            <td>{{ Carbon\Carbon::parse($komisi->bulan_penjualan)->format('F') }}</td>
        </tr>

    </div>

    <div class="col-6" style="border: 1px solid black">

        <tr>
            <td>Tanggal Komisi :</td>
            <td>{{ Carbon\Carbon::parse($komisi->tanggal_komisi)->isoFormat('DD MMMM Y') }}</td>
        </tr>
        <br>
        <br>
        <tr>
            <td>Divisi :</td>
            <td>{{ $komisi->relasiKaryawan->divisi }}</td>
        </tr>
    </div>

</div>
</div>
<br>
<h5>Perincian</h5>
<div class="row">
    <div class="col-md-6">
        <tr>
            <td>Wine </td> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <td>{{ rupiah($komisi->total_kt_wine) }} x 0.01% </td>
        </tr>
        <br>
        <tr>
            <td>Spirit </td> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <td> {{ rupiah($komisi->total_kt_spirit) }} x 0.02%</td>
        </tr>
        <br><br>
        <tr>
            <td>Total Komisi </td>
        </tr>
        <br>
        <tr>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <td>Jumlah Yang dibayarkan </td>
        </tr>
    </div>
    <div class="col-md-3">
        <tr>
            <td>: &emsp; {{ rupiah($komisi->total_kt_wine * 0.01) }}</td>
        </tr>
        <br>
        <tr>
            <td>: &emsp; {{ rupiah($komisi->total_kt_spirit * 0.02) }}</td>
        </tr>
        <br><br>
        <tr>
            <td>: &emsp; {{ rupiah($komisi->total_komisi) }}</td>
        </tr>
        <br>
        <tr>
            <td>: &emsp; {{ rupiah($komisi->total_komisi) }}</td>
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
            <a href="{{ route('printbyonekomisi', $komisi->id_komisi) }}"
                class="
                btn btn-primary col-md-12">Print Out</a>

        </div>
    </div>
</div>
