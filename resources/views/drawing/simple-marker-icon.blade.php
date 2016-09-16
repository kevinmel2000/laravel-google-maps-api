@extends('layouts.app')

@section('title', 'Simple marker icon')

@section('content')
    <h1>Simple marker icon</h1>

    <div id="map"></div>
@endsection

@push('css')
    <style>
        #map { height: 500px; }
    </style>
@endpush

@push('js')
    <script>
        // This example adds a marker to indicate the position of Bondi Beach in Sydney,
        // Australia.
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom    : 4,
                center  : {lat: -33, lng: 151}
            });

            var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

            var beachMarker = new google.maps.Marker({
                position    : {lat: -33.890, lng: 151.274},
                map         : map,
                icon        : image
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush