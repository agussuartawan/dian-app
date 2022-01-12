<div class="col-md-12">

    <div id="chartSales">


    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    Highcharts.chart('chartSales', {

        title: {
            text: 'Grafik Penjualan Sales dalam 1 bulan'
        },

        yAxis: {
            title: {
                text: 'Rentang Penjualan'
            }
        },

        xAxis: {
            categories: ['Minggu ke 1', 'Minggu ke 2', 'Minggu ke 3', 'Minggu Ke 4']

        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                // allowPointSelect: true;
                label: {
                    connectorAllowed: false
                },

            }
        },

        series: {!! json_encode($categories) !!}

            ,

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
</script>
