<!DOCTYPE html>
<html>

<head>
    <title>Laporan Perincian Penggajian</title>
</head>

<body>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        h3 {
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
        }

        .table th {
            padding: 8px 8px;
            border: 1px solid #000000;
            text-align: center;
        }

        .table td {
            vertical-align: top;
            padding: 3px 3px;
            border: 1px solid #000000;
        }

        .ttd{
            float: right;
            margin-top: 4rem;
            width: 20rem;
            margin-right: 0;
        }

        .nama-ttd{
            padding-top: 6rem;
            text-align: center;
        }

        .lokasi {
            text-align: center;
        }

    </style>
    <h3>Laporan Penggajian</h3>
    <p class="text">Periode : {{ Carbon\Carbon::parse($date['from'])->isoFormat('DD MMMM Y') }} -
        {{ Carbon\Carbon::parse($date['to'])->isoFormat('DD MMMM Y') }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Karyawan</th>
                <th>Uang Makan</th>
                <th>Uang Lembur</th>
                <th>Hari Kerja</th>
                <th>Tanggal Penggajian</th>
                <th>Gaji Bulan</th>
                <th>Komponen Tambahan</th>
                <th>Total Gaji</th>
                <th>Gaji Dibayarkan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $i => $row)
                <tr>
                    <td class="text-center">
                        <p>{{ $i + 1 }}</p>
                    </td>
                    <td>
                        <p>{{ $row->NIK }}</p>
                    </td>
                    <td>
                        <p>{{ $row->relasiKaryawan->nama_karyawan }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ rupiah($row->uang_makan) }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ rupiah($row->uang_lembur) }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ $row->hari_kerja }} hari</p>
                    </td>
                    <td class="text-center">
                        <p>{{ Carbon\Carbon::parse($row->tanggal_penggajian)->isoFormat('DD MMMM Y') }}</p>
                    </td>
                    <td>
                        <p>{{ $row->bulan_gaji }}</p>
                    </td>
                    <td>
                        <p>{{ rupiah($row->komponen) }} ({{ $row->keterangan }})</p>
                    </td>
                    <td>

                        <p>{{ rupiah($row->total_gaji) }} </p>

                    </td>
                    <td>

                        <p>{{ rupiah($row->total_gaji) }} </p>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="ttd">
        <div class="lokasi">
            <span>Denpasar, {{ Carbon\Carbon::now()->isoFormat('DD MMMM Y') }}</span>
        </div>
        <div class="nama-ttd">
            <span>(Lingdia Martanto)</span>
        </div>
    </div>
</body>

</html>
