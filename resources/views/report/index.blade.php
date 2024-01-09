@extends('layouts.superadmin')

@section('content')


<style>
    .table-centered {
  text-align: center;
}

.table-bordered td,
.table-bordered th {
  white-space: nowrap;
}

.table thead th {
  vertical-align: middle;
}

</style>

{{-- 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Filter Data
                </div>
                <div class="card-body">
                    <form action="{{ route('report.index') }}" method="GET">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <input type="text" name="province" class="form-control" placeholder="Province" value="{{ request('province') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
</div>

{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Download Report
                </div>
                <div class="card-body">
                    <a href="{{ route('report.export', request()->query()) }}" class="btn btn-success">Download Excel</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Download Report
                </div>
                <div class="card-body">
                    <a href="{{ route('report.export') }}" class="btn btn-success">Download Report to Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Sales Report</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> --}}
                        <table class="table table-bordered table-centered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Toko</th>
                                    <th>Alamat Toko</th>
                                    <th>Nama Sales</th>
                                    {{-- <th>Sales Phone Number</th> --}}
                                    <th>Kota</th>
                                    {{-- <th>Photo Toko Depan</th> --}}
                                    {{-- <th>Shop Location (Coordinate)</th> --}}
                                    <th>Tanggal Kunjungan Terakhir</th>
                                    <th>Material Toko</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach($reportData as $report)

{{-- 
                                +"id": 21
                                +"shop_id": 47
                                +"visit_date": null
                                +"location": "lon=11887772.00476045,lat=-684298.8851659015"
                                +"created_at": null
                                +"updated_at": "2023-10-09 13:56:38"
                                +"materials": "brochure,standing_banner,billboard"
                                +"photo": null
                                +"photos": null
                                +"notes": "test"
                                +"sales_id": 21
                                +"nama_sales": "BILLY"
                                +"shop_name": "TB Madju"
                                +"shop_address": "Jl. Sumur Batu Raya No.409, RT.2/RW.2, Sumur Batu, Kec. Kemayoran, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10640"
                                +"provinsi": null
                                +"kota": "Jakarta Pusat"
                                +"kecamatan": null
                                +"kelurahan": "SUMUR BATU"
                                +"nama_pic": "AYONG"
                                +"nomor_hp_pic": "081299831199"
                                +"shop_googlemaps_coord": null
                                +"shop_uuid": null
                                +"deleted_at": null
                                +"name": "BILLY"
                                +"email": "billy@rooftuff.com"
                                +"email_verified_at": null
                                +"password": "eyJpdiI6IkVib2dSQmJUS3Rud1pCdGhNYUFQY2c9PSIsInZhbHVlIjoiWXQ1eFRxbnpQSFpRQlFTQWtWMEFsQ1dsR05yM3RFeGJyV3RqbTVHbThTUT0iLCJtYWMiOiJkN2Q3MWFhNTQxM2M1ZTY3OTRmZGRmY2Iy ▶"
                                +"remember_token": null
                                +"role": "sales"
                                +"peran_user": null
                                +"tanggal_lahir": null
                                +"nomor_ktp_sales": null
                                +"nomor_handphone_sales": null
                                +"verification_code": null
                                +"verification_expires_at": null
                                +"is_verified": false
                              } --}}


                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $report->shop_name }}</td>
                                    <td>{{ $report->shop_address }}</td>
                                    <td>{{ $report->nama_sales }}</td>
                                    {{-- <td>{{ $report->nomor_handphone }}</td> --}}
                                    <td>{{ $report->kota }}</td>
                                    {{-- <td>
                                        
                                      
                                            <a href="{{ asset('storage/' . $report->photo) }}" target="_blank">
                                                Click to Enlarge or View <br>

                                                {{-- <img src="{{ asset('storage/' . $report->photo) }}" alt="Photo Toko Depan"> --}}
                                                {{-- <img src="{{ asset('storage/' . $report->photo) }}" alt="Photo Toko Depan" style="width: 100px; height: auto;">

                                            </a> --}}
                                        
                                        
                                    
                                    {{-- </td> --}} 
                                    {{-- <td>
                                        
                                        {{ $report->location }}
                                       
                                        
                                    
                                    </td>                                     --}}
                                    <td>{{ \Carbon\Carbon::parse($report->created_at)->format('D, d M Y H:i') }}</td>
                                    <td>{{ $report->materials }}</td>
                                    <td><a href="{{ route('visits.show', $report->id) }}">Cek Detail</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function showMap(location) {
        // Extract the latitude and longitude from the coordinate value
        var coordinates = location.split(',');

        // Get the latitude and longitude values
        var latitude = parseFloat(coordinates[1].split('=')[1]);
        var longitude = parseFloat(coordinates[0].split('=')[1]);

        // Create a LonLat object with the latitude and longitude
        var lonLat = new OpenLayers.LonLat(longitude, latitude).transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
        );

        // Create a marker and add it to the marker layer
        var marker = new OpenLayers.Marker(lonLat);
        markerLayer.addMarker(marker);

        // Zoom the map to the marker's location
        map.setCenter(lonLat, 16); // Adjust the zoom level as needed

        // Open the map in a new tab
        var mapUrl = map.getFullRequestString({
            map_projection: 'EPSG:3857',
            layers: 'OSM',
            format: 'png',
            height: 600,
            width: 800,
            transparent: true
        });
        window.open(mapUrl, '_blank');
    }
</script>




@endsection
