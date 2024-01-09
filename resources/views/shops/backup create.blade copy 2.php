@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script>
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
  
</html>


<div class="container">

    <h1>Tambah data toko baru</h1>


    <form method="POST" action="{{ route('shops.store') }}">
        @csrf

        <div class="form-group">
            <label for="shop_name">Nama toko:</label>
            <input type="text" class="form-control" id="shop_name" name="shop_name" required>
        </div>


        <div class="form-group">
            <label for="shop_address">Alamat toko:</label>
            <input type="text" class="form-control" id="shop_address" name="shop_address" required>
        </div>
           

        @php
            $provinces = new App\Http\Controllers\DependantDropdownController;
            $provinces= $provinces->provinces();
        @endphp

        {{-- 1 --}}
        <div class="form-group">
            <label for="province">Provinsi</label>
            <select class="form-control" name="provinsi" id="provinsi">
                <option value="">Pilih Provinsi</option>
                @foreach($provinces as $item)
                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subdistrict">Kabupaten / Kota</label>
            <select class="form-control" name="kota" id="kota">
                <option value="">==Pilih Salah Satu==</option>
            </select>                        
        </div>

        <div class="form-group">
            <label for="subdistrict">Kecamatan</label>
            <select class="form-control" name="kecamatan" id="kecamatan">
                <option value="">==Pilih Salah Satu==</option>
            </select>
        </div>

        <div class="form-group">
            <label for="subdistrict">Desa</label>
            <select class="form-control" name="desa" id="desa">
                <option value="">==Pilih Salah Satu==</option>
            </select>
        </div>

        


        {{-- <br><br>
        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" class="form-control"><br><br>
        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" class="form-control"><br><br>
        <div id="map"></div>
        <br><br> --}}

        {{-- <button onclick="getCurrentLocation()" class="btn btn-primary">Get Current Location</button> --}}

        <br><br><br><br>




        <button type="submit" class="btn btn-primary">Create Shop</button>

</div>



{{-- map --}}

<br><br><br><br><br>
{{-- 
<!DOCTYPE html>
<html>
<head> --}}
    {{-- <title>OpenStreetMap with OpenLayers</title> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.13.1/theme/default/style.css" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.13.1/OpenLayers.js"></script>
{{-- </head> --}}
{{-- <body> --}}
    <div id="map" style="width:100%; height:500px;"></div>
    <script src="{{ asset('js/map.js') }}"></script>
{{-- </body> --}}
{{-- </html> --}}
<br><br><br><br><br>

<script>

    // Initialize the map with OpenLayers
var map = new OpenLayers.Map("map");

// Add the OpenStreetMap layer to the map
var osmLayer = new OpenLayers.Layer.OSM();
map.addLayer(osmLayer);

// Create a marker layer for the user's location
var markerLayer = new OpenLayers.Layer.Markers("Markers");
map.addLayer(markerLayer);

// Get the user's current location
if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
        var lonLat = new OpenLayers.LonLat(position.coords.longitude, position.coords.latitude)
            .transform(
                new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                map.getProjectionObject() // to Spherical Mercator Projection
            );
        var zoom = 16;
        map.setCenter(lonLat, zoom);
        
        // Add a marker to the map at the user's location
        var marker = new OpenLayers.Marker(lonLat);
        markerLayer.addMarker(marker);
    });
} else {
    alert("Geolocation is not supported by this browser.");
}


</script>





<script>
    function getCurrentLocation() {
      // Check if the browser supports geolocation
      if (navigator.geolocation) {
        // Get the current position of the user
        navigator.geolocation.getCurrentPosition(function(position) {
          // Create a new LatLng object with the user's location
          var userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
          
          // Set the center of the map to the user's location
          map.setCenter(userLocation);
          
          // Add a marker to the map at the user's location
          var marker = new google.maps.Marker({
            position: userLocation,
            map: map
          });
        });
      } else {
        // Browser doesn't support geolocation
        alert("Geolocation is not supported by this browser.");
      }
    }
    </script>




<script>
    function onChangeSelect(url, id, name) {
        // send ajax request to get the cities of the selected province and append to the select tag
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function (data) {
                $('#' + name).empty();
                $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                $.each(data, function (key, value) {
                    $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    }
    $(function () {
        $('#provinsi').on('change', function () {
            onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
        });
        $('#kota').on('change', function () {
            onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
        })
        $('#kecamatan').on('change', function () {
            onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
        })
    });
</script>


<script>
    function initAutocomplete() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                console.log("No details available for input: '" + place.name + "'");
                return;
            }

            // Set the value of the form input fields
            document.getElementById('address').value = place.formatted_address;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });
    }
</script>


 
    

@endsection



{{-- <h1>Hello World</h1> --}}
