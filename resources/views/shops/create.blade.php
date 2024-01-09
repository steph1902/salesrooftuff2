@extends('layouts.sales')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script>
<style>
    #map {
        height: 400px;
        width: 100%;
    }

     
td,th {
    text-align: center;
    vertical-align: middle;
}
</style>
 


<div class="container">

    <h1>Tambah data toko baru</h1>

    <div style="padding-top:3%"></div>


    <form method="POST" action="{{ route('shops.store') }}">
        @csrf

        <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">


        <div class="form-group">
            <label for="shop_name">Nama toko:</label>
            <input type="text" class="form-control" id="shop_name" name="shop_name" required>
        </div>


        <div class="form-group">
            <label for="shop_address">Alamat toko:</label>
            <input type="text" class="form-control" id="shop_address" name="shop_address" required>
        </div>
           

        @php
            $provinces = new App\Http\Controllers\DependantDropdownController;
            $provinces= $provinces->provinces();
        @endphp

        {{-- 1 --}}
        <div class="form-group">
            <label for="province">Provinsi</label>
            <select class="form-control" name="provinsi" id="provinsi">
                <option value="">Pilih Provinsi</option>
                @foreach($provinces as $item)
                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subdistrict">Kabupaten / Kota</label>
            <select class="form-control" name="kota" id="kota">
                <option value="">==Pilih Salah Satu==</option>
            </select>                        
        </div>

        <div class="form-group">
            <label for="subdistrict">Kecamatan</label>
            <select class="form-control" name="kecamatan" id="kecamatan">
                <option value="">==Pilih Salah Satu==</option>
            </select>
        </div>

        <div class="form-group">
            <label for="subdistrict">Desa</label>
            <select class="form-control" name="desa" id="desa">
                <option value="">==Pilih Salah Satu==</option>
            </select>
        </div>

        <br><hr>

        <div class="form-group">
            <label for="photo">Upload Photo Toko Depan: (1 foto saja)</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
            @error('photo')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        


        <div style="padding-top:2%"></div>




        <button type="submit" class="btn btn-primary">Tambah data toko</button>

        <div style="padding-top:5%"></div>

</div>












<script>
    function onChangeSelect(url, id, name) {
        // send ajax request to get the cities of the selected province and append to the select tag
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function (data) {
                $('#' + name).empty();
                $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                $.each(data, function (key, value) {
                    $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    }
    $(function () {
        $('#provinsi').on('change', function () {
            onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
        });
        $('#kota').on('change', function () {
            onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
        })
        $('#kecamatan').on('change', function () {
            onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
        })
    });
</script>



@endsection

