function daysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
}

const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];

var dashboardApp = angular.module(
    "dashboardApp", [],
    function($interpolateProvider) {
        // Overrides the default AngularJS '{{ }}' usage as it clashes with Laravel's
        $interpolateProvider.startSymbol("<%");
        $interpolateProvider.endSymbol("%>");
    }
);

dashboardApp.controller("dashboardCtrl", function($scope, $http) {
    $scope.date_filter = new Date();
    $scope.date_filter_month = parseInt($scope.date_filter.getUTCMonth()) + 1;
    $scope.date_filter_year = parseInt($scope.date_filter.getUTCFullYear());
    $scope.exchanges = "";

    $scope.onDateFilterChange = function() {
        $scope.date_filter_month =
            parseInt($scope.date_filter.getUTCMonth()) + 1;
        $scope.date_filter_year = parseInt($scope.date_filter.getUTCFullYear());

        getExchanges();
    };

    function getExchanges() {
        $http({
            url: "scripts/php/exchangeList.php?month=" +
                $scope.date_filter_month +
                "&year=" +
                $scope.date_filter_year,
            method: "GET",
            params: {
                month: $scope.date_filter_month,
                year: $scope.date_filter_year,
            },
        }).then(
            // Request Success
            function(response) {

                $scope.exchanges = response.data.exchanges;
                var daysArray = [],
                    exchanges = [];
                angular.forEach($scope.exchanges, function(value) {
                    daysArray.push("Day " + String(value.Day));
                    exchanges.push(value.Exchanges);
                });
                // Drawing chart
                drawChart(daysArray, exchanges);

            },
            // Request Failure
            function(response) {
                $scope.exchanges = "";
                alert(
                    "ERROR: Failed to retrieve exchange program records data."
                );
            }
        );
    }

    function drawChart(daysArray, exchanges) {

        Highcharts.chart("dashboardChart", {
            chart: {
                type: "column",
            },
            title: {
                text: "Exchange Program Records over the Month",
            },
            subtitle: {
                text: monthNames[$scope.date_filter_month - 1] +
                    " " +
                    $scope.date_filter_year,
            },
            xAxis: {
                categories: daysArray,
                crosshair: true,
            },
            yAxis: {
                min: 0,
                title: {
                    text: "Number of Exchanges",
                },
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: "</table>",
                useHTML: true,
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                },
            },
            series: [{
                name: "Exchanges on that day",
                data: exchanges,
            }, ],
        });
    }

    getExchanges();
});