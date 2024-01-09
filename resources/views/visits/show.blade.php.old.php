@extends('layouts.app')

@section('content')




{{--  --}}
{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.13.1/OpenLayers.js"></script>
<script>
    // Initialize the map with OpenLayers
    var map = new OpenLayers.Map("map");

    // Add the OpenStreetMap layer to the map
    var osmLayer = new OpenLayers.Layer.OSM();
    map.addLayer(osmLayer);

    // Create a marker layer for the shop location
    var markerLayer = new OpenLayers.Layer.Markers("Markers");
    map.addLayer(markerLayer);

    // Extract the longitude and latitude values from the location field
    var location = "{{ $visit2->location }}";
    var lonLat = location.split(',').map(parseFloat);

    // Set the shop location on the map
    var shopLocation = new OpenLayers.LonLat(lonLat[0], lonLat[1]).transform(
        new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
        map.getProjectionObject() // to Spherical Mercator Projection
    );
    var zoom = 16;
    map.setCenter(shopLocation, zoom);

    // Add a marker to the map at the shop location
    var marker = new OpenLayers.Marker(shopLocation);
    markerLayer.addMarker(marker);
</script>
{{-- @endsection --}}


{{--  --}}

<div style="padding:5%"></div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Shop Details') }}</div>

                @foreach ($visit as $v)
                    
                @endforeach

                <div class="card-body">
                    <h2>{{ $v->shop_name }}</h2>
                    <p>Visit Date: <b> {{ \Carbon\Carbon::parse($v->created_at)->format('D, d M Y H:i') }} </b></p> <br>
                    <p>Address: {{ $v->shop_address }}</p>
                    <p>Region: {{ $v->shop_region }}</p>
                    <p>City: {{ $v->shop_city }}</p>
                    <p>District: {{ $v->shop_district }}</p>
                    <p>Subdistrict: {{ $v->shop_subdistrict }}</p>

                    <h2>Visit Details</h2>
                    <p>Location: {{ $v->location }}</p>
                    <p>Notes: {{ $v->notes }}</p>
                    <p>Materials: {{ $v->materials }}</p>
                    {{-- <p>Materials: {{ implode(', ', $v->materials) }}</p> --}}

                    @if ($v->photo)
                        <p>Photo Toko Depan: </p>
                        <img src="{{ asset('storage/' . $v->photo) }}" alt="Photo Toko Depan">
                        
                    @endif

                  
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
