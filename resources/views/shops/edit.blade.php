@extends('layouts.app')

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

    <h1>Edit Shop</h1>

    <div style="padding-top:3%"></div>


    <form method="POST" action="{{ route('shops.update', $shop->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="shop_name">Shop Name:</label>
            <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ $shop->shop_name }}" required>
        </div>

        <div class="form-group">
            <label for="shop_address">Shop Address:</label>
            <input type="text" class="form-control" id="shop_address" name="shop_address" value="{{ $shop->shop_address }}" required>
        </div>

        @php
            $provinces = new App\Http\Controllers\DependantDropdownController;
            $provinces = $provinces->provinces();
        @endphp

        {{-- 1 --}}
        <div class="form-group">
            <label for="province">Provinsi (Sebelumnya: <b>{{$shop->shop_region}}</b>)  </label>
            <select class="form-control" name="provinsi" id="provinsi">
                <option value="">Pilih provinsi</option>
                @foreach($provinces as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $shop->shop_region ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subdistrict">Kabupaten / Kota  (Sebelumnya: <b>{{$shop->shop_city}}</b>) </label>
            <select class="form-control" name="kota" id="kota">
                <option value="">==Select One==</option>

               
            </select>                        
        </div>

        <div class="form-group">
            <label for="subdistrict">Kecamatan (Sebelumnya: <b>{{$shop->shop_district}}</b>)  </label>
            <select class="form-control" name="kecamatan" id="kecamatan">
                <option value="">==Select One==</option>
                {{-- @foreach($districts as $district)
                    <option value="{{ $district->id }}" {{ $district->id == $shop->shop_district ? 'selected' : '' }}>{{ $district->name }}</option>
                @endforeach --}}
            </select>
        </div>

        <div class="form-group">
            <label for="subdistrict">Desa  (Sebelumnya: <b>{{$shop->shop_subdistrict}}</b>)  </label>
            <select class="form-control" name="desa" id="desa">
                <option value="">==Select One==</option>
                {{-- @foreach($villages as $village)
                    <option value="{{ $village->id }}" {{ $village->id == $shop->shop_subdistrict ? 'selected' : '' }}>{{ $village->name }}</option>
                @endforeach --}}
            </select>
        </div>

                    <div style="padding-top:2%"></div>

                    <button type="submit" class="btn btn-primary">Update Shop</button>
                
                    <div style="padding-top:5%"></div>
                
                </form>

            
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
                            $('#' + name).append('<option>==Select One==</option>');
            
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
