@extends('layouts.app')
@section('content')


{{--  --}}
    <div class="container">
        <h1>Welcome, {{ $user->name }}</h1>

        <h2>Your Shops:</h2>
        @if ($shops->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Shop Name</th>
                        <th>Shop Address</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Sub-district</th>
                        <th>Urban Village</th>
                        <th>PIC Name</th>
                        <th>PIC Phone Number</th>
                        <!-- Tambahkan kolom tambahan sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shops as $shop)
                        <tr>
                            <td>{{ $shop->shop_name }}</td>
                            <td>{{ $shop->shop_address }}</td>
                            <td>{{ $shop->provinsi }}</td>
                            <td>{{ $shop->kota }}</td>
                            <td>{{ $shop->kecamatan }}</td>
                            <td>{{ $shop->kelurahan }}</td>
                            <td>{{ $shop->nama_pic }}</td>
                            <td>{{ $shop->nomor_hp_pic }}</td>
                            <!-- Tambahkan sel untuk kolom tambahan sesuai kebutuhan -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $shops->links() }} <!-- Menampilkan navigasi paginasi -->
        @else
            <p>You don't have any shops.</p>
        @endif
    </div>


{{-- @endsection --}}


{{--  --}}


{{-- 
<div class="container">
    

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    
                    <h2>Assigned Shops:</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    
                        <tr>
                            <th>ID</th>
                            <th>Shop Name</th>
                            <th>Shop Address</th>
                            <th>Shop Region</th>
                            <th>Shop City</th>
                            <th>Shop District</th>
                            <th>Shop Subdistrict</th>
                            <th>Visit this shop</th>
                            
                        </tr>
                        @foreach ($assignedShops as $shop)
                            <tr>
                                <td>{{ $shop->id }}</td>
                                <td>{{ $shop->shop_name }}</td>
                                <td>{{ $shop->shop_address }}</td>
                                <td>{{ $shop->shop_region }}</td>
                                <td>{{ $shop->shop_city }}</td>
                                <td>{{ $shop->shop_district }}</td>
                                <td>{{ $shop->shop_subdistrict }}</td>
                                
                                <td><a href="{{ route('visits.create', $shop->id) }}">Visit</a></td>


                            </tr>
                        @endforeach
                    </table>
                </div>



                </div>
            </div>            
        </div>
    </div>


    <div style="padding-top:5%"></div>
    {{--  --}}
{{-- 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- Sales Visited Shops --}}
                        <h2>Sales Visited Shops</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Shop ID</th>
                                        <th>Shop Name</th>
                                        <th>Visit Date</th>
                                        <th>Location</th>
                                        <th>View Details</th>
                                        <!-- Rest of the table columns -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitedShops as $visit)
                                        <tr>
                                            <td>{{ $visit->id }}</td>
                                            <td>{{ $visit->shop_id }}</td>
                                            <td>{{ $visit->shop_name }}</td>                                            
                                            <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('D, d M Y H:i') }}</td>

                                            <td>
                                                {{$visit->shop_region}},
                                                {{$visit->shop_city}},
                                                {{$visit->shop_district}},
                                                {{$visit->shop_subdistrict}},                                                
                                            </td>
                                            <td>
                                                <a href="{{ route('visits.show', $visit->id) }}">View Details</a>

                                            </td>
                                            <!-- Rest of the table columns -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="padding-top:3%;"></div>
   
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div style="padding: 5%;"></div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Logout') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--  --}}



</div> --}} --}}
@endsection
