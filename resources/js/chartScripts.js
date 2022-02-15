// import {ChartisanHooks} from "@chartisan/chartjs";
//
//
// // This is a temporary static chart, to be replaced by a dynamic chart.
// function drawBarChart() {
//
//
//     const chart = new Chartisan({
//     el: '#chart',
//     url: "app/Charts/BarChart.php",
//     hooks: new ChartisanHooks()
//     .colors('#ECC94B')
//     .legend({ position: 'bottom' })
//     .title({ display: true, text: 'Monthly Exchange Program Records' })
//     .tooltip(),
//     update : { background: true },
//
//     });
// }
//
//
//
// // create ctx for the chart but throw error if not found
// const ctx = document.getElementById('chart');
// // throw error if not found
// if (ctx === null) {
//     throw new Error('Unable to find canvas with id="myChart"');
// } else {
//     drawBarChart();
// }
