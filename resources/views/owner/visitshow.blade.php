@extends('layouts.superadmin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('home') }}">Kembali ke beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="padding:2%;"></div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Shop Details') }}</div>
                <div class="card-body">
                    <h2>{{ $visit->shop_name }}</h2>
                    <p>Tanggal visit: <b>{{ \Carbon\Carbon::parse($visit->created_at)->format('D, d M Y H:i') }}</b></p> <br>
                    <p>Alamat: {{ $visit->shop_address }}</p>
                    <p>Provinsi: {{ $visit->provinsi }}</p>
                    <p>Kotak: {{ $visit->kota }}</p>
                    <p>Kecamatan: {{ $visit->kecamatan }}</p>
                    <p>Kelurahan: {{ $visit->kelurahan }}</p>

                    <h2>Informasi visit:</h2>
                    <p>Lokasi: {{ $visit->location }}</p>
                    <p>Catatan: {{ $visit->notes }}</p>
                    <p>Material: {{ $visit->materials }}</p>

                    @if ($visit->photo)
                        <p>Photo Toko Depan:</p>

                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $visit->photo) }}" alt="Photo Toko Depan">
                                </div>
                            </div>
                        </div>



                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
