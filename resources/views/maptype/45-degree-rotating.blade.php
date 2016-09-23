@extends('layouts.app')

@section('title', 'Rotating 45&deg; imagery')

@section('content')
    <h1>Rotating 45&deg; imagery</h1>

    <div id="floating-panel">
        <input type="button" value="Auto Rotate" onclick="autoRotate();">
    </div>

    <div id="map"></div>
@endsection

@push('css')
    <style>
        #map { height: 500px; }

        #floating-panel {
            position: absolute;
            top: 10px;
            left: 35%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
@endpush

@push('js')
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center      : {lat: 45.518, lng: -122.672},
                zoom        : 18,
                mapTypeId   : 'satellite',
                heading     : 90,
                tilt        : 45
            });
        }

        function rotate90() {
            var heading = map.getHeading() || 0;

            map.setHeading(heading + 90);
        }

        function autoRotate() {
            // Determine if we're showing aerial imagery.
            if (map.getTilt() !== 0) {
                window.setInterval(rotate90, 3000);
            }
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush
