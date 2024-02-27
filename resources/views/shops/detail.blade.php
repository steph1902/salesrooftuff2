
{{-- /Users/stephs/Documents/sbkrooftuffsalessystem-branch_cadangan/storage/app/public/photos/hlWHZ9RcrTxnQlG0gqtep5Ngc55GxcpqiIt5pm1r.png --}}

{{-- ketika data toko di klik, tampilkan data visit sales --}}

@extends('layouts.superadmin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h1>Data Visit Toko</h1>
                    <h6>
                        Sales : {{$salesName->sales_name}}
                    </h6>
                </div>
                <div class="card-body">
                    {{--  --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Tanggal Visit</th>
                                    <th>Lokasi Pinpoint by System</th>
                                    <th>Materials</th>
                                    <th>Notes</th>
                                    <th>Foto Toko</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Tanggal Visit</th>
                                    <th>Lokasi Pinpoint by System</th>
                                    <th>Materials</th>
                                    <th>Notes</th>
                                    <th>Foto Toko</th>                                    
                                </tr>
                            </tfoot>
                            <tbody> 

                                @foreach ($visits as $visit)
                                    
                                
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $visit->created_at ? \Carbon\Carbon::parse($visit->created_at)->format('D, d M Y, H:i') : 'null' }} </td>
                                    <td> {{$visit->location}} </td>
                                    <td> {{$visit->materials}}  </td>
                                    <td> {{$visit->notes}}  </td>
                                    <td>
                                        <a href="{{ asset('storage/' . $visit->photo) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $visit->photo) }}" alt="Photo Toko Depan" style="max-width: 200px; max-height: 200px;">
                                        </a>
                                    </td>

                                </tr>

                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    {{--  --}}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection