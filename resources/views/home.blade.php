@extends('layouts.app')

@section('content')
<div class="container" ng-app="dashboardApp" ng-controller="dashboardCtrl">
    <h3>Exchange Program Overview</h3>
    <div class="row justify-content-between mb-2 mx-4">
        <div class="card col-md mx-2">
            <div class="card-body text-center ">
                <h5>Total Exchange Today</h5>
                <h1 class="align-text-bottom">{{ $totalExchangeToday }}</h1>
            </div>
        </div>

        <div class="card col-md mx-2">
            <div class="card-body text-center ">
                <h5>Total Exchange This Month</h5>
                <h1 >{{ $totalExchangeThisMonth }}</h1>
            </div>
        </div>

        <div class="card col-md mx-2">
            <div class="card-body text-center ">
                <h5>Total Exchange This Year</h5>
                <h1>{{ $totalExchangeThisYear }}</h1>
            </div>
        </div>
</div>

{{--    <script src="/js/modules/stock.js"></script>--}}
{{--    <script src="/js/modules/map.js"></script>--}}
{{--    <script src="/js/highcharts.js"></script>--}}
{{--    <script src="/js/modules/exporting.js"></script>--}}
{{--    <script src="/js/modules/export-data.js"></script>--}}
{{--    <script src="/js/modules/accessibility.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js"></script>--}}

{{--    <script src="https://code.highcharts.com/highcharts.js"></script>--}}
{{--    <script src="https://code.highcharts.com/modules/exporting.js"></script>--}}
{{--    <script src="https://code.highcharts.com/modules/export-data.js"></script>--}}
{{--    <script src="https://code.highcharts.com/modules/accessibility.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js"></script>--}}
{{--    --}}

<figure class="highcharts-figure mx-4 row">
    <div id="container1" class="col-lg my-1"></div>
    <div id="container2" class="col-lg my-1"></div>
    <div id="container3"  class="col-lg my-1"></div>
</figure>
    <figure class="highcharts-figure mx-4 row">
{{--        <div id="container4" class="col-lg my-1"></div>--}}
        <div id="container5"  class="col-lg my-1"></div>
    </figure>


{{--    <script src="https://code.highcharts.com/maps/highmaps.js"></script>--}}
{{--    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>--}}
{{--    <script src="https://code.highcharts.com/mapdata/countries/my/my-all.js"></script>--}}

{{--    <div id="container4"></div>--}}
    <script>
        Highcharts.chart('container1', {
            chart: {
                type: 'column',
            },
            colors: ['#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE',
                '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
            title: {
                text: 'Exchange Program Records by [Weeks] of This Month',
                style: {
                    fontSize: '20px',
                    fontWeight: 'bold'
                },
                titleX: 'Week',
                titleY: 'Number of Records'
            },
            xAxis: {
                title: {
                    text: 'Week',
                    style: {
                        fontSize: '15px',
                        fontWeight: 'bold'
                    }
                },
                categories: ['1', '2', '3', '4']
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
                data: {{$weeklyByMonth}}
            }]
        });
    </script>
<script>
    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        colors: ['#AA4643', '#89A54E', '#80699B', '#3D96AE',
            '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
        title: {
            text: 'Exchange Program Records by [Month] of This Year',
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
            data: {{$monthlyByYear}}
        }]
    });
</script>
<script>
    Highcharts.chart('container3', {
        chart: {
            type: 'column'

        },
        colors: ['#89A54E', '#80699B', '#3D96AE',
            '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
        title: {
            text: 'Exchange Program Records by [Years] of Last 5 Years',
            style: {
                fontSize: '20px',
                fontWeight: 'bold'
            },
            titleX: 'Month',
            titleY: 'Number of Records'
        },
        xAxis: {
            title: {
                text: 'Year',
                style: {
                    fontSize: '15px',
                    fontWeight: 'bold'
                }
            },
            categories: {{$yearLabels}}
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
            data: {{$yearlyOfPastFiveYear}}
        }]
    });
</script>

    <script>
        Highcharts.chart('container4', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Most Popular Exchange Model',
                style: {
                    fontSize: '20px',
                    fontWeight: 'bold'
                },
                titleX: 'Device',
                titleY: 'Number of Device'
            },
            xAxis: {
                title: {
                    text: 'Devices',
                    style: {
                        fontSize: '15px',
                        fontWeight: 'bold'
                    }
                },
                categories: {{$yearLabels}}
            },
            yAxis: {
                title: {
                    text: 'Number of Devices',
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
                name: 'Number of Device',
                // data: [5, 3, 4, 7, 2,2,3,54,23,2,1,2]
                data: {{$yearlyOfPastFiveYear}}
            },
                {
                    name: 'Number of Device',
                    // data: [5, 3, 4, 7, 2,2,3,54,23,2,1,2]
                    data: {{$yearlyOfPastFiveYear}}
                },
                {
                    name: 'Number of Device',
                    // data: [5, 3, 4, 7, 2,2,3,54,23,2,1,2]
                    data: {{$yearlyOfPastFiveYear}}
                }]
        });
    </script>
    <script>
        Highcharts.chart('container5', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'All Competitor Branded Device Received',
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [
                @for($i=0;$i<count($popularBrandLabel);$i++)
                {

                    name: '{{$popularBrandLabel[$i]}}',
                    y: {{$popularBrandData[$i]}},
                    @if($i == 0)
                            sliced: true,
                            selected: true
                    @endif
                },
                @endfor
                ]
            }]
        });
    </script>
@endsection
