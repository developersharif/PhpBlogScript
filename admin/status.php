<?php
require("include/header.php");
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Site Status</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<style>
.chart {
    border: 3px solid royalblue;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="chart">
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>


    </div>
</div>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line', // also try bar or other graph types

    // The data for our dataset
    data: {
        labels: ["Jun ", "Jul ", "Aug ", "Sep ", "Oct ", "Nov ", "Dec ", "Jan ",
            "Feb ", "Mar ", "Apr ", "May "
        ],
        // Information about the dataset
        datasets: [{
            label: "Rainfall",
            backgroundColor: 'lightblue',
            borderColor: 'royalblue',
            data: [26.4, 39.8, 66.8, 66.4, 40.6, 55.2, 77.4, 69.8, 57.8, 76, 110.8, 142.6],
        }]
    },

    // Configuration options
    options: {
        layout: {
            padding: 10,
        },
        legend: {
            position: 'bottom',
        },
        title: {
            display: true,
            text: 'Under Development'
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: ''
                }
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Month of the Year'
                }
            }]
        }
    }
});
</script>
<?php
require("include/footer.php");
?>