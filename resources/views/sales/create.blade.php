@extends('layouts.superadmin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Buat Data Sales Baru</h1>

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

        <form method="POST" action="{{ route('sales.store') }}">
            @csrf

            {{-- <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" class="form-control" id="nik" name="nik" required>
            </div> --}}

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            {{-- <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="alamat_ktp">Alamat KTP:</label>
                <input type="text" class="form-control" id="alamat_ktp" name="alamat_ktp" required>
            </div> --}}

            {{-- <div class="form-group">
                <label for="alamat_domisili">Alamat Domisili:</label>
                <input type="text" class="form-control" id="alamat_domisili" name="alamat_domisili" required>
            </div> --}}

            <div class="form-group">
                <label for="nomor_handphone">Nomor Handphone:</label>
                <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            {{-- <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div> --}}

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
