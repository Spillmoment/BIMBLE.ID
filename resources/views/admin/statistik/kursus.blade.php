@extends('admin.layouts.app-manager')

@section('title', 'Admin - Halaman Kursus')

@section('content')

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Statistik</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kursus</li>
                    </ol>
                </nav>
                <h2 class="h4 mt-1">Daftar Kursus</h2>
            </div>
        </div>

          <div class="row justify-content-md-center">
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon icon-shape icon-md icon-shape-tertiary rounded mr-4 mr-sm-0"><span
                                        class="fas fa-chalkboard-teacher"></span></div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Total Unit</h2>
                                    <h3 class="mb-1" id="text-count-siswa1"></h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Total Unit</h2>
                                    <h3 class="mb-1" id='text-count-siswa2'></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon icon-shape icon-md icon-shape-secondary rounded mr-4 mr-sm-0"><span
                                        class="fas fa-book"></span></div>
                                <div class="d-sm-none">
                                    <h2 class="h5">Total Kursus</h2>
                                    <h3 class="mb-1" id="text-count-kursus1"></h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Total Kursus</h2>
                                    <h3 class="mb-1" id='text-count-kursus2'></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-12 mb-12">
        <div class="col-12 mb-12">
            <div class="card border-light shadow-sm">
                <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                    <div class="d-block">
                        <div class="h4 font-weight-normal text-gray mb-2">Jumlah Unit Pada Kursus</div>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="ct-chart-ranking ct-golden-section ct-series-a"></div>
                </div>

                <div class="row mt-4">                    
                    <div class="col-md-6">
                        <div class="ml-3">
                            <div class="align-items-center text-left mb-2 ml-2">
                                <ul id="kursus-label">
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Trend Kursus</h5>
                        <div class="pie-chart"></div>
                        <ul id='list-trends'>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

   

</div>

@endsection
@push('scripts')
<script>
    const doc = document;
    doc.addEventListener("DOMContentLoaded", function(event) {
        //Chartist
    
        if(d.querySelector('.ct-chart-ranking')) {
          let kursus_chart =  <?php echo json_encode($kursus_chart) ?>;
          const kursus_name = [];
          const total_unit = [];
          let count_all_unit = 0;
          
          for(let i=0; i<kursus_chart.length; i++){
              kursus_name.push(kursus_chart[i].nama_kursus)  
              total_unit.push(kursus_chart[i].count) 
              
              count_all_unit += kursus_chart[i].count

              // document.getElementById("kursus-label").appendChild(kursus_chart[i].nama_kursus);
              let entry = document.createElement('li');
              entry.innerHTML = `<span class="font-weight-normal small ml-1">${kursus_chart[i].nama_kursus} (<span class="text-success">${kursus_chart[i].count}</span> unit)</span>`
              document.getElementById("kursus-label").appendChild(entry);
          }

          document.getElementById('text-count-siswa1').innerHTML = `${count_all_unit} Unit`
          document.getElementById('text-count-siswa2').innerHTML = `${count_all_unit} Unit`
          document.getElementById('text-count-kursus1').innerHTML = `${kursus_name.length} Kursus`
          document.getElementById('text-count-kursus2').innerHTML = `${kursus_name.length} Kursus`

          var chart = new Chartist.Bar('.ct-chart-ranking', {
              labels: kursus_name,
              series: [total_unit]
            }, {
              low: 0,
              showArea: true,
              plugins: [
                Chartist.plugins.tooltip()
              ],
              axisX: {
                  // On the x-axis start means top and end means bottom
                  position: 'end'
              },
              axisY: {
                  // On the y-axis start means left and end means right
                  showGrid: false,
                  showLabel: false,
                  offset: 0
              }
              });
            
            chart.on('draw', function(data) {
              if(data.type === 'line' || data.type === 'area') {
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

        if (d.querySelector('.pie-chart')) {
            let trend_kursus_chart =  <?php echo json_encode($trend_kursus_chart) ?>;
            const kursus_name = [];
            const total_siswa = [];
            const text_colors = ['blue', 'secondary', 'tertiary']
            
            for(let i=0; i<trend_kursus_chart.length; i++){
                kursus_name.push(trend_kursus_chart[i].nama_kursus)  
                total_siswa.push(trend_kursus_chart[i].count) 
                
                // document.getElementById("kursus-label").appendChild(trend_kursus_chart[i].nama_kursus);
                let entry = document.createElement('li');
                entry.innerHTML = `<span class="font-weight-normal text-${text_colors[i]} small ml-1">
                                    ${trend_kursus_chart[i].nama_kursus}</span> <mark>${trend_kursus_chart[i].count} Siswa</mark>`
                document.getElementById("list-trends").appendChild(entry);
            }

            var data = {
                series: total_siswa
            };
            
            var sum = function(a, b) { return a + b };
                
            new Chartist.Pie('.pie-chart', data, {
                labelInterpolationFnc: function(value) {
                    return Math.round(value / data.series.reduce(sum) * 100) + '%';
                },            
                low: 0,
                high: 8,
                fullWidth: false,
                plugins: [
                    Chartist.plugins.tooltip()
                ],
            });
        }

        
        var scroll = new SmoothScroll('a[href*="#"]', {
            speed: 500,
            speedAsDuration: true
        });
    
    });
</script>

@endpush
