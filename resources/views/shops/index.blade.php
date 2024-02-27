@extends('layouts.superadmin')
@section('content')


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@php
    use Carbon\Carbon;

@endphp

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('shops.index') }}" method="GET">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="filter-name">Nama Toko</label>
                        <input type="text" class="form-control mb-2" id="filter-name" name="filter_name" placeholder="Filter by Name">
                    </div>
                    <div class="col-auto">
                        <label class="sr-only" for="filter-region">Provinsi</label>
                        <input type="text" class="form-control mb-2" id="filter-region" name="filter_region" placeholder="Filter by Provinsi">
                    </div>
                    <div class="col-auto">
                        <label class="sr-only" for="filter-city">Kabupaten / Kota</label>
                        <input type="text" class="form-control mb-2" id="filter-city" name="filter_city" placeholder="Filter by Kabupaten / Kota">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    </div>

                    <div class="col-auto">
                        <a href="{{url('shops')}}">remove filter</a>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>



<hr>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{-- &year; --}}
                        Daftar toko
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Toko</th>
                                    <th>Nama Sales</th>
                                    <th>Alamat Toko</th>
                                    <th>Tanggal</th>                           
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama Toko</th>
                                    <th>Nama Sales</th>
                                    <th>Alamat Toko</th>  
                                    <th>Tanggal</th>                                                                            
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($shops as $shop)
                                <tr>
                                    <td>
                                        <a href="{{ route('view-shop-details-visit-data', ['id' => $shop->id]) }}">

                                            {{ $shop->shop_name }}
                                        </a>                                    
                                    </td>
                                    <td>{{$shop->nama_sales}}</td>
                                    <td>
                                        {{ $shop->shop_address }} <br>
                                        {{ $shop->provinsi }} <br>
                                        {{ $shop->kota }} <br>
                                        {{ $shop->kecamatan }} <br>
                                        {{ $shop->kelurahan }}                                
                                    </td>       
                                    <td>{{ $shop->created_at ? \Carbon\Carbon::parse($shop->created_at)->format('D, d M Y, H:i') : 'null' }}</td>                     
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















@endsection
