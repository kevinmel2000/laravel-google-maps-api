@extends('layouts.app')

@section('html_tag_attributes', 'dir="rtl"')
@section('title', 'Right-to-Left Languages')

@section('content')
    <h1>
        @include('_shared.button-source-code')

        Right-to-Left Languages
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
            var cairo = {lat: 30.064742, lng: 31.249509};

            var map = new google.maps.Map(document.getElementById('map'), {
                scaleControl: true,
                center: cairo,
                zoom: 10
            });

            var infowindow = new google.maps.InfoWindow;

            infowindow.setContent('<b>القاهرة</b>');

            var marker = new google.maps.Marker({map: map, position: cairo});
                marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&language=ar&region=EG&callback=initMap"></script>
@endpush

@section('source-code-javascript')

    &lt;script&gt;
        // This example displays a map with the language set to Arabic and the regions set to Egypt.
        // These settings are specified in the HTML script element when loading the Google Maps API.
        // Setting the language shows the map in the language of your choice.
        // Setting the region biases the geocoding results to that region.
        // In addition, the page&apos;s html element sets the text direction to right-to-left.

        function initMap() {
            var cairo = {lat: 30.064742, lng: 31.249509};

            var map = new google.maps.Map(document.getElementById(&apos;map&apos;), {
                scaleControl: true,
                center: cairo,
                zoom: 10
            });

            var infowindow = new google.maps.InfoWindow;

            infowindow.setContent(&apos;&lt;b&gt;القاهرة&lt;/b&gt;&apos;);

            var marker = new google.maps.Marker({map: map, position: cairo});
                marker.addListener(&apos;click&apos;, function() {
                infowindow.open(map, marker);
            });
        }
    &lt;/script&gt;

    &lt;script async defer
        src=&quot;https://maps.googleapis.com/maps/api/js?key={{ $browser_key_placeholder }}&amp;language=ar&amp;region=EG&amp;callback=initMap&quot;&gt;&lt;/script&gt;
@endsection

@section('source-code-css')
    #map { height: 500px; }
@endsection

@section('source-code-html')
    <div id="map"></div>
@endsection
