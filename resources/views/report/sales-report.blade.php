@extends('layouts.superadmin')
@section('content')

@php
    use Carbon\Carbon;
@endphp

<html>
<head>
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
        .blue-cell {
            background-color: blue !important;
        }
    </style>
</head>
<body>

    <form action="{{ route('sales-report') }}" method="get">


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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
            </div>
        </div>
    </div>
    



</body>
</html>



@endsection