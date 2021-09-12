@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Statistics')
@section('content')
    @if (strlen(json_encode($chart->info)) > 2)
        <section id="ms_charts">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <h1 class="panel-heading my-2">{{ $title }}</h1>
                            <h4 class="panel-heading my-2">{{ $date }}</h4>
                            <div class="col-lg-8">
                                <canvas id="userChart" class="rounded shadow"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ms_legend">
                    <h6>Appartments</h6>
                    @php
                        $info = json_encode($chart->info);
                        $info = str_replace('[', '', $info);
                        $info = str_replace(']', '', $info);
                        $info = str_replace(',', '', $info);
                        $info = str_replace('""', ',', $info);
                        $info = str_replace('"', '', $info);
                        $info = explode(',', $info);
                    @endphp
                    <ul>
                        @foreach ($info as $item)
                            <li>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @else
        <div class="container text-center d-flex align-items-center justify-content-center" style="height: calc(100vh - 196.66px)">
            <h2>There're no results.</h2>
        </div>       
    @endif

    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <!-- CHARTS -->
    <script>
      var ctx = document.getElementById('userChart').getContext('2d');
      var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels:  {!!json_encode($chart->labels)!!} ,
            datasets: [
                {
                    label: 'Appartment\'s views',
                    backgroundColor: {!! json_encode($chart->colours)!!} ,
                    data:  {!! json_encode($chart->dataset)!!} ,
                },
            ]
        },
    // Configuration options go here
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true,
                          callback: function(value) {if (value % 1 === 0) {return value;}}
                      },
                      scaleLabel: {
                          display: false
                      }
                  }]
              },
              legend: {
                  labels: {
                      // This more specific font property overrides the global property
                      fontColor: '#122C4B',
                      fontFamily: "'Ubuntu', sans-serif",
                      padding: 15,
                      boxWidth: 0,
                      fontSize: 14,
                  }
              },
              layout: {
                  padding: {
                      left: 3,
                      right: 10,
                      top: 0,
                      bottom: 3
                  }
              }
          }
      });
    </script>
@endsection
