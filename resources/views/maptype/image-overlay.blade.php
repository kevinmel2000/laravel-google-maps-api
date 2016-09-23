@extends('layouts.app')

@section('title', 'Overlaying an image map type')

@section('content')
    <h1>Overlaying an image map type</h1>

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
                zoom    : 18,
                center  : {lat: 37.783, lng: -122.403}
            });

            var bounds = {
                17: [[20969, 20970], [50657, 50658]],
                18: [[41939, 41940], [101315, 101317]],
                19: [[83878, 83881], [202631, 202634]],
                20: [[167757, 167763], [405263, 405269]]
            };

            var imageMapType = new google.maps.ImageMapType({
                getTileUrl: function(coord, zoom) {
                    if (zoom < 17 || zoom > 20 ||
                        bounds[zoom][0][0] > coord.x || coord.x > bounds[zoom][0][1] ||
                        bounds[zoom][1][0] > coord.y || coord.y > bounds[zoom][1][1]) {

                        return null;
                    }

                    return [
                        'http://www.gstatic.com/io2010maps/tiles/5/L2_',
                        zoom, '_', coord.x, '_', coord.y, '.png'
                    ].join('');
                },
                tileSize: new google.maps.Size(256, 256)
            });

            map.overlayMapTypes.push(imageMapType);
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}&callback=initMap"></script>
@endpush