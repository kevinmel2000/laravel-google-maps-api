@extends('layouts.app')

@section('title', 'Deleting a vertex')

@section('content')
    <h1>
        @include('_shared.button-source-code')

        Deleting a vertex
        <small>via context menu</small>
    </h1>

    <span><small class="text-danger">Can <strong>NOT</strong> use 'asyn defer' mode</small></span>

    <div id="map"></div>
@endsection

@push('css')
    <style>
        #map { height: 500px; }

        .delete-menu {
            position: absolute;
            background: white;
            padding: 3px;
            color: #666;
            font-weight: bold;
            border: 1px solid #999;
            font-family: sans-serif;
            font-size: 12px;
            box-shadow: 1px 3px 3px rgba(0, 0, 0, .3);
            margin-top: -10px;
            margin-left: 10px;
            cursor: pointer;
        }

        .delete-menu:hover {
            background: #eee;
        }
    </style>
@endpush

@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $browser_key }}"></script>

    <script>
        function initialize() {
            var mapOptions = {
                zoom        : 3,
                center      : new google.maps.LatLng(0, -180),
                mapTypeId   : 'terrain'
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var flightPlanCoordinates = [
                new google.maps.LatLng(37.772323, -122.214897),
                new google.maps.LatLng(21.291982, -157.821856),
                new google.maps.LatLng(-18.142599, 178.431),
                new google.maps.LatLng(-27.46758, 153.027892)
            ];

            var flightPath = new google.maps.Polyline({
                path            : flightPlanCoordinates,
                editable        : true,
                strokeColor     : '#FF0000',
                strokeOpacity   : 1.0,
                strokeWeight    : 2,
                map             : map
            });

            var deleteMenu = new DeleteMenu();

            google.maps.event.addListener(flightPath, 'rightclick', function(e) {
                // Check if click was on a vertex control point
                if (e.vertex == undefined) {
                    return;
                }

                deleteMenu.open(map, flightPath.getPath(), e.vertex);
            });
        }

        function DeleteMenu() {
            this.div_           = document.createElement('div');
            this.div_.className = 'delete-menu';
            this.div_.innerHTML = 'Delete';

            var menu = this;

            google.maps.event.addDomListener(this.div_, 'click', function() {
                menu.removeVertex();
            });
        }

        DeleteMenu.prototype = new google.maps.OverlayView();

        DeleteMenu.prototype.onAdd = function() {
            var deleteMenu  = this;
            var map         = this.getMap();

            this.getPanes().floatPane.appendChild(this.div_);

            this.divListener_ = google.maps.event.addDomListener(map.getDiv(), 'mousedown', function(e) {
                if (e.target != deleteMenu.div_) {
                    deleteMenu.close();
                }
            },
            true);
        };

        DeleteMenu.prototype.onRemove = function() {
            google.maps.event.removeListener(this.divListener_);
            this.div_.parentNode.removeChild(this.div_);

            this.set('position');
            this.set('path');
            this.set('vertex');
        };

        DeleteMenu.prototype.close = function() {
            this.setMap(null);
        };

        DeleteMenu.prototype.draw = function() {
            var position    = this.get('position');
            var projection  = this.getProjection();

            if (!position || !projection) {
                return;
            }

            var point = projection.fromLatLngToDivPixel(position);

            this.div_.style.top = point.y + 'px';
            this.div_.style.left = point.x + 'px';
        };

        DeleteMenu.prototype.open = function(map, path, vertex) {
            this.set('position', path.getAt(vertex));
            this.set('path', path);
            this.set('vertex', vertex);
            this.setMap(map);
            this.draw();
        };

        DeleteMenu.prototype.removeVertex = function() {
            var path    = this.get('path');
            var vertex  = this.get('vertex');

            if (!path || vertex == undefined) {
                this.close();
                return;
            }

            path.removeAt(vertex);
            this.close();
        };

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endpush

@section('source-code-javascript')

    &lt;script src=&quot;https://maps.googleapis.com/maps/api/js?key={{ $browser_key_placeholder }}&quot;&gt;&lt;/script&gt;

    &lt;script&gt;
        function initialize() {
            var mapOptions = {
                zoom        : 3,
                center      : new google.maps.LatLng(0, -180),
                mapTypeId   : &apos;terrain&apos;
            };

            var map = new google.maps.Map(document.getElementById(&apos;map&apos;), mapOptions);

            var flightPlanCoordinates = [
                new google.maps.LatLng(37.772323, -122.214897),
                new google.maps.LatLng(21.291982, -157.821856),
                new google.maps.LatLng(-18.142599, 178.431),
                new google.maps.LatLng(-27.46758, 153.027892)
            ];

            var flightPath = new google.maps.Polyline({
                path            : flightPlanCoordinates,
                editable        : true,
                strokeColor     : &apos;#FF0000&apos;,
                strokeOpacity   : 1.0,
                strokeWeight    : 2,
                map             : map
            });

            var deleteMenu = new DeleteMenu();

            google.maps.event.addListener(flightPath, &apos;rightclick&apos;, function(e) {
                // Check if click was on a vertex control point
                if (e.vertex == undefined) {
                    return;
                }

                deleteMenu.open(map, flightPath.getPath(), e.vertex);
            });
        }

        /**
        * A menu that lets a user delete a selected vertex of a path.
        * @constructor
        */
        function DeleteMenu() {
            this.div_           = document.createElement(&apos;div&apos;);
            this.div_.className = &apos;delete-menu&apos;;
            this.div_.innerHTML = &apos;Delete&apos;;

            var menu = this;

            google.maps.event.addDomListener(this.div_, &apos;click&apos;, function() {
                menu.removeVertex();
            });
        }

        DeleteMenu.prototype = new google.maps.OverlayView();

        DeleteMenu.prototype.onAdd = function() {
            var deleteMenu  = this;
            var map         = this.getMap();

            this.getPanes().floatPane.appendChild(this.div_);

            // mousedown anywhere on the map except on the menu div will close the
            // menu.
            this.divListener_ = google.maps.event.addDomListener(map.getDiv(), &apos;mousedown&apos;, function(e) {
                if (e.target != deleteMenu.div_) {
                    deleteMenu.close();
                }
            },
            true);
        };

        DeleteMenu.prototype.onRemove = function() {
            google.maps.event.removeListener(this.divListener_);
            this.div_.parentNode.removeChild(this.div_);

            // clean up
            this.set(&apos;position&apos;);
            this.set(&apos;path&apos;);
            this.set(&apos;vertex&apos;);
        };

        DeleteMenu.prototype.close = function() {
            this.setMap(null);
        };

        DeleteMenu.prototype.draw = function() {
            var position    = this.get(&apos;position&apos;);
            var projection  = this.getProjection();

            if (!position || !projection) {
                return;
            }

            var point = projection.fromLatLngToDivPixel(position);

            this.div_.style.top = point.y + &apos;px&apos;;
            this.div_.style.left = point.x + &apos;px&apos;;
        };

        /**
        * Opens the menu at a vertex of a given path.
        */
        DeleteMenu.prototype.open = function(map, path, vertex) {
            this.set(&apos;position&apos;, path.getAt(vertex));
            this.set(&apos;path&apos;, path);
            this.set(&apos;vertex&apos;, vertex);
            this.setMap(map);
            this.draw();
        };

        /**
        * Deletes the vertex from the path.
        */
        DeleteMenu.prototype.removeVertex = function() {
            var path    = this.get(&apos;path&apos;);
            var vertex  = this.get(&apos;vertex&apos;);

            if (!path || vertex == undefined) {
                this.close();
                return;
            }

            path.removeAt(vertex);
            this.close();
        };

        google.maps.event.addDomListener(window, &apos;load&apos;, initialize);
    &lt;/script&gt;
@endsection

@section('source-code-css')

    #map { height: 500px; }

    .delete-menu {
        position: absolute;
        background: white;
        padding: 3px;
        color: #666;
        font-weight: bold;
        border: 1px solid #999;
        font-family: sans-serif;
        font-size: 12px;
        box-shadow: 1px 3px 3px rgba(0, 0, 0, .3);
        margin-top: -10px;
        margin-left: 10px;
        cursor: pointer;
    }

    .delete-menu:hover {
        background: #eee;
    }
@endsection

@section('source-code-html')
    <div id="map"></div>
@endsection
