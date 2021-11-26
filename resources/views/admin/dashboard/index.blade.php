@extends('admin.layouts.app-manager')

@section('title','Bimble - Dashboard Admin LPPK')
@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Halaman Dashboard</li>
        </ol>
    </nav>

</div>

<div class="container">
    <div class="row justify-content-center">

        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <h1>Selamat Datang Admin {{ auth()->user()->nama }}</h1>


            </div>
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col-12 mb-4">
            <div class="card bg-yellow-alt shadow-sm">
                <div class="card-header d-flex flex-row align-items-center flex-0">
                    <div class="d-block">
                        <div class="h4 font-weight-normal mb-2">Diagram Total Unit</div>
                        <h5 class="h5">Dalam satuan per bulan</h5>
                        <div class="small mt-2"> 
                            <span class="font-weight-bold mr-2">January - December</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="ct-chart-sales-value ct-double-octave ct-series-g"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span class="fas fa-chart-line"></span></div>
                            <div class="d-sm-none">
                                <h2 class="h5">Total Unit</h2>
                                <h3 class="mb-1" id="label-count-unit1"></h3>
                            </div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Total Unit</h2>
                                <h3 class="mb-1" id="label-count-unit2"></h3>
                            </div>
                            <small><span id="unit-month-data"></span>, <span class="icon icon-small"><span class="fas fa-globe-europe"></span></span> Month</small> 
                            <div class="small mt-2" id="percent-unit-label">                               
                                
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
                        <div class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="ct-chart-traffic-share ct-golden-section ct-series-a"></div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <h2 class="h5 mb-3">Keaktifan</h2>
                            <h6 class="font-weight-normal text-secondary" id="max-percent"></h6>
                            <h6 class="font-weight-normal text-blue" id="min-percent"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('prepend-script')
<script>
    // Get total unit
    let data_unit =  <?php echo json_encode($unit_chart) ?>;
    let total_unit = 0
    
    for (let index = 0; index < data_unit.length; index++) {
        total_unit = total_unit + data_unit[index].count
    }
    document.getElementById('label-count-unit1').innerHTML = `${total_unit} Agensi`;
    document.getElementById('label-count-unit2').innerHTML = `<a href="{{ route('unit.index') }}">${total_unit} Agensi</a>`;

    // Get data bulan
    let first_month = '';
    let last_month = '';
    let count_last_month = 0;
    let count_last2_month = 0;
    for (let loop = 0; loop < data_unit.length; loop++) {   
        first_month = data_unit[0].monthname;  
        last_month = data_unit[data_unit.length-1].monthname;  

        count_last_month = data_unit[data_unit.length-1].count;
        count_last2_month = data_unit[data_unit.length-2].count;
    }
    document.getElementById('unit-month-data').innerHTML = `${first_month.substring(0,3)} - ${last_month.substring(0,3)}`
    
    // Count persent up or down from last month
    const test = () => {
        let count_result = ''
        let devided_count = count_last_month > count_last2_month ? (count_last2_month / count_last_month) : (count_last_month / count_last2_month)
        const count_persent = parseFloat(100 - (devided_count * 100)).toFixed(2)

        if (count_last_month > count_last2_month) {
            count_result = `<span class="fas fa-angle-up text-success"></span>                                   
                                <span class="text-success font-weight-bold">${count_persent}%</span> Naik dari dua data terakhir`
        } else if(count_last_month < count_last2_month) {
            count_result = `<span class="fas fa-angle-down text-danger"></span>                                   
                                <span class="text-danger font-weight-bold">${count_persent}%</span> Turun dari dua data terakhir`
        }
        return count_result
    }
    document.getElementById('percent-unit-label').innerHTML = test()

</script>
<script>
    const doc = document;
    doc.addEventListener("DOMContentLoaded", function(event) {
        //Chartist
    
        if(doc.querySelector('.ct-chart-sales-value')) {
            //Chart 5
            let users =  <?php echo json_encode($unit_chart) ?>;
            let list_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            const temp = [];
            for(let i=0; i<12; i++){
                let cek_month = <?php echo json_encode($unit_chart) ?>;
                let data_length = cek_month.length;
                temp[i] = ''
                for(let data=0; data<data_length; data++){
                    if (list_months[i] == cek_month[data].monthname) {
                        temp[i] = cek_month[data].count
                    }
                    
                }        
            }
            console.log(temp)
              new Chartist.Line('.ct-chart-sales-value', {
                labels: list_months,
                series: [
                    temp
                ]
              }, {
                low: 0,
                showArea: true,
                fullWidth: true,
                plugins: [
                  Chartist.plugins.tooltip()
                ],
                axisX: {
                    // On the x-axis start means top and end means bottom
                    position: 'end',
                    showGrid: true
                },
                axisY: {
                    // On the y-axis start means left and end means right
                    showGrid: false,
                    showLabel: false,
                    labelInterpolationFnc: function(value) {
                        return '$' + (value / 1) + 'k';
                    }
                }
            });
        }
    
        // Show unit active and diactive
        if(doc.querySelector('.ct-chart-traffic-share')) {
            let data_active_diactive = <?php echo json_encode($count_active_diactive) ?>;
            console.log(data_active_diactive)
            let series = []
            for (let index = 0; index < data_active_diactive.length; index++) {
                console.log(series)
                series.push(data_active_diactive[index].count);
                let check_max = Math.max(...series) 
                if (data_active_diactive[index].count === check_max) {
                    document.getElementById('max-percent').innerHTML = `<span class="icon w-20 icon-xs icon-secondary mr-1"><span class="fas fa-check-double"></span></span> ${data_active_diactive[index].status == 1 ? 'Aktif' : null} <span class="h6">${data_active_diactive[index].count}</span>`
                }
                document.getElementById('min-percent').innerHTML = `<span class="icon w-20 icon-xs icon-blue mr-1"><span class="fas fa-times-circle"></span></span> ${data_active_diactive[index].status == 0 ? 'Tidak Aktif' : null} <span class="h6">${data_active_diactive[index].count}</span>`
            }
            const max_series = Math.max(...series)     
            const min_series = Math.min(...series)     
            const series_percent = ((min_series/max_series)*100).toFixed(2)
            const series_result = [series_percent, (100-series_percent).toFixed(2)] 

            var data = {
                series: series_result
                };
                
                var sum = function(a, b) { return a + b };
                
                new Chartist.Pie('.ct-chart-traffic-share', data, {
                labelInterpolationFnc: function(value) {
                    return Math.round(value / data.series.reduce(sum) * 100) + '%';
                },            
                low: 0,
                high: 8,
                donut: true,
                donutWidth: 20,
                donutSolid: true,
                fullWidth: false,
                showLabel: false,
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
