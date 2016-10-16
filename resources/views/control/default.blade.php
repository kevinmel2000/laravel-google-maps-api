@extends('layouts.app')

@section('title', 'Default controllers')

@section('content')
    <h1>Default controllers</h1>

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
    }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush
