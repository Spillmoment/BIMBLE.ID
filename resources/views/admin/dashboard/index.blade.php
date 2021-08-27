
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ShaynaAdmin - HTML5 Admin Template</title>
    <meta name="description" content="ShaynaAdmin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Left Panel -->
    @include('admin.includes.sidebar-manager')
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        @include('admin.includes.navbar-manager')
        <!-- /#header -->
        <!-- Breadcrumbs-->
        <div class="breadcrumbs">
          <div class="breadcrumbs-inner">
              <div class="row m-0">
                  <div class="col-sm-4">
                      <div class="page-header float-left">
                          <div class="page-title">
                              <h1>Dashboard</h1>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-8">
                      <div class="page-header float-right">
                          <div class="page-title">
                              <ol class="breadcrumb text-right">
                                  <li><a href="#">Dashboard</a></li>
                                  <li class="active">Statistik Dashboard</li>
                              </ol>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
        <!-- /.breadcrumbs-->
        <!-- Content -->
        <div class="content">
            <div class="animated fadeIn">
               
              <div class="row">

                <div class="col-lg-3 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-browser"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $kursus }}</span></div>
                                        <div class="stat-heading">Kursus</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-3 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-user"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $unit }}</span></div>
                                        <div class="stat-heading">Unit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
    
                <div class="col-lg-3 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-user"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $pendaftar }}</span></div>
                                        <div class="stat-heading">Pendaftar </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
    
                <div class="col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-comment"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span style="font-size: 16px">{{ $komentar }}</span>
                                        </div>
                                        <div class="stat-heading mt-2">Review </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>

            <div class="row">
               
                {{-- <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Yearly Sales </h4>
                            <canvas id="sales-chart"></canvas>
                        </div>
                    </div>
                </div><!-- /# column -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Team Commits </h4>
                            <canvas id="team-chart"></canvas>
                        </div>
                    </div>
                </div><!-- /# column -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Bar chart </h4>
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div><!-- /# column -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Rader chart </h4>
                            <canvas id="radarChart"></canvas>
                        </div>
                    </div>
                </div><!-- /# column -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Line Chart </h4>
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Doughut Chart </h4>
                                <canvas id="doughutChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                </div><!-- /# column -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Pie Chart </h4>
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div><!-- /# column --> --}}

            </div><!-- /# column -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Single Bar Chart </h4>
                        <canvas id="singelBarChart"></canvas>
                    </div>
                </div>



            </div>

            </div><!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
      @include('admin.includes.footer')
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->


<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
<script src="{{ asset('assets/js/init/chartjs-init.js') }}"></script>
<!--Flot Chart-->
<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>


<script>
    ( function ( $ ) {
    "use strict";

    var users =  <?php echo json_encode($unit_chart) ?>;
      // single bar chart
      var ctx = document.getElementById( "singelBarChart" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                    label: "Pendaftar Unit",
                    data: users,
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 194, 146, 0.5)"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ]
            }
        }
    } );

} )( jQuery );
</script>

</body>