@extends('layouts.sales')
@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Toko</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                {{-- @if ($shops->count() > 0) --}}

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Toko</th>
                                <th>Nama Toko</th>
                                <th>Tanggal Visit</th>
                                <th>Lokasi</th>
                                <th>Lihat Detail</th>   
                                <th>Lengkapi Detail</th>
                                <th>Status</th>                                                                                   
                            </tr>
                        </thead>
                        <tfoot>                            
                            {{-- @foreach ($visitedShops as $visit) --}}
                                <tr>
                                    <th>ID</th>
                                    <th>ID Toko</th>
                                    <th>Nama Toko</th>
                                    <th>Tanggal Visit</th>
                                    <th>Lokasi</th>
                                    <th>Lihat Detail</th>   
                                    <th>Lengkapi Detail</th> 
                                    <th>Status</th>                                    
                                </tr>
                            {{-- @endforeach --}}
                        </tfoot>
                        <tbody>

                            @foreach ($visitedShops as $visit)
                                <tr>
                                    <td>{{ $visit->id }}</td>
                                    <td>{{ $visit->shop_id }}</td>
                                    <td>{{ $visit->shop_name }}</td>                                            
                                    <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('D, d M Y H:i') }}</td>

                                    <td>
                                        {{$visit->provinsi}},
                                        {{$visit->kota}},
                                        {{$visit->kecamatan}},
                                        {{$visit->kelurahan}},                                                
                                    </td>
                                    <td>
                                        <a href="{{ route('visits.show', $visit->id) }}">Cek Detail</a>
                                    </td>
                                    <td>
                                        <a href="{{route('visits.edit', $visit->id)}}">Lengkapi Data Kunjungan</a>
                                    </td>

                                    <td>
                                        @if ($visit->materials === 'di isikan menyusul')
                                            <span class="badge badge-primary badge-pill">Perlu dilengkapi</span>
                                        @else
                                            <span class="badge badge-secondary badge-pill">Sudah dilengkapi</span>
                                        @endif

                                    </td>

                                    <!-- Rest of the table columns -->
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                {{-- @endif --}}


            </div>
        </div>
    </div>





@endsection