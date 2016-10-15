@extends('layouts.app')

@section('title', 'Places: Direction')

@section('content')
    <h1>Places: Direction</h1>

    <div id="map"></div>

    <input id="origin-input" class="controls" type="text" placeholder="Enter an origin location">

    <input id="destination-input" class="controls" type="text" placeholder="Enter a destination location">

    <div id="mode-selector" class="controls">
        <input type="radio" name="type" id="changemode-walking" checked="checked">
        <label for="changemode-walking">Walking</label>

        <input type="radio" name="type" id="changemode-transit">
        <label for="changemode-transit">Transit</label>

        <input type="radio" name="type" id="changemode-driving">
        <label for="changemode-driving">Driving</label>
    </div>
@endsection

@push('css')
    <style>
        #map { height: 500px; }

        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #origin-input,
        #destination-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 200px;
        }

        #origin-input:focus,
        #destination-input:focus {
            border-color: #4d90fe;
        }

        #mode-selector {
            color: #fff;
            background-color: #4d90fe;
            margin-left: 12px;
            padding: 5px 11px 0px 11px;
        }

        #mode-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
    </style>
@endpush

@push('js')
    <script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        function initMap() {
            var origin_place_id = null;
            var destination_place_id = null;
            var travel_mode = 'WALKING';

            var map = new google.maps.Map(document.getElementById('map'), {
                mapTypeControl: false,
                center: {lat: -33.8688, lng: 151.2195},
                zoom: 13
            });

            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            directionsDisplay.setMap(map);

            var origin_input = document.getElementById('origin-input');
            var destination_input = document.getElementById('destination-input');
            var modes = document.getElementById('mode-selector');

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin_input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(destination_input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(modes);

            var origin_autocomplete = new google.maps.places.Autocomplete(origin_input);

            origin_autocomplete.bindTo('bounds', map);

            var destination_autocomplete = new google.maps.places.Autocomplete(destination_input);

            destination_autocomplete.bindTo('bounds', map);

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, mode) {
                var radioButton = document.getElementById(id);

                radioButton.addEventListener('click', function() {
                    travel_mode = mode;
                });
            }

            setupClickListener('changemode-walking', 'WALKING');
            setupClickListener('changemode-transit', 'TRANSIT');
            setupClickListener('changemode-driving', 'DRIVING');

            function expandViewportToFitPlace(map, place) {
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
            }

            origin_autocomplete.addListener('place_changed', function() {
                var place = origin_autocomplete.getPlace();

                if ( ! place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                expandViewportToFitPlace(map, place);

                // If the place has a geometry, store its place ID and route if we have
                // the other place ID
                origin_place_id = place.place_id;

                route(
                    origin_place_id,
                    destination_place_id,
                    travel_mode,
                    directionsService,
                    directionsDisplay
                );
            });

            destination_autocomplete.addListener('place_changed', function() {
                var place = destination_autocomplete.getPlace();

                if ( ! place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                expandViewportToFitPlace(map, place);

                // If the place has a geometry, store its place ID and route if we have
                // the other place ID
                destination_place_id = place.place_id;

                route(
                    origin_place_id,
                    destination_place_id,
                    travel_mode,
                    directionsService,
                    directionsDisplay
                );
            });

            function route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay) {
                if ( ! origin_place_id || ! destination_place_id) {
                    return;
                }

                directionsService.route(
                    {
                        origin: {'placeId': origin_place_id},
                        destination: {'placeId': destination_place_id},
                        travelMode: travel_mode
                    },
                    function(response, status) {
                        if (status === 'OK') {
                            directionsDisplay.setDirections(response);
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    }
                );
            }
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $server_key }}&libraries=places&callback=initMap"></script>
@endpush
