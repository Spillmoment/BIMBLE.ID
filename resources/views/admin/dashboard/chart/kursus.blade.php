<script>
   
  jQuery(document).ready(function ($) {
    "use strict";

    function getRandomColor() {
      var letters = '0123456789ABCDEF';
      var color = '#';
      for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
    }

    function setRandomColor() {
      $("#colorpad").css("background-color", getRandomColor());
    }

    // Chart Kursus Unit
    var piedata = [
          @foreach($kursus_unit as $krs)
          { label: "{{ $krs->unit->nama_unit }}", data: [[1, {{ $krs->unit->count() }}]], color: setRandomColor() },
          @endforeach
        ];

    $.plot('#flotPie1', piedata, {
      series: {
        pie: {
          show: true,
          radius: 1,
          innerRadius: 0.65,
          label: {
            show: true,
            radius: 2 / 3,
            threshold: 1
          },
          stroke: {
            width: 0
          }
        }
      },
      grid: {
        hoverable: true,
        clickable: true
      }
    });
    

  // Chart Pendaftar Unit
  var users =  <?php echo json_encode($unit_chart) ?>;
  var ctx = document.getElementById("lineChart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "Agustus", "September", "Oktober","November","Desember"],
            datasets: [
                {
                    label: "My First dataset",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: users
                },
                // {
                //     label: "My Second dataset",
                //     borderColor: "rgba(0, 194, 146, 0.9)",
                //     borderWidth: "1",
                //     backgroundColor: "rgba(0, 194, 146, 0.5)",
                //     pointHighlightStroke: "rgba(26,179,148,1)",
                //     data: [16, 32, 18, 27, 42, 33, 44]
                // }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });

    // single bar chart
    var ctx = document.getElementById("singelBarChart");
    ctx.height = 150;
    var myChart = new Chart(ctx,{
        type: 'bar',
        data: {
            labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
            datasets: [
                {
                    label: "My First dataset",
                    data: [ 55, 50, 75, 80, 56, 55, 60 ],
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 194, 146, 0.5)"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                                }]
            }
        }
    
  });
</script>