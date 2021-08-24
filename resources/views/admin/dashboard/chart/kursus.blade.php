<script>
  jQuery(document).ready(function ($) {
    "use strict";

    // Chart Kursus Unit
    var piedata = [
          @foreach($kursus_unit as $krs)
          { label: "{{ $krs->unit->nama_unit }}", data: [[1, {{ $krs->unit->count() }}]], color: '#5c6bc0' },
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
  var ctx = document.getElementById("lineChart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July","Agustus","September","Oktober","November","Desember"],
            datasets: [
                {
                    label: "My First dataset",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: [20, 47, 35, 43, 65, 45, 35]
                },
                {
                    label: "My Second dataset",
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0, 194, 146, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [16, 32, 18, 27, 42, 33, 44]
                }
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


    // Line Chart  #flotLine5 End
    // Traffic Chart using chartist
    if ($('#traffic-chart').length) {
      var chart = new Chartist.Line('#traffic-chart', {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        series: [
          [0, 18000, 35000, 25000, 22000, 0],
          [0, 33000, 15000, 20000, 15000, 300],
          [0, 15000, 28000, 15000, 30000, 5000]
        ]
      }, {
        low: 0,
        showArea: true,
        showLine: false,
        showPoint: false,
        fullWidth: true,
        axisX: {
          showGrid: true
        }
      });

      chart.on('draw', function (data) {
        if (data.type === 'line' || data.type === 'area') {
          data.element.animate({
            d: {
              begin: 2000 * data.index,
              dur: 2000,
              from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
              to: data.path.clone().stringify(),
              easing: Chartist.Svg.Easing.easeOutQuint
            }
          });
        }
      });
    }

    // Traffic Chart using chartist End
    //Traffic chart chart-js
    if ($('#TrafficChart').length) {
      var ctx = document.getElementById("TrafficChart");
      ctx.height = 150;
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
          datasets: [
            {
              label: "Visit",
              borderColor: "rgba(4, 73, 203,.09)",
              borderWidth: "1",
              backgroundColor: "rgba(4, 73, 203,.5)",
              data: [0, 2900, 5000, 3300, 6000, 3250, 0]
            },
            {
              label: "Bounce",
              borderColor: "rgba(245, 23, 66, 0.9)",
              borderWidth: "1",
              backgroundColor: "rgba(245, 23, 66,.5)",
              pointHighlightStroke: "rgba(245, 23, 66,.5)",
              data: [0, 4200, 4500, 1600, 4200, 1500, 4000]
            },
            {
              label: "Targeted",
              borderColor: "rgba(40, 169, 46, 0.9)",
              borderWidth: "1",
              backgroundColor: "rgba(40, 169, 46, .5)",
              pointHighlightStroke: "rgba(40, 169, 46,.5)",
              data: [1000, 5200, 3600, 2600, 4200, 5300, 0]
            }
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
    }
    //Traffic chart chart-js  End
    // Bar Chart #flotBarChart
    $.plot("#flotBarChart", [{
      data: [[0, 18], [2, 8], [4, 5], [6, 13], [8, 5], [10, 7], [12, 4], [14, 6], [16, 15], [18, 9], [20, 17], [22, 7], [24, 4], [26, 9], [28, 11]],
      bars: {
        show: true,
        lineWidth: 0,
        fillColor: '#ffffff8a'
      }
    }], {
      grid: {
        show: false
      }
    });
    // Bar Chart #flotBarChart End
  });
</script>