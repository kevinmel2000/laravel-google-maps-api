@extends('layouts.app')

@section('title', 'KML Layers')

@section('content')
    <h1>
        @include('_shared.button-source-code')

        KML Layers
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
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom    : 11,
                center  : {lat: 41.876, lng: -87.624}
            });

            var ctaLayer = new google.maps.KmlLayer({
                url: 'http://googlemaps.github.io/js-v2-samples/ggeoxml/cta.kml',
                map: map
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush
