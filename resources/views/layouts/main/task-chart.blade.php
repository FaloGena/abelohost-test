<script>
    var days = [
        @foreach($user->chart as $day=>$count)
        '{{$day}}',
        @endforeach
    ];
    var tasks = [
        @foreach($user->chart as $day=>$count)
            '{{$count}}',
        @endforeach
    ];
    var ctx = document.getElementById('taskChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: days,
            datasets: [{
                label: 'Tasks done for last week',
                data: tasks,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor:'rgba(54, 162, 235, 0.5)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1,
                        suggestedMax: 5
                    }
                }]
            }
        }
    });
</script>
