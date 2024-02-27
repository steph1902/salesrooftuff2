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
                                <th>Tanggal Ditambahkan</th>   
                                <th>Action</th>                                                                                        
                            </tr>
                        </thead>
                        <tfoot>
                                <th>Nama Toko</th>
                                <th>Alamat Toko</th>
                                <th>Tanggal Ditambahkan</th>      
                                <th>Action</th>                                                                                                             
                        </tfoot>
                        <tbody>

                            @foreach ($shops as $shop)
                                <tr>
                                    <td>{{ $shop->shop_name }}</td>
                                    <td>{{ $shop->shop_address }} <br>
                                    {{ $shop->provinsi }} <br>
                                    {{ $shop->kota }} <br>
                                    {{ $shop->kecamatan }} <br>
                                    {{ $shop->kelurahan }} <br>
                                    <td>{{ $shop->created_at ? \Carbon\Carbon::parse($shop->created_at)->format('D, d M Y, H:i') : 'null' }}</td>
                                    <td><a href="{{ route('visits.create', $shop->id) }}"><i class="fas fa-door-open"></i> Visit</a></td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                @endif


            </div>
        </div>
    </div>


    <hr><br><hr>


    <br><hr><br>
    

@endsection
