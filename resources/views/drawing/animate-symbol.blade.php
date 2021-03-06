@extends('layouts.app')

@section('title', 'Animating symbol')

@section('content')
    <h1>
        @include('_shared.button-source-code')

        Animating symbol
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
                center      : {lat: -23.363, lng: 131.044},
                zoom        : 7,
                mapTypeId   : 'terrain'
            });

            var lineSymbol = {
                path        : google.maps.SymbolPath.CIRCLE,
                scale       : 8,
                strokeColor : '#f00'
            };

            var line = new google.maps.Polyline({
                path: [
                    {lat: -25.363, lng: 131.044},
                    {lat: -22.363, lng: 131.044},
                ],
                icons: [{
                    icon    : lineSymbol,
                    offset  : '100%'
                }],
                map: map
            });

            animateCircle(line);
        }

        function animateCircle(line) {
            var count = 0;

            window.setInterval(function() {
                count = (count + 1) % 200;

                var icons = line.get('icons');
                icons[0].offset = (count / 2) + '%';

                line.set('icons', icons);
            }, 20);
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush

@section('source-code-javascript')

    &lt;script&gt;
        function initMap() {
            var map = new google.maps.Map(document.getElementById(&apos;map&apos;), {
                center      : {lat: -23.363, lng: 131.044},
                zoom        : 7,
                mapTypeId   : &apos;terrain&apos;
            });

            var lineSymbol = {
                path        : google.maps.SymbolPath.CIRCLE,
                scale       : 8,
                strokeColor : &apos;#f00&apos;
            };

            var line = new google.maps.Polyline({
                path: [
                    {lat: -25.363, lng: 131.044},
                    {lat: -22.363, lng: 131.044},
                ],
                icons: [{
                    icon    : lineSymbol,
                    offset  : &apos;100%&apos;
                }],
                map: map
            });

            animateCircle(line);
        }

        function animateCircle(line) {
            var count = 0;

            window.setInterval(function() {
                count = (count + 1) % 200;

                var icons = line.get(&apos;icons&apos;);
                icons[0].offset = (count / 2) + &apos;%&apos;;

                line.set(&apos;icons&apos;, icons);
            }, 20);
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
