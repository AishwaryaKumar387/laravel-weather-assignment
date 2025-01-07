@extends('layouts.site-layout')

@section('content')
    <h2>Temperature Data</h2>
    <canvas id="temperatureChart"></canvas>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script>
        let cities = @json($cities);
        if (cities.length) {
            let labels = cities.map(function(city) {
                return city.name; // City name
            });

            let data = cities.map(function(city) {
                return city.temperature; // City temperature
            });

            // Create the chart
            let ctx = document.getElementById('temperatureChart').getContext('2d');
            let temperatureChart = new Chart(ctx, {
                type: 'line', 
                data: {
                    labels: labels, // City names on the x-axis
                    datasets: [{
                        label: 'Temperature in °C',
                        data: data, // Temperature data
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'City'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Temperature (°C)'
                            },
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });
        }
    </script>
@endpush
