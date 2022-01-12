<!DOCTYPE html>
<html>

<head>
    <title>Laporan Perincian Komisi</title>
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

        .text-center {
            text-align: center;
        }

    </style>
    <h3>Laporan Perincian Komisi</h3>
    <p class="text">Periode : {{ Carbon\Carbon::parse($date['from'])->isoFormat('DD MMMM Y') }} -
        {{ Carbon\Carbon::parse($date['to'])->isoFormat('DD MMMM Y') }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Sales</th>
                <th>Bulan Penjualan</th>
                <th>Tanggal Komisi</th>
                <th>Total Penjualan Wine</th>
                <th>Total Penjualan Spirit</th>
                <th>Total Penjualan </th>
                <th>Komisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $i => $row)
                <tr>
                    <td class="text-center">
                        <p>{{ $i + 1 }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ $row->NIK }}</p>
                    </td>
                    <td>
                        <p>{{ $row->relasiKaryawan->nama_karyawan }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ $row->bulan_penjualan }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ Carbon\Carbon::parse($row->tanggal_komisi)->isoFormat('DD MMMM Y') }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ rupiah($row->total_kt_wine) }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ rupiah($row->total_kt_spirit) }}</p>
                    </td>
                    <td class="text-center">
                        <p>{{ rupiah($row->total_penjualan) }}</p>
                    </td>
                    <td>

                        <p>{{ rupiah($row->total_komisi) }} </p>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
