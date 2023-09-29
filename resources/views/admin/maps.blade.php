@extends('layouts\admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container">
                    <div id="map" style="width: 100%; height: 700px;"></div>

                    <script>
                        // Initialize the map
                        var map = L.map('map').setView([7.8731, 80.7718], 7);

                        // Add a tile layer to the map (you can choose a different tile provider)
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        // Fetch user locations and add markers
                        @foreach ($users as $user)
                        @if ($user->city)
                        var userIcon = L.icon({
                            iconUrl: '{{ asset('img/3d-fluency-books.png') }}', // image location
                            iconSize: [32, 32], // icon size
                            iconAnchor: [16, 32], // point of the icon which will correspond to marker's location
                            popupAnchor: [0, -32] // point from which the popup should open relative to the iconAnchor
                        });

                        L.marker([{{ $user->latitude }}, {{ $user->longitude }}], { icon: userIcon })
                            .addTo(map)
                            .bindPopup("User: {{ $user->name }}<br>Location: {{ $user->city->name }}");
                        @endif
                        @endforeach

                        var userData = @json($users); // Output user data to the browser console for debugging
                        console.log(userData);
                    </script>




                </div>
            </div>
        </div>
    </div>
@endsection
