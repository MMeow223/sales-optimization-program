@extends('layouts.app')

@section('content')
<div class="container" ng-app="dashboardApp" ng-controller="dashboardCtrl">
    <h3>Exchange Program Overview</h3>
    <div class="row mb-2">
        <div class="d-flex justify-content-between">


            <div class="card mx-4">
                <div class="card-header">
                    <h5>Total Exchange Today</h5>
                </div>
                <div class="card-body">
                    <h1  style="font-size: 5rem;">{{ $totalExchangeToday }}</h1>
                </div>
            </div>

            <div class="card mx-4">
                <div class="card-header">
                    <h5>Total Exchange This Month</h5>
                </div>
                <div class="card-body">
                    <h1  style="font-size: 5rem;">{{ $totalExchangeThisMonth }}</h1>
                </div>
            </div>

            <div class="card mx-4">
                <div class="card-header">
                    <h5>Total Exchange This Year</h5>
                </div>
                <div class="card-body">
                    <h1  style="font-size: 5rem;">{{ $totalExchangeThisYear }}</h1>
                </div>
            </div>

    </div>

</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js"></script>
<figure class="highcharts-figure">
    <div id="container1"></div>
    <div id="container2"></div>
</figure>
<script>

        console.log({{$data}})
        Highcharts.chart('container1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Exchange Program Records by Month',
                style: {
                    fontSize: '20px',
                    fontWeight: 'bold'
                },
                titleX: 'Month',
                titleY: 'Number of Records'
            },
            xAxis: {
                title: {
                    text: 'Month',
                    style: {
                        fontSize: '15px',
                        fontWeight: 'bold'
                    }
                },
                categories: ['Jan','Feb','Mac','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
            },
            yAxis: {
                title: {
                    text: 'Number of Records',
                    style: {
                        fontSize: '15px',
                        fontWeight: 'bold'
                    }

                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Number of Records',
                // data: [5, 3, 4, 7, 2,2,3,54,23,2,1,2]
                data: {{$data}}
            }]
        });


    </script>


@endsection
