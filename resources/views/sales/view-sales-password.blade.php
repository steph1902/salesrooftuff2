@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Password Sales</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sales)
                <tr>
                    <td>{{ $sales->name }}</td>
                    <td>{{$sales->email}}</td>
                    <td>{{ Crypt::decrypt($sales->password) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
