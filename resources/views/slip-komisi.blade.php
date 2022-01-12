<!DOCTYPE html>
<html>

<title>Print Out Slip Komisi</title>

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
    @foreach ($rows as $komisi)


        <div class="page-break">
            <h3>PT. TRISNO MITRA BALI</h3>


            <div style="width: 350px; float: left;">
                <div style="border: 1px solid black">
                    <table>
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
                    </table>
                </div>
            </div>

            <div style="width: 350px; float: right;">
                <div style="border: 1px solid black">
                    <table>
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
                    </table>
                </div>
            </div>

            <br><br>
            <h4>Perincian</h4>

            <div style="width: 350px; float: left;">
                <table>
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
                </table>

            </div>

            <div style="width: 180px; float: left;">
                <table>
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
    @endforeach
</body>

</html>
