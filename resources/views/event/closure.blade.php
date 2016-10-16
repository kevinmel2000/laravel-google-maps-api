@extends('layouts.app')

@section('title', 'Using closures in event listeners')

@section('content')
    <h1>Using closures in event listeners</h1>

    <div id="map"></div>
@endsection

@push('css')
    <style>
        #map { height: 500px; }
    </style>
@endpush

@push('js')
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -7.265757, lng: 112.734146},
                zoom: 10
            });

            var bounds = {
                north: -7.232384,
                south: -7.232043,
                east: 112.809871,
                west: 112.667393
            };

            // Display the area between the location southWest and northEast.
            map.fitBounds(bounds);

            // Add 5 markers to map at random locations.
            // For each of these markers, give them a title with their index, and when
            // they are clicked they should open an infowindow with text from a secret
            // message.
            var secretMessages = ['This', 'is', 'the', 'secret', 'message'];
            var lngSpan = bounds.east - bounds.west;
            var latSpan = bounds.north - bounds.south;

            for (var i = 0; i < secretMessages.length; ++i) {
                var marker = new google.maps.Marker({
                    position: {
                        lat: bounds.south + latSpan * Math.random(),
                        lng: bounds.west + lngSpan * Math.random()
                    },
                    map: map
                });

                attachSecretMessage(marker, secretMessages[i]);
            }
        }

        // Attaches an info window to a marker with the provided message. When the
        // marker is clicked, the info window will open with the secret message.
        function attachSecretMessage(marker, secretMessage) {
            var infowindow = new google.maps.InfoWindow({
                content: secretMessage
            });

            marker.addListener('click', function() {
                infowindow.open(marker.get('map'), marker);
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush
