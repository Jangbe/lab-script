@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Pemeriksaan</h6>
                                <h2 class="text-white mb-0">Pendapatan</h2>
                            </div>
                            <div class="col">
                                {{-- <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Month</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Week</span>
                                            <span class="d-md-none">W</span>
                                        </a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-pemeriksaan" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Performa</h6>
                                <h2 class="mb-0">Total Pasien</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="total-pasien" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        $('#dashboard').addClass('active')
        $.ajax({
            url: "{{route('admin.dashboard-pasien')}}",
            method: 'post',
            success: function(result){
                var ordersChart = new Chart($('#total-pasien'), {
                    type: 'bar',
                    data: {
                        labels: result.month,
                        datasets: [{
                            label: 'Pasien',
                            data: result.statis
                        }]
                    }
                });
            }
        })

        $.ajax({
            url: "{{route('admin.dashboard-pemeriksaan')}}",
            method: 'post',
            success: function(result){
                var salesChart = new Chart($('#chart-pemeriksaan'), {
                type: 'line',
                options: {
                    scales: {
                    yAxes: [{
                        gridLines: {
                            lineWidth: 1,
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    if(value==0){return '0'}
                                    value=value.toString().substr(0,value.toString().length-3)
                                    return value + 'k';
                                }
                            }
                        }
                    }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || '';
                                var yLabel = item.yLabel;
                                var content = '';

                                if (data.datasets.length > 1) {
                                    content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                }

                                content += 'Rp. '+formated_price(yLabel);
                                return content;
                            }
                        }
                    }
                },
                data: {
                    labels: result.days,
                    datasets: [{
                    label: 'Penjualan',
                    data: result.statis
                    }]
                }
                });
            }
        });

    </script>
@endpush
