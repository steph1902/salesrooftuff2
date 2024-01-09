@extends('layouts.app')
@section('content')


<!-- sales.dashboard.blade.php -->

<h1>Sales Dashboard</h1>

<h2>Sales Information:</h2>
<table>
    <tr>
        <th>ID</th>
        <th>NIK</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <tr>
        <td>{{ $sales->id }}</td>
        <td>{{ $sales->nik }}</td>
        <td>{{ $sales->nama }}</td>
        <td>{{ $sales->email }}</td>
    </tr>
</table>

<h2>Assigned Shops:</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Shop Name</th>
        <th>Shop Address</th>
        <th>Shop Region</th>
        <th>Shop City</th>
        <th>Shop District</th>
        <th>Shop Subdistrict</th>
        <th>Shop Google Maps Coord</th>
    </tr>
    @foreach ($assignedShops as $shop)
        <tr>
            <td>{{ $shop->id }}</td>
            <td>{{ $shop->shop_name }}</td>
            <td>{{ $shop->shop_address }}</td>
            <td>{{ $shop->shop_region }}</td>
            <td>{{ $shop->shop_city }}</td>
            <td>{{ $shop->shop_district }}</td>
            <td>{{ $shop->shop_subdistrict }}</td>
            <td>{{ $shop->shop_googlemaps_coord }}</td>
        </tr>
    @endforeach
</table>







@endsection




