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
                    <div id="revenue-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var data = {
            labels: {!! json_encode($labels) !!},
            series: [
                {!! json_encode($revenueValues) !!}
            ]
        };
        var options = {
            // Customize chart options as needed
        };
        new Chartist.Line('#revenue-chart', data, options);
    </script>
@endsection
