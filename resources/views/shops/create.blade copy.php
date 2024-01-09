@extends('layouts.app')

@section('content')


<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>

<script>

    $(document).ready(function() {      
                                
        $('#province').change(function() {                        
            var provinceId = $(this).val();                
            if (provinceId) {            
                $.ajax({
                    url: '{{ route('cities.by_province_id') }}',
                    type: 'GET',
                    data: {province: provinceId},
                    success: function(data) {
                        $('#city').prop('disabled', false);
                        $('#city').html('<option value="">Select City</option>');
    
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + value.city_id + '">' + value.city_name + '</option>');

                            // {"city_id":"39","province_id":"5","province":"DI Yogyakarta","type":"Kabupaten","city_name":"Bantul","postal_code":"55715"}

                        });
                    }
                });
            } else {
                $('#city').prop('disabled', true);
                $('#city').html('<option value="">Select City</option>');
                $('#subdistrict').prop('disabled', true);
                $('#subdistrict').html('<option value="">Select Subdistrict</option>');
            }
        });

       
        $('#city').change(function() {
            var cityId = $(this).val();
    
            if (cityId) {
                $.ajax({
                    url: '{{ route('subdistricts.by_city_id') }}',
                    type: 'GET',
                    data: {city_id: cityId},
                    success: function(data) {
                        $('#subdistrict').prop('disabled', false);
                        $('#subdistrict').html('<option value="">Select Subdistrict</option>');
    
                        $.each(data, function(key, value) {
                            $('#subdistrict').append('<option value="' + value.subdistrict_id + '">' + value.subdistrict_name + '</option>');
                        });
                    }
                });
            } else {
                $('#subdistrict').prop('disabled', true);
                $('#subdistrict').html('<option value="">Select Subdistrict</option>');
            }
        });
    });
                
    </script>


    <div class="container">
        <h1>Create a New Shop</h1>
        <form method="POST" action="{{ route('shops.store') }}">
            @csrf
            <div class="form-group">
                <label for="shop_name">Shop Name:</label>
                <input type="text" class="form-control" id="shop_name" name="shop_name" required>
            </div>
            <div class="form-group">
                <label for="shop_address">Shop Address:</label>
                <input type="text" class="form-control" id="shop_address" name="shop_address" required>
            </div>
           
           
            <div class="form-group">
                <label for="shop_region">Shop Region:</label>
                <input type="text" class="form-control" id="shop_region" name="shop_region" required>
            </div>
            <div class="form-group">
                <label for="shop_city">Shop City:</label>
                <input type="text" class="form-control" id="shop_city" name="shop_city" required>
            </div>
            <div class="form-group">
                <label for="shop_district">Shop District:</label>
                <input type="text" class="form-control" id="shop_district" name="shop_district" required>
            </div>
            <div class="form-group">
                <label for="shop_subdistrict">Shop Subdistrict:</label>
                <input type="text" class="form-control" id="shop_subdistrict" name="shop_subdistrict" required>
            </div>

            {{--  --}}
            {{-- <form method="POST" action="{{ route('shops.store') }}"> --}}
                {{-- @csrf --}}
            
                <div class="form-group">
                    <label for="province">Province</label>
                    <select class="form-control" name="province_id" id="province">
                        <option value="">Select Province</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="city">City</label>
                    <select class="form-control" name="city" id="city" disabled>
                        <option value="">Select City</option>
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="subdistrict">Subdistrict</label>
                    <select class="form-control" name="subdistrict" id="subdistrict" disabled>
                        <option value="">Select Subdistrict</option>
                    </select>
                </div>
            
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            {{-- </form> --}}
            


            {{--  --}}






            <div class="form-group">
                <label for="shop_googlemaps_coord">Shop Google Maps Coordinate:</label>
                <input type="text" class="form-control" id="shop_googlemaps_coord" name="shop_googlemaps_coord" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Shop</button>
        </form>
    </div>




{{-- province
city
district --}}





@endsection



{{-- <h1>Hello World</h1> --}}
