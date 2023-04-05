@extends('layouts.app')
@section('content')
<div class="container">
    <div style="width: 400px; height:200px; display:grid; place-items:center; margin:auto;">
        <canvas id="revenue-chart"></canvas>
    </div>
    <div class="chartWrapper" style="height:201px; display:flex;justify-content:center;">
        <canvas id="gender-chart"></canvas>
        <canvas id="ordersChart"></canvas>
    </div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// var revenueChart =  $(document).ready(function() {    
// // var ctx = document.getElementById('revenue-chart').getContext('2d');
// $.ajax({
//     url: '/charts/revenue',
//     type: 'GET',
//     dataType: 'json',
//     success: function(data) {
//         var chart = new new Chart(document.getElementById('revenue-chart'), {
//             type: 'line',
//             data: data,
//         });
//         // chart.destroy();

//     }

// });
// }); 
$(document).ready(function() {
    $.ajax({
        url: '/charts/revenue',
        type: 'GET',
        success: function(data) {
            var labels = [];
            var revenue = [];
            for (var i = 0; i < data.data.length; i++) {
                var record = data.data[i];
                labels.push("Month " + record.month);
                revenue.push(parseInt(record.revenue));
            }
            var ctx = document.getElementById('revenue-chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: revenue,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
            });
        }
    });


});
// Fetch gender data from the server
var ctx = document.getElementById('gender-chart').getContext('2d');
$.ajax({
    url: '/attendance/gender',
    type: 'GET',
    dataType: 'json', // add this line
    success: function(data) {
        var chart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true
            }
        });
    }
});

var userChart =  $(document).ready(function() {
        $.ajax({
            url: "/topUsers",
            type: "GET",
            dataType: "json",
            success: function(data) {
                var labels = [];
                var counts = [];

                console.log(data);

                for (var i = 0; i < data.data.length; i++) {
                    labels.push(data.data[i].client_id);
                    counts.push(data.data[i].orders);
                }

                var chartData = {
                    labels: labels,
                    datasets: [{
                        data: counts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)'
                        ],
                    }]
                };

                var options = {
                    title: {
                        display: true,
                        text: 'Top 10 Users by Order Count'
                    }
                };

                var chart = new Chart(document.getElementById('ordersChart'), {
                    type: 'pie',
                    data: chartData,
                    options: options
                });
            }
        });
    });
</script>
@endsection