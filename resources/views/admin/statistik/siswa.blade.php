@extends('admin.layouts.app-manager')

@section('title', 'Admin - Statistik Siswa')

@section('content')

<div class="row">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-4 pb-3">
    <div class="d-block mb-4 mb-md-0">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><span class="fas fa-home"></span></a></li>
                <li class="breadcrumb-item"><a href="#">Statistik</a></li>
                <li class="breadcrumb-item active" aria-current="page">Siswa</li>
            </ol>
        </nav>
        <h2 class="h4 mt-1">Statistik Siswa</h2>
    </div>
  </div>

  <div class="col-12 col-xl-6 mb-4">
    <table class="table table-centered table-nowrap mb-0 rounded">
        <thead class="thead-light">
            <tr>
                <th class="border-0 rounded-start">Kabupaten</th>
                <th class="border-0">Jumlah Siswa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa_per_kab as $data)
            <tr>
                <td class="border-0">
                    <a href="#" class="d-flex align-items-center">
                        @php
                            switch (strtok( $data->alamat_district, '.')) {
                              case 3507:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/d/d9/Logo_Kabupaten_Malang_-_Seal_of_Malang_Regency.svg';
                                break;
                              case 3513:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Logo_Kabupaten_Probolinggo_-_Seal_of_Probolinggo_Regency.svg/1200px-Logo_Kabupaten_Probolinggo_-_Seal_of_Probolinggo_Regency.svg.png';
                                break;
                              case 3505:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/9/94/Lambang_Kabupaten_Blitar.webp';
                                break;
                              case 3506:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Logo_Kabupaten_Kediri_%28Seal_of_Kediri_Regency%29.svg';
                                break;
                              case 3508:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/f/f4/Lambang_Kabupaten_Lumajang.png';
                                break;
                              case 3509:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/a/a3/Lambang-kabupaten-jember.png';
                                break;
                              case 3510:
                                $url = 'https://2.bp.blogspot.com/-2M27O2_qc74/WIbrCdxy-vI/AAAAAAAABL8/sFNoRU3tC2Ya1rC3H9UFTl-1xorHpMUqwCLcB/s1600/Banyuwangi%2BLogo%2BVector.png';
                                break;
                              case 3511:
                                $url = 'https://1.bp.blogspot.com/-skDAUluHm7E/YKj_0930wWI/AAAAAAAAE_I/js6aIQ4KXUIuP6MKjMMtqp_p90CP4dOiQCLcBGAsYHQ/s1600/Logo%2BKabupaten%2BBondowoso.png';
                                break;
                              case 3512:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/b/bd/Lambang_Kabupaten_Situbondo.png';
                                break;
                              case 3514:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Lambang_Kabupaten_Pasuruan.png/640px-Lambang_Kabupaten_Pasuruan.png';
                                break;
                              case 3515:
                                $url = 'https://1.bp.blogspot.com/-orwug2wdS7s/YHkAgolFyYI/AAAAAAAAEuc/MOhxeQvcQYQPqvrT0aavmOd63QblQz1uwCLcBGAsYHQ/s1600/Logo%2BKabupaten%2BSidoarjo%2BFormat%2BPNG.png';
                                break;
                              case 3573:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/e/ef/Logo_Kota_Malang_color.png';
                                break;
                              case 3574:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/4/4d/Lambang_Kota_Probolinggo.png';
                                break;
                              case 3575:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/d/dc/Logo_Kota_Pasuruan_-_Seal_of_Pasuruan_City.svg';
                                break;
                              case 3578:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/City_of_Surabaya_Logo.svg/1200px-City_of_Surabaya_Logo.svg.png';
                                break;
                              case 3579:
                                $url = 'https://upload.wikimedia.org/wikipedia/commons/8/8a/Logo_Kota_Batu%2C_Jawa_Timur_%28Seal_of_Batu%2C_East_Java%29.svg';
                                break;
                              
                              default:
                                $url = 'https://ui-avatars.com/api/?name=N&size=128';
                                break;
                            }
                        @endphp
                        <img class="avatar d-flex align-items-center justify-content-center fw-bold me-3" width="30px" alt="Image placeholder" src={{ $url }}>
                        {{-- <div><span class="h6">{{ strtok( $data->alamat_district, '.') }}</span></div> --}}
                        <div><span class="h6 ml-1">{{ substr( $data->alamat_district, strpos($data->alamat_district, ".") + 1) }}</span></div>
                    </a>
                </td>
                <td class="border-0 font-weight-bold">{{ $data->count }}</td>
            </tr>    
            @endforeach        
        </tbody>
    </table>
  </div>

  <div class="col-12 col-xl-5 mb-4">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm">
            <div class="card-body d-flex flex-row align-items-center flex-0 border-bottom">
                <div class="d-block">
                    <div class="h6 font-weight-normal text-gray mb-2">Siswa dalam unit</div>
                    <h2 class="h3" id='text-count-siswa'></h2>
                </div>
            </div>
            <div class="card-body p-2">
                <div class="ct-chart-ranking ct-golden-section ct-series-a"></div>
            </div>

            <div class="d-block ml-3">
                <div class="d-flex align-items-center text-left mb-2 ml-2">
                  <ul id="unit-label">
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
          let siswa_chart =  <?php echo json_encode($siswa_chart) ?>;
          const unit_name = [];
          const total_siswa = [];
          let count_all_siswa = 0;
          
          for(let i=0; i<siswa_chart.length; i++){
              unit_name.push(siswa_chart[i].nama_unit)  
              total_siswa.push(siswa_chart[i].count) 
              
              count_all_siswa += siswa_chart[i].count

              // document.getElementById("unit-label").appendChild(siswa_chart[i].nama_unit);
              let entry = document.createElement('li');
              entry.innerHTML = `<span class="font-weight-normal small ml-1">${siswa_chart[i].nama_unit} (<span class="text-success">${siswa_chart[i].count}</span>)</span>`
              document.getElementById("unit-label").appendChild(entry);
          }
          console.log(count_all_siswa)

          document.getElementById('text-count-siswa').innerHTML = `Total ${count_all_siswa} Siswa`

          var chart = new Chartist.Bar('.ct-chart-ranking', {
              labels: unit_name,
              series: [total_siswa]
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
        
        var scroll = new SmoothScroll('a[href*="#"]', {
            speed: 500,
            speedAsDuration: true
        });
    
    });
</script>

@endpush
