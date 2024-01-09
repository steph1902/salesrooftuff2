@extends('layouts.sales')
@section('content')

@php
use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Sales</title>
    <style>        
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        /* CSS untuk warna biru pada laporan */
        .blue-cell {
            background-color: blue !important;
        }
    </style>
</head>
<body>

    <form action="{{ route('sales-report') }}" method="get">
        <label for="bulan">Pilih Bulan:</label>
        <select name="bulan" id="bulan">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}"{{ $i == $bulan ? ' selected' : '' }}>{{ Carbon::create()->month($i)->format('F') }}</option>
            @endfor
        </select>
        <label for="tahun">Pilih Tahun:</label>
        <select name="tahun" id="tahun">
            @for ($i = date('Y'); $i >= 2022; $i--)
                <option value="{{ $i }}"{{ $i == $tahun ? ' selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <button type="submit">Tampilkan Laporan</button>
    </form>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <p>Saat ini, laporan untuk bulan:
                        <h4>{{ Carbon::create()->month($bulan)->format('F') }} {{ $tahun }} </h4>
                    </p>
                </p>
            </div>
        </div>
    </div>
    {{--  --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{url('home')}}"> Cek daftar toko </a>
            </div>
            <div class="col-md-12">                
                <a href="{{ route('visits.showVisitedStoreData') }}">Cek daftar toko yang sudah di visit</a>
            </div>            
        </div>
    </div>

    <br>
    <hr>
    <br>
    <hr>
    <br>



    <div class="table-responsive">

    <table border="1">
        <thead>
            <tr>
                <th>Tanggal</th>
                @foreach($dates as $date)
                    <th>{{ $date }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->shop_name }}</td>
                    @foreach($dates as $date)
                        <td class="{{ $report[$date][$shop->shop_name] ? 'blue-cell' : '' }}"></td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    

    </div>

</body>
</html>



@endsection