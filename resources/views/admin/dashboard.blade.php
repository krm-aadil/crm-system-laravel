@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto px-4 sm:px-8">
                    <div class="py-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded-md p-4">
                            <div class="mb-4">
                                <h2 class="text-lg font-semibold">Most Sold Book:</h2>
                                <p>Title: {{ $mostSoldBookTitle }}</p>
                                <p>Author: {{ $mostSoldAuthor }}</p>
                            </div>
                            <div class="mb-4">
                                <table class="min-w-full rounded-md overflow-hidden bg-blue-100 divide-y divide-gray-200">
                                    <thead class="bg-blue-200">
                                    <tr>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Hour</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Login Count</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($loginCountsByHour as $hour => $count)
                                        <tr>
                                            <td class="px-3 py-4">{{ $hour }}:00 - {{ ($hour + 1) % 24 }}:00</td>
                                            <td class="px-3 py-4">{{ $count }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="revenue-chart-container" class="mb-8">
                        <h2 class="text-lg font-semibold">Revenue Chart</h2>
                        <canvas id="revenue-chart"></canvas>
                    </div>

                    <div id="most-sold-books-chart-container" class="mb-8">
                        <h2 class="text-lg font-semibold">Most Sold Books by Title for Each Month</h2>
                        <canvas id="most-sold-books-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart Script -->
    <script>
        var revenueData = {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenueValues) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the chart's appearance
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }],
        };

        var revenueOptions = {
            // Customize chart options as needed
        };

        var revenueCtx = document.getElementById('revenue-chart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line', // Use 'bar' for bar chart, or other types as needed
            data: revenueData,
            options: revenueOptions,
        });
    </script>

    <!-- Most Sold Books Chart Script -->
    <script>
        var mostSoldBooksData = {
            labels: {!! json_encode($mostSoldBooksLabels) !!},
            datasets: {!! json_encode($mostSoldBooksDatasets) !!}
        };

        var mostSoldBooksOptions = {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            },
            responsive: true
        };

        var mostSoldBooksCtx = document.getElementById('most-sold-books-chart').getContext('2d');

        if (mostSoldBooksData.labels.length === 0 || mostSoldBooksData.datasets.length === 0) {
            // Log an error message if the data is empty
            console.error('Most Sold Books data is empty or not properly formatted.');
        } else {
            new Chart(mostSoldBooksCtx, {
                type: 'bar',
                data: mostSoldBooksData,
                options: mostSoldBooksOptions
            });
        }
    </script>
@endsection
