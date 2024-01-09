{{-- <h1>SALES DASHBOARD</h1> --}}
@extends('layouts.sales')
@section('content')


    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <div class="card"> --}}
                    <h3>Welcome, <b> {{ $user->name }}</b> </h3>     
                {{-- </div> --}}
            </div>
        </div>
    </div>

    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12">                
                <a href="{{ route('visits.showVisitedStoreData') }}">Cek daftar toko yang sudah di visit</a>
            </div>
            <div class="col-md-12">                
                <a href="{{ url('sales-report/?bulan=10&tahun=2023') }}">Cek laporan toko yang sudah di visit</a>
            </div>
        </div>
    </div> --}}

    <br>
    <hr>
    <br>


    

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Toko yang perlu di visit</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                @if ($shops->count() > 0)

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>                            
                                <th>Nama Toko</th>
                                <th>Alamat Toko</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>                        
                                <th>Nama PIC</th>
                                <th>No. Handphone PIC</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tfoot>
                            <th>Nama Toko</th>
                                <th>Alamat Toko</th>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>                        
                                <th>Nama PIC</th>
                                <th>No. Handphone PIC</th>
                                <th>Action</th>                            
                            
                        </tfoot>
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
                                    <td><a href="{{ route('visits.create', $shop->id) }}">Visit</a></td>
                                    {{-- <td>Visit toko</td> --}}
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                @endif


            </div>
        </div>
    </div>


    <hr><br><hr>

{{-- 

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Sales Dashboard</div>

                    <div class="card-body">
                        {{-- Welcome, {{ Auth::user()->name }}! --}}

                        {{-- <br><hr><br> --}}

                        <!-- Add this logout form -->
                        {{-- <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    

    <br><hr><br>



    

@endsection
