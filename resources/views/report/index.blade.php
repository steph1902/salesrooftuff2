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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-body shadow">
                <form action="{{ route('report.index') }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="shop_name">Nama Toko:</label>
                        <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ request('shop_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="sales_name">Nama Sales:</label>
                        <input type="text" class="form-control" id="sales_name" name="sales_name" value="{{ request('sales_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="province">Provinsi:</label>
                        <input type="text" class="form-control" id="province" name="province" value="{{ request('province') }}">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Tanggal Awal:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    
                    @if(request()->filled('shop_name') || request()->filled('sales_name') || request()->filled('province') || request()->filled('start_date') || request()->filled('end_date'))
                        <a href="{{ route('report.index') }}" class="btn btn-secondary">Clear Filter</a>
                    @endif

                    <button type="submit" class="btn btn-primary">Filter</button>

                    
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<hr>
<br>


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
                        <table class="table table-bordered table-centered" id="dataTable" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Toko</th>
                                    <th>Alamat Toko</th>
                                    <th>Nama Sales</th>
                                    <th>Kota</th>
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

                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $report->shop_name }}</td>
                                    <td>{{ $report->shop_address }}</td>
                                    <td>{{ $report->nama_sales }}</td>
                                    <td>{{ $report->kota }}</td>                                    
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
        var coordinates = location.split(',');
        var latitude = parseFloat(coordinates[1].split('=')[1]);
        var longitude = parseFloat(coordinates[0].split('=')[1]);
        var lonLat = new OpenLayers.LonLat(longitude, latitude).transform(
            new OpenLayers.Projection("EPSG:4326"), 
            map.getProjectionObject() 
        );

        var marker = new OpenLayers.Marker(lonLat);
        markerLayer.addMarker(marker);


        map.setCenter(lonLat, 16); 

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
