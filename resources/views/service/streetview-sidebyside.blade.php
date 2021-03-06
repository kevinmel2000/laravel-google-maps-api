@extends('layouts.app')

@section('title', 'Street View side-by-side')

@section('content')
    <h1>
        @include('_shared.button-source-code')

        Street View side-by-side
    </h1>

    <div id="map"></div>
    <div id="pano"></div>
@endsection

@push('css')
    <style>
        #map, #pano {
            float: left;
            height: 500px;
            width: 50%;
        }
    </style>
@endpush

@push('js')
    <script>
        function initialize() {
            var surabaya = {lat: -7.2459509, lng: 112.7386515};

            var map = new google.maps.Map(document.getElementById('map'), {
                center  : surabaya,
                zoom    : 14
            });

            var panorama = new google.maps.StreetViewPanorama(
                document.getElementById('pano'),
                {
                    position: surabaya,
                    pov: {
                        heading: 34,
                        pitch: 10
                    }
                }
            );

            map.setStreetView(panorama);
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initialize"></script>
@endpush

@section('source-code-javascript')

    &lt;script&gt;
        function initialize() {
            var surabaya = {lat: -7.2459509, lng: 112.7386515};

            var map = new google.maps.Map(document.getElementById(&apos;map&apos;), {
                center  : surabaya,
                zoom    : 14
            });

            var panorama = new google.maps.StreetViewPanorama(
                document.getElementById(&apos;pano&apos;),
                {
                    position: surabaya,
                    pov: {
                        heading: 34,
                        pitch: 10
                    }
                }
            );

            map.setStreetView(panorama);
        }
    &lt;/script&gt;

    &lt;script async defer src=&quot;https://maps.googleapis.com/maps/api/js?key={{ $browser_key_placeholder }}&amp;callback=initialize&quot;&gt;&lt;/script&gt;
@endsection

@section('source-code-css')

    #map, #pano {
        float: left;
        height: 500px;
        width: 50%;
    }
@endsection

@section('source-code-html')

    &lt;div id=&quot;map&quot;&gt;&lt;/div&gt;
    &lt;div id=&quot;pano&quot;&gt;&lt;/div&gt;
@endsection
