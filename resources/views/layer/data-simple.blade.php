@extends('layouts.app')

@section('title', 'Data Layer: Simple')

@section('content')
    <h1>Data Layer: Simple</h1>

    <div id="map"></div>
@endsection

@push('css')
    <style>
        #map { height: 500px; }
    </style>
@endpush

@push('js')
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom    : 4,
                center  : {lat: -28, lng: 137}
            });

            // NOTE: This uses cross-domain XHR, and may not work on older browsers.
            map.data.loadGeoJson('https://storage.googleapis.com/mapsdevsite/json/google.json');
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush