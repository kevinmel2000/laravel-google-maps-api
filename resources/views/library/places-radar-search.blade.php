@extends('layouts.app')

@section('title', 'Search 200 places with Radar Search')

@section('content')
    <h1>
        @include('_shared.button-source-code')

        Search 200 places with Radar Search
    </h1>

    <div id="map"></div>
@endsection

@push('css')
    <style>
        #map { height: 500px; }
    </style>
@endpush

@push('js')
    <script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var map;
        var infoWindow;
        var service;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -33.867, lng: 151.206},
                zoom: 15,
                styles: [
                    {
                        stylers: [{ visibility: 'simplified' }]
                    },
                    {
                        elementType: 'labels',
                        stylers: [{ visibility: 'off' }]
                    }
                ]
            });

            infoWindow  = new google.maps.InfoWindow();
            service     = new google.maps.places.PlacesService(map);

            // The idle event is a debounced event, so we can query & listen without
            // throwing too many requests at the server.
            map.addListener('idle', performSearch);
        }

        function performSearch() {
            var request = {
                bounds: map.getBounds(),
                keyword: 'best view'
            };

            service.radarSearch(request, callback);
        }

        function callback(results, status) {
            if (status !== google.maps.places.PlacesServiceStatus.OK) {
                console.error(status);
                return;
            }

            for (var i = 0, result; result = results[i]; i++) {
                addMarker(result);
            }
        }

        function addMarker(place) {
            var marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location,
                icon: {
                    url: 'http://maps.gstatic.com/mapfiles/circle.png',
                    anchor: new google.maps.Point(10, 10),
                    scaledSize: new google.maps.Size(10, 17)
                }
            });

            google.maps.event.addListener(marker, 'click', function() {
                service.getDetails(place, function(result, status) {
                    if (status !== google.maps.places.PlacesServiceStatus.OK) {
                        console.error(status);
                        return;
                    }

                    infoWindow.setContent(result.name);
                    infoWindow.open(map, marker);
                });
            });
        }
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap&libraries=places,visualization"></script>
@endpush
