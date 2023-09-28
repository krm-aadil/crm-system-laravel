@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto px-4 sm:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Total Users Card -->
                        <div class="col-span-1 bg-white overflow-hidden shadow-lg sm:rounded-lg rounded-md flex items-center">
                            <!-- Left side with the smaller image -->
                            <img src="{{ asset('img/demure-girl-reading-a-book-sitting-in-an-armchair-next-to-a-floor-lamp-1.png') }}" alt="Math Image" class="w-20 h-auto mr-4">

                            <!-- Right side with the user count -->
                            <div>
                                <h2 class="text-lg font-semibold text-blue-600">Total Users:</h2>
                                <p class="text-blue-900 text-3xl">{{ $totalUsersCount }}</p>
                            </div>
                        </div>

                        <!-- Revenue Chart Card -->
                        <div class="col-span-1 bg-white overflow-hidden shadow-lg sm:rounded-lg rounded-md">
                            <h2 class="text-lg font-semibold text-blue-600 mb-4">Revenue Chart</h2>
                            <canvas id="revenue-chart"></canvas>
                        </div>

                        <!-- Login Counts Table Card -->
                        <div class="col-span-1 bg-white overflow-hidden shadow-lg sm:rounded-lg rounded-md">
                            <h2 class="text-lg font-semibold text-blue-600 mb-4">Login Counts by Hour</h2>
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


                        <!-- Most Sold Book Card -->
                        <div class="col-span-1 bg-white overflow-hidden shadow-lg sm:rounded-lg rounded-md">
                            <h2 class="text-lg font-semibold text-blue-600 mb-4">Most Sold Book:</h2>
                            <p class="text-blue-900">Title: {{ $mostSoldBookTitle }}</p>
                            <p class="text-blue-900">Author: {{ $mostSoldAuthor }}</p>
                            @if ($mostSoldBookCover)
                                <img src="{{ asset('storage/' . $mostSoldBookCover) }}" alt="Most Sold Book Cover" class="max-w-xs mt-2">
                            @endif
                        </div>

                        <!-- Most Sold Books Chart Card -->
                        <div class="col-span-1 bg-white overflow-hidden shadow-lg sm:rounded-lg rounded-md">
                            <h2 class="text-lg font-semibold text-blue-600 mb-4">Most Sold Books by Title for Each Month</h2>
                            <canvas id="most-sold-books-chart"></canvas>
                        </div>

                        <!-- Books Sold by Genre Card -->
                        <div class="col-span-1 bg-white overflow-hidden shadow-lg sm:rounded-lg rounded-md">
                            <h2 class="text-lg font-semibold text-blue-600 mb-4">Books Sold by Genre</h2>
                            <canvas id="genre-chart"></canvas>
                        </div>
                    </div>

                    <!-- User Age Groups Chart Card -->
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg rounded-md mt-8">
                        <h2 class="text-lg font-semibold text-blue-600">User Age Groups</h2>
                        <canvas id="age-group-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Age Group Chart Script -->
    <script>
        var ageGroupData = {
            labels: {!! json_encode(array_keys($userCountsByAgeGroup)) !!},
            datasets: [{
                label: 'User Count',
                data: {!! json_encode(array_values($userCountsByAgeGroup)) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
            }],
        };

        var ageGroupOptions = {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'User Count',
                    },
                },
                x: {
                    title: {
                        display: true,
                        text: 'Age Group',
                    },
                },
            },
        };

        var ageGroupCtx = document.getElementById('age-group-chart').getContext('2d');

        if (ageGroupData.labels.length === 0 || ageGroupData.datasets.length === 0) {
            // Log an error message if the data is empty
            console.error('Age group data is empty or not properly formatted.');
        } else {
            new Chart(ageGroupCtx, {
                type: 'bar',
                data: ageGroupData,
                options: ageGroupOptions
            });
        }
    </script>


    <!-- Genre Pie Chart Script -->
    <script>
        var genreData = {
            labels: {!! json_encode($genreLabels) !!},
            datasets: [{
                data: {!! json_encode($genreCounts) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1,
            }],
        };

        var genreOptions = {
            responsive: true
        };

        var genreCtx = document.getElementById('genre-chart').getContext('2d');

        if (genreData.labels.length === 0 || genreData.datasets.length === 0) {
            // Log an error message if the data is empty
            console.error('Genre data is empty or not properly formatted.');
        } else {
            new Chart(genreCtx, {
                type: 'pie',
                data: genreData,
                options: genreOptions
            });
        }
    </script>
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
