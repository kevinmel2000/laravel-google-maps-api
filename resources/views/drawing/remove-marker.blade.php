@extends('layouts.app')

@section('title', 'Remove markers')

@section('content')
    <h1>
        @include('_shared.button-source-code')

        Remove markers
    </h1>

    <div id="floating-panel">
        <input type="button" onclick="clearMarkers();" value="Hide Markers">
        <input type="button" onclick="showMarkers();" value="Show All Markers">
        <input type="button" onclick="deleteMarkers();" value="Delete Markers">
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
        // In the following example, markers appear when the user clicks on the map.
        // The markers are stored in an array.
        // The user can then click an option to hide, show or delete the markers.
        var map;
        var markers = [];

        function initMap() {
            var surabaya = {lat: -7.265757, lng: 112.734146};

            map = new google.maps.Map(document.getElementById('map'), {
                zoom        : 12,
                center      : surabaya,
                mapTypeId   : 'terrain'
            });

            // This event listener will call addMarker() when the map is clicked.
            map.addListener('click', function(event) {
                addMarker(event.latLng);
            });

            // Adds a marker at the center of the map.
            addMarker(surabaya);
        }

        // Adds a marker to the map and push to the array.
        function addMarker(location) {
            var marker = new google.maps.Marker({
                position    : location,
                map         : map
            });

            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Shows any markers currently in the array.
        function showMarkers() {
            setMapOnAll(map);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush

@section('source-code-javascript')

    &lt;script&gt;
        // In the following example, markers appear when the user clicks on the map.
        // The markers are stored in an array.
        // The user can then click an option to hide, show or delete the markers.
        var map;
        var markers = [];

        function initMap() {
            var surabaya = {lat: -7.265757, lng: 112.734146};

            map = new google.maps.Map(document.getElementById(&apos;map&apos;), {
                zoom        : 12,
                center      : surabaya,
                mapTypeId   : &apos;terrain&apos;
            });

            // This event listener will call addMarker() when the map is clicked.
            map.addListener(&apos;click&apos;, function(event) {
                addMarker(event.latLng);
            });

            // Adds a marker at the center of the map.
            addMarker(surabaya);
        }

        // Adds a marker to the map and push to the array.
        function addMarker(location) {
            var marker = new google.maps.Marker({
                position    : location,
                map         : map
            });

            markers.push(marker);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i &lt; markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Shows any markers currently in the array.
        function showMarkers() {
            setMapOnAll(map);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }
    &lt;/script&gt;

    &lt;script async defer
        src=&quot;https://maps.googleapis.com/maps/api/js?key={{ $browser_key_placeholder }}&amp;callback=initMap&quot;&gt;&lt;/script&gt;
@endsection

@section('source-code-css')

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
@endsection

@section('source-code-html')

    <div id="floating-panel">
        <input type="button" onclick="clearMarkers();" value="Hide Markers">
        <input type="button" onclick="showMarkers();" value="Show All Markers">
        <input type="button" onclick="deleteMarkers();" value="Delete Markers">
    </div>

    <div id="map"></div>
@endsection
