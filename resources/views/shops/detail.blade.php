
{{-- /Users/stephs/Documents/sbkrooftuffsalessystem-branch_cadangan/storage/app/public/photos/hlWHZ9RcrTxnQlG0gqtep5Ngc55GxcpqiIt5pm1r.png --}}

@extends('layouts.superadmin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                </div>
                <div class="card-body">
                    {{--  --}}
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
                            </tbody>
                        </table>
                    </div>
                    {{--  --}}
                </div>
            </div>
        </div>
    </div>
</div>



<table class="table">
    <tbody>
        {{-- <tr>
            <th>NIK:</th>
            <td>{{ $sales->nik }}</td>
        </tr> --}}
        <tr>
            <th>Nama:</th>
            {{-- <td>{{ $sales->nama }}</td> --}}
        </tr>
        {{-- <tr>
            <th>Tempat Lahir:</th>
            <td>{{ $sales->tempat_lahir }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir:</th>
            <td>{{ $sales->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Alamat KTP:</th>
            <td>{{ $sales->alamat_ktp }}</td>
        </tr>
        <tr>
            <th>Alamat Domisili:</th>
            <td>{{ $sales->alamat_domisili }}</td>
        </tr> --}}
        {{-- <tr>
            <th>Nomor Handphone:</th>
            <td>{{ $sales->nomor_handphone }}</td>
        </tr> --}}
        <tr>
            <th>E-mail:</th>
            {{-- <td>{{ $sales->email }}</td> --}}
        </tr>
        {{-- <tr>
            <th>Username:</th>
            <td>{{ $sales->username }}</td>
        </tr> --}}
    </tbody>
</table>



@endsection