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

        .text-center {
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
                <th>Nama Karyawan</th>
                <th>Uang Makan</th>
                <th>Uang Lembur</th>
                <th>Hari Kerja</th>
                <th>Tanggal Penggajian</th>
                <th>Gaji</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $i => $row)
                <tr>
                    <td class="text-center">
                        <p>{{ $i + 1 }}</p>
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

                        <p>{{ rupiah($row->total_gaji) }} </p>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
