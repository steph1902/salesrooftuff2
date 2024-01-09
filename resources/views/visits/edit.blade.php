@extends('layouts.sales')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lengkapi Informasi Data Visit Toko') }}</div>
                <div class="card-body">
                    {{-- <h2>{{ $shop->shop_name }}</h2>
                    <p>Alamat: <b>{{ $shop->shop_address }}</b>  </p>
                    <p>Provinsi: <b>{{ $shop->provinsi }}</b> </p>
                    <p>Kota: <b>{{ $shop->kota }}</b>  </p>
                    <p>Kecamatan:  <b>{{ $shop->kecamatan }}</b> </p>
                    <p>Kelurahan: <b>{{ $shop->kelurahan }}</b>  </p> --}}

                    {{-- <h2>Kunjungi toko</h2> --}}

                    <form method="POST" action="{{ route('visits.update', $visit->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="shop_id" value="{{ $visit->id }}">

                        


                        <div class="form-group">
                            <label for="notes">Notes:</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            @error('notes')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Marketing Materials:</label><br>


                            <label for="brochure">
                                <input type="checkbox" id="brochure" name="materials[]" value="brochure"> Brochure
                            </label><br>

                            <label for="standing_banner">
                                <input type="checkbox" id="standing_banner" name="materials[]" value="standing_banner"> Standing Banner
                            </label><br>

                            <label for="billboard">
                                <input type="checkbox" id="billboard" name="materials[]" value="billboard"> Billboard
                            </label><br>

                            <label for="hanging_banner">
                                <input type="checkbox" id="hanging_banner" name="materials[]" value="hanging_banner"> Hanging Banner
                            </label><br>

                            <!-- Add checkbox for Sticker Mobil -->
                            <label for="sticker_mobil">
                                <input type="checkbox" id="sticker_mobil" name="materials[]" value="sticker_mobil"> Sticker Mobil
                            </label><br>

                            <!-- Add checkbox for Sample Renceng -->
                            <label for="sample_renceng">
                                <input type="checkbox" id="sample_renceng" name="materials[]" value="sample_renceng"> Sample Renceng
                            </label><br>

                            @error('materials')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        

                        <button type="submit" class="btn btn-primary">Submit</button>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
        </div>
    </div>
</div>


@endsection
