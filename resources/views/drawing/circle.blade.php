@extends('layouts.app')

@section('title', 'Circle')

@section('content')
    <h1>
        @include('_shared.button-source-code')

        Circle
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
        // This example creates circles on the map, representing populations in North
        // America.

        // First, create an object containing LatLng and population for each city.
        var citymap = {
            chicago: {
                center      : {lat: 41.878, lng: -87.629},
                population  : 2714856
            },
            newyork: {
                center      : {lat: 40.714, lng: -74.005},
                population  : 8405837
            },
            losangeles: {
                center      : {lat: 34.052, lng: -118.243},
                population  : 3857799
            },
            vancouver: {
                center      : {lat: 49.25, lng: -123.1},
                population  : 603502
            }
        };

        function initMap() {
            // Create the map.
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom        : 4,
                center      : {lat: 37.090, lng: -95.712},
                mapTypeId   : 'terrain'
            });

            // Construct the circle for each value in citymap.
            // Note: We scale the area of the circle based on the population.
            for (var city in citymap) {
                // Add the circle for this city to the map.
                var cityCircle = new google.maps.Circle({
                    strokeColor     : '#FF0000',
                    strokeOpacity   : 0.8,
                    strokeWeight    : 2,
                    fillColor       : '#FF0000',
                    fillOpacity     : 0.35,
                    map             : map,
                    center          : citymap[city].center,
                    radius          : Math.sqrt(citymap[city].population) * 100
                });
            }
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush

@section('source-code-javascript')

    &lt;script&gt;
        // This example creates circles on the map, representing populations in North
        // America.

        // First, create an object containing LatLng and population for each city.
        var citymap = {
            chicago: {
                center      : {lat: 41.878, lng: -87.629},
                population  : 2714856
            },
            newyork: {
                center      : {lat: 40.714, lng: -74.005},
                population  : 8405837
            },
            losangeles: {
                center      : {lat: 34.052, lng: -118.243},
                population  : 3857799
            },
            vancouver: {
                center      : {lat: 49.25, lng: -123.1},
                population  : 603502
            }
        };

        function initMap() {
            // Create the map.
            var map = new google.maps.Map(document.getElementById(&apos;map&apos;), {
                zoom        : 4,
                center      : {lat: 37.090, lng: -95.712},
                mapTypeId   : &apos;terrain&apos;
            });

            // Construct the circle for each value in citymap.
            // Note: We scale the area of the circle based on the population.
            for (var city in citymap) {
                // Add the circle for this city to the map.
                var cityCircle = new google.maps.Circle({
                    strokeColor     : &apos;#FF0000&apos;,
                    strokeOpacity   : 0.8,
                    strokeWeight    : 2,
                    fillColor       : &apos;#FF0000&apos;,
                    fillOpacity     : 0.35,
                    map             : map,
                    center          : citymap[city].center,
                    radius          : Math.sqrt(citymap[city].population) * 100
                });
            }
        }
    &lt;/script&gt;

    &lt;script async defer
        src=&quot;https://maps.googleapis.com/maps/api/js?key={{ $browser_key_placeholder }}&amp;callback=initMap&quot;&gt;&lt;/script&gt;
@endsection

@section('source-code-css')
    #map { height: 500px; }
@endsection

@section('source-code-html')
    <div id="map"></div>
@endsection
