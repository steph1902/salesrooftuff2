{{-- <h1>SUPERADMIN OWNER DASHBOARD</h1> --}}

<!-- dashboard.blade.php -->

@extends('layouts.superadmin')

@section('content')
    <!-- Your owner dashboard content here -->

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Total Sales Terdaftar
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalSales }}</h5>
                        <p class="card-text">Jumlah total sales yang terdaftar.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Total Toko Terdaftar
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalShops }}</h5>
                        <p class="card-text">Jumlah total toko yang terdaftar di sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><hr><br>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Jumlah Toko yang Dikunjungi vs. Belum Dikunjungi
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($visitedVsNotVisitedShops as $result)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $result->kota }}
                                    <span class="badge badge-primary badge-pill">Dikunjungi: {{ $result->visited }}, Belum Dikunjungi: {{ $result->not_visited }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <br><hr><br>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Jumlah Toko per Kota
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            {{-- @foreach($shopsPerProvince as $province) --}}
                            @foreach($shopsPerCity as $city)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{-- {{ $province->kota }} --}}
                                    {{ $city->kota }}
                                    <span class="badge badge-primary badge-pill">{{ $city->total }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>




    {{-- <hr><br><hr>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Owner Dashboard</div>

                    <div class="card-body">
                        Welcome, {{ Auth::user()->name }}!

                        <br><hr><br>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <br><hr><br>

@endsection
