@extends('admin.layouts.manager')

@section('title','Bimble - Dashboard')

@section('content')

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

<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
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

        <!-- Chart -->
        <div class="row">

            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Kursus Unit</h4>
                        <div class="chart-container ov-h">
                            <div id="flotPie1" class="float-chart"></div>
                        </div>
                    </div>
                </div>
            </div><!-- /# column -->

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3"> Pendaftar Unit </h4>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                
            </div><!-- /# column -->
            
                    
        </div>



    </div>
    <!-- .animated -->
</div>


@endsection

@push('after-script')
@include('admin.dashboard.chart.kursus')
@endpush
