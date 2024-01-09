@extends('layouts.superadmin')

@section('content')
    <h1>Sales Details</h1>
    <h6><a href="{{url('sales')}}">kembali ke halaman Sales</a></h6>

    <table class="table">
        <tbody>
            {{-- <tr>
                <th>NIK:</th>
                <td>{{ $sales->nik }}</td>
            </tr> --}}
            <tr>
                <th>Nama:</th>
                <td>{{ $sales->nama }}</td>
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
                <td>{{ $sales->email }}</td>
            </tr>
            {{-- <tr>
                <th>Username:</th>
                <td>{{ $sales->username }}</td>
            </tr> --}}
        </tbody>
    </table>
@endsection
