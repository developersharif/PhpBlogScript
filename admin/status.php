<?php
require("include/header.php");
?>
<style>
body {
    padding: 16px;
    background-color: #e8e8e8;
}

.chart-container {
    position: relative;
    height: 100%;
    width: 100%;
}

.isResizable {
    background-color: #ffffff;
    margin: 0px auto;
    padding: 5px;
    border: 1px solid #d8d8d8;
    overflow: hidden;
    /* Not usable in IE */
    /* resize: both; */

    width: 800px;
    height: 400px;
    min-width: 280px;
    min-height: 280px;
    max-width: 1200px;
    max-height: 600px;
}

#updateChart {
    background: white;
    border: 1px solid #d8d8d8;
    width: 160px;
    padding: 10px;
}
</style>
<center>under development</center>
<div class="isResizable">
    <div class="chart-container">
        <canvas id="chart"></canvas>
    </div>
</div>

<script>
window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

window.randomScalingFactor = function() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
};

var config = {
    type: 'line',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Unfilled",
            fill: false,
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
        }, {
            label: "Dashed",
            fill: false,
            backgroundColor: window.chartColors.green,
            borderColor: window.chartColors.green,
            borderDash: [5, 5],
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
        }, {
            label: "Filled",
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor()
            ],
            fill: true,
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            position: 'top'
        },
        title: {
            position: 'bottom',
            display: true,
            text: '-'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
    }
};

//Draw chart
window.onload = function() {
    var ctx = document.getElementById("chart").getContext("2d");
    window.myLine = new Chart(ctx, config);
};

//Update type of chart 
$('#updateChart').click(function(e) {
    var chart = window.myLine;
    var types = ['line', 'bar', 'bubble'];

    chart.config.type = types[Math.floor(Math.random() * 3)];
    chart.destroy();

    var ctx = document.getElementById("chart").getContext("2d");
    window.myLine = new Chart(ctx, chart.config);
});

//Use JQUeryUI to resize the div with IE 11
$(".isResizable").resizable();
</script>


<?php
require("include/footer.php");
?>