@extends('layouts.superadmin')

@section('content')



    <h1>Edit Sales</h1>
    <h6><a href="{{url('sales')}}">kembali ke halaman Sales</a></h6>


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif








    <form method="POST" action="{{ route('sales.update', $sales->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nik">NIK:</label>
            <input type="text" class="form-control" id="nik" name="nik" value="{{ $sales->nik }}" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $sales->nama }}" required>
        </div>

        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $sales->tempat_lahir }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $sales->tanggal_lahir }}" required>
        </div>

        <div class="form-group">
            <label for="alamat_ktp">Alamat KTP:</label>
            <input type="text" class="form-control" id="alamat_ktp" name="alamat_ktp" value="{{ $sales->alamat_ktp }}" required>
        </div>

        <div class="form-group">
            <label for="alamat_domisili">Alamat Domisili:</label>
            <input type="text" class="form-control" id="alamat_domisili" name="alamat_domisili" value="{{ $sales->alamat_domisili }}" required>
        </div>

        <div class="form-group">
            <label for="nomor_handphone">Nomor Handphone:</label>
            <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" value="{{ $sales->nomor_handphone }}" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $sales->email }}" required>
        </div>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $sales->username }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
