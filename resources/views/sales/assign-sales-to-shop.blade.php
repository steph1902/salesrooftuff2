@extends('layouts.app')
@section('content')


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- <form method="POST" action="{{ route('assign.sales.to.shop') }}"> --}}
<form method="POST" action="{{ route('assign.sales.to.shop.save') }}">

    @csrf

    <div class="form-group">
        <label for="salesperson_id">Select Salesperson:</label>
        <select id="salesperson_id" name="salesperson_id" class="form-control" required>
            <option value="">Select Salesperson</option>
            @foreach ($salespeople as $salesperson)
                <option value="{{ $salesperson->id }}">{{ $salesperson->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="shop_region">Select Shop Region:</label>
        <select id="shop_region" name="shop_region[]" class="form-control" required>
            <option value="">Select Shop Region</option>
            @foreach ($shopRegions as $region)
                <option value="{{ $region }}">{{ $region }}</option>
            @endforeach
        </select>
    </div>
    

    <div class="form-group">
        <label for="shop_id">Select Shop:</label>
        <select id="shop_id" name="shop_id" class="form-control" required>
            <option value="">Select Shop</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Assign Salesperson to Shop</button>
</form>

<script>


const shopRegionSelect = document.getElementById('shop_region');
const shopSelect = document.getElementById('shop_id');

shopRegionSelect.addEventListener('change', function() {
    const shopRegion = this.value;

    fetch('{{ route('search.shops') }}?term=&shopRegion=' + encodeURIComponent(shopRegion))
        .then(response => response.json())
        .then(data => {
            populateShopOptions(data);
        })
        .catch(error => {
            console.log('Error:', error);
        });
});

    function populateShopOptions(data) {
        // Clear existing options
        shopSelect.innerHTML = '<option value="">Select Shop</option>';

        // Add new options based on search results
        data.forEach(shop => {
            const option = document.createElement('option');
            option.value = shop.id;
            option.textContent = shop.name;
            shopSelect.appendChild(option);
        });
    }
</script>
@endsection
