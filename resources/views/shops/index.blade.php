@extends('layouts.superadmin')

@section('content')


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


{{-- 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h6><a href="{{ route('shops.create') }}">Buat data toko baru</a></h6> 
        </div>
    </div>
</div>

<hr> --}}

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
                            <th>Alamat Toko</th>
                            <th>Provinsi</th>
                            <th>Kabupaten / Kota</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            {{-- <th>Ubah data toko</th>
                            <th>Hapus data toko</th> --}}
                           
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Toko</th>
                            <th>Alamat Toko</th>
                            <th>Provinsi</th>
                            <th>Kabupaten / Kota</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            {{-- <th>Ubah data toko</th>
                            <th>Hapus data toko</th> --}}
                           
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($shops as $shop)
                        <tr>
                            <td>{{ $shop->shop_name }}</td>
                            <td>{{ $shop->shop_address }}</td>
                            <td>{{ $shop->shop_region }}</td>
                            <td>{{ $shop->shop_city }}</td>
                            <td>{{ $shop->shop_district }}</td>
                            <td>{{ $shop->shop_subdistrict }}</td>
                            {{-- <td>  --}}
                                {{-- <a href="{{ route('shops.edit', $shop->id) }}">
                                    <i class="fa fa-edit"></i> Ubah
                                </a> --}}
                            {{-- </td> --}}
                            {{-- <td> --}}

                                {{-- <a href="{{ route('shops.destroy', $shop->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                                
                                <form id="delete-form" action="{{ route('shops.destroy', $shop->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form> --}}
                                
                            {{-- </td> --}}
                           
                              
                             
                              



                            
                        </tr>
                    @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>













@endsection
