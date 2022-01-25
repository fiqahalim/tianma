@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            {{ trans('global.downline.title') }}
        </li>
        <li aria-current="page" class="breadcrumb-item active">
            My commission
        </li>
    </ol>
</nav>

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row row-cols-2">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        Total Orders
                    </div>
                    <div class="card-body">
                        <div class="c-chart-wrapper">
                            <canvas height="338" id="myChart" style="display: block; box-sizing: border-box; height: 300.444px; width: 601.778px;" width="677">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        Total Commissions
                    </div>
                    <div class="card-body">
                        <div class="c-chart-wrapper">
                            <canvas height="338" id="canvas-2" style="display: block; box-sizing: border-box; height: 300.444px; width: 601.778px;" width="677">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Total Orders',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
