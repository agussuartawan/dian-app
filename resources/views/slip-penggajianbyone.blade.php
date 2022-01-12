<!DOCTYPE html>
<html>

<title>Print Out Slip Penggajian</title>

<style>
    .page-break {
        page-break-after: always;
    }

    .page-break:last-child {
        page-break-after: avoid;
    }

    .table {
        display: block;
        float: left;
        width: 250px;
    }

</style>

<body>


    <div class="page-break">
        <h3>PT. TRISNO MITRA BALI</h3>


        <div style="width: 350px; float: left;">
            <div style="border: 1px solid black">
                <table>
                    <tr>
                        <td>Nama Karyawan :</td>
                        <td>{{ $penggajian->relasiKaryawan->nama_karyawan }}</td>
                    </tr>
                    <br>
                    <br>
                    <tr>
                        <td>Gaji Bulan :</td>
                        <td>{{ Carbon\Carbon::parse($penggajian->tanggal_penggajian)->format('F') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div style="width: 350px; float: right;">
            <div style="border: 1px solid black">
                <table>
                    <tr>
                        <td>Tanggal Penggajian :</td>
                        <td>{{ Carbon\Carbon::parse($penggajian->tanggal_penggajian)->isoFormat('DD MMMM Y') }}
                        </td>
                    </tr>
                    <br>
                    <br>
                    <tr>
                        <td>Divisi :</td>
                        <td>{{ $penggajian->relasiKaryawan->divisi }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <br><br>
        <h4>Perincian</h4>

        <div style="width: 350px; float: left;">
            <table>
                <tr>
                    <td>Gaji Pokok </td>
                </tr>
                <br>
                <tr>
                    <td>Uang Makan </td>
                    <td>{{ $penggajian->hari_kerja }} hari X {{ rupiah($penggajian->uang_makan) }} </td>
                </tr>
                <br>
                <tr>
                    <td>Uang Lembur </td>
                </tr>
                <br><br>
                <tr>
                    <td style="font-weight: bold">Jumlah Perincian </td>
                </tr>
                <br>
                <tr>
                    <td style="font-weight: bold; ">Jumlah Yang dibayarkan </td>
                </tr>
            </table>

        </div>

        <div style="width: 180px; float: left;">
            <table>
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
                        @else $penggajian->uang_lembur
                        @endif
                    </td>
                </tr>
                <br><br>
                <tr>
                    <td style="font-weight: bold; ">: &emsp; {{ rupiah($penggajian->total_gaji) }}</td>
                </tr>
                <br>
                <tr>
                    <td style="font-weight: bold; ">: &emsp; {{ rupiah($penggajian->total_gaji) }}</td>
                </tr>

            </table>
        </div>

        <div style=" float: left;">
            <table style="width: 170px; height:120px; border: 1px solid black;">
                <tr>
                    <td>
                        <h5
                            style="text-align: center; margin-top: -40px; margin-bottom:50px; border-bottom: 1px solid black ">
                            Penerima</h5>
                    </td>
                </tr>

            </table>
        </div>


    </div>
</body>

</html>
