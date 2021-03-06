<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        Service <span class="caret"></span>
    </a>
    <ul class="dropdown-menu multi-level">
        <li class="dropdown-submenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Geocoding</a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('service.geocoding') }}">Geocoding simple</a></li>
                <li><a href="{{ route('service.geocoding-reverse') }}">Reverse Geocoding</a></li>
                <li><a href="{{ route('service.geocoding-reverse-placeid') }}">Reverse Geocoding by Place ID</a></li>
                <li><a href="{{ route('service.geocoding-component-restriction') }}">Geocoding Component Restriction</a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Direction</a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('service.direction') }}">Direction simple</a></li>
                <li><a href="{{ route('service.direction-panel') }}">Direction with setPanel()</a></li>
                <li><a href="{{ route('service.direction-complex') }}">Direction (complex)</a></li>
                <li><a href="{{ route('service.travel-mode') }}">Travel Mode</a></li>
                <li><a href="{{ route('service.waypoint') }}">Waypoints</a></li>
                <li><a href="{{ route('service.direction-draggable') }}">Draggable direction</a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Elevation</a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('service.elevation') }}">Elevation simple</a></li>
                <li><a href="{{ route('service.elevation-path') }}">Showing elevation along path</a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Street View</a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('service.streetview') }}">Street View container</a></li>
                <li><a href="{{ route('service.streetview-sidebyside') }}">Street View side-by-side</a></li>
                <li><a href="{{ route('service.streetview-overlay') }}">Overlays within street view</a></li>
                <li><a href="{{ route('service.streetview-event') }}">Street View events</a></li>
                <li><a href="{{ route('service.streetview-control') }}">Street View controls</a></li>
                <li><a href="{{ route('service.streetview-data') }}">Accessing street view data</a></li>
                <li><a href="{{ route('service.streetview-panorama') }}">Custom panorama</a></li>
                <li><a href="{{ route('service.streetview-panorama-tiles') }}">Custom panorama tiles</a></li>
            </ul>
        </li>
        <li class="divider"></li>
        <li class="dropdown-submenu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Others</a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('service.distance-matrix') }}">Distance Matrix</a></li>
                <li><a href="{{ route('service.region-biasing-es') }}">Region code biasing (ES)</a></li>
                <li><a href="{{ route('service.region-biasing-us') }}">Region code biasing (US)</a></li>
                <li><a href="{{ route('service.maximum-zoom') }}">Maximum zoom imagery</a></li>
            </ul>
        </li>
    </ul>
</li>
