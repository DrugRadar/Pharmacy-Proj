@extends('layouts.app')
@section('content')
<div class="container">
    <canvas id="revenue-chart"></canvas>
    <div class="chartWrapper" style="height:500px; display:flex;justify-content:center;">
        <canvas id="gender-chart"></canvas>
    </div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// var ctx = document.getElementById('revenue-chart').getContext('2d');
// var chart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: <?= json_encode($labels) ?>,
//         datasets: [{
//             label: 'Monthly Revenue',
//             data: <?= json_encode($data) ?>,
//             backgroundColor: 'rgba(255, 99, 132, 0.2)',
//             borderColor: 'rgba(255, 99, 132, 1)',
//             borderWidth: 1
//         }]
//     },
// });
$.ajax({
    url: 'your-url-here',
    type: 'GET',
    success: function(data) {
        var ctx = document.getElementById('revenue-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: JSON.parse(data.labels),
                datasets: [{
                    label: 'Monthly Revenue',
                    data: JSON.parse(data.data),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
        });
    }
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
</script>
@endsection