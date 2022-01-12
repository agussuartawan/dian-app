<div class="col-md-12">
    <div id="chartKaryawan">

    </div>
</div>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('chartKaryawan', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Kinerja Karyawan'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: {!! json_encode($categori) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rentang Kerja (hari)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} hari</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Grafik Kinerja Karyawan Berdasarkan Absensi',
            data: {!! json_encode($categori_hari) !!}

        }]
    });
</script>
