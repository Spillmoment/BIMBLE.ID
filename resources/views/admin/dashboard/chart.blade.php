<!DOCTYPE html>
<html>
<head>
    <title>Cara Membuat Grafik dengan Highcharts di Laravel 6/7</title>
</head>
   
<body>
<h1 class="text-center">Cara Membuat Grafik dengan Highcharts di Laravel 6/7</h1>
<div id="container"></div>
</body>
  
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var users =  <?php echo json_encode($users) ?>;
   
    Highcharts.chart('container', {
        title: {
            text: 'Pengguna Baru, 2020'
        },
        subtitle: {
            text: 'Source: serambilaravel.com'
        },
         xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Jumlah Pengguna Mendafatar'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Pengguna Baru',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 200
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
</html>