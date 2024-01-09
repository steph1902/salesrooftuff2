@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.13.1/theme/default/style.css" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.13.1/OpenLayers.js"></script>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    {{-- <div class="form-group"> --}}
                            
                    <div id="map" style="width: 100%; height: 400px;"></div>

                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          



            <div class="card">
                <div class="card-header">{{ __('Shop Details') }}</div>
                <div class="card-body">
                    <h2>{{ $shop->shop_name }}</h2>
                    <p>Alamat: <b>{{ $shop->shop_address }}</b>  </p>
                    <p>Provinsi: <b>{{ $shop->provinsi }}</b> </p>
                    <p>Kota: <b>{{ $shop->kota }}</b>  </p>
                    <p>Kecamatan:  <b>{{ $shop->kecamatan }}</b> </p>
                    <p>Kelurahan: <b>{{ $shop->kelurahan }}</b>  </p>

                    <h2>Kunjungi toko</h2>
                    {{-- <form action="{{ route('submit.visit') }}" method="POST" enctype="multipart/form-data"> --}}
                    <form action="{{ route('visits.store', $shop->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">

                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" id="location" name="location" required readonly>
                            @error('location')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitude:</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" readonly>
                            @error('latitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="longitude">Longitude:</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" readonly>
                            @error('longitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="notes">Notes:</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            @error('notes')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Marketing Materials:</label><br>


                            <label for="brochure">
                                <input type="checkbox" id="brochure" name="materials[]" value="brochure"> Brochure
                            </label><br>

                            <label for="standing_banner">
                                <input type="checkbox" id="standing_banner" name="materials[]" value="standing_banner"> Standing Banner
                            </label><br>

                            <label for="billboard">
                                <input type="checkbox" id="billboard" name="materials[]" value="billboard"> Billboard
                            </label><br>

                            <label for="hanging_banner">
                                <input type="checkbox" id="hanging_banner" name="materials[]" value="hanging_banner"> Hanging Banner
                            </label><br>

                            <!-- Add checkbox for Sticker Mobil -->
                            <label for="sticker_mobil">
                                <input type="checkbox" id="sticker_mobil" name="materials[]" value="sticker_mobil"> Sticker Mobil
                            </label><br>

                            <!-- Add checkbox for Sample Renceng -->
                            <label for="sample_renceng">
                                <input type="checkbox" id="sample_renceng" name="materials[]" value="sample_renceng"> Sample Renceng
                            </label><br>

                            @error('materials')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <br>
                        <hr>
                        <br>

                        <div class="form-group">
                            <label for="photo">Upload Photo Toko Depan: (1 foto saja)</label>
                            <input type="file" class="form-control-file" id="photo" name="photo">
                            @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="photo">Upload Photo Lain-Lain (bisa banyak foto)</label>
                            <input type="file" class="form-control-file" id="photo" name="photos[]" multiple>
                            @error('photos')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <br>
                        <hr>
                        <br>

                        <button type="submit" class="btn btn-primary">Submit</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        </div>
    </div>
</div>



<script>
    // Initialize the map with OpenLayers
    var map = new OpenLayers.Map("map");

    // Add the OpenStreetMap layer to the map
    var osmLayer = new OpenLayers.Layer.OSM();
    map.addLayer(osmLayer);

    // Create a marker layer for the user's location
    var markerLayer = new OpenLayers.Layer.Markers("Markers");
    map.addLayer(markerLayer);

    function getCurrentLocation() {
        // Check if the browser supports geolocation
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var lonLat = new OpenLayers.LonLat(position.coords.longitude, position.coords.latitude).transform(
                    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                    map.getProjectionObject() // to Spherical Mercator Projection
                );
                var zoom = 16;
                map.setCenter(lonLat, zoom);

                // Add a marker to the map at the user's location
                var marker = new OpenLayers.Marker(lonLat);
                markerLayer.addMarker(marker);

                // Fill the location, latitude, and longitude fields in the form
                document.getElementById('location').value = lonLat;
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    // Get the user's location when the page loads
    getCurrentLocation();
</script>
@endsection
