@extends('layouts.sales')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Upload Foto') }}</div>
                    <div class="card-body">
                        <form action="{{ route('visits.store', $shop->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Hidden fields for location, date, and time -->
                            <input type="hidden" name="location" id="location">
                            <input type="hidden" name="datetime" id="datetime">
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">

                            <div class="form-group">
                                <label for="address">Alamat:</label>
                                <input type="text" class="form-control" id="address" name="address" required readonly>
                                <small class="form-text text-muted">Alamat ini didapatkan secara otomatis berdasarkan lokasi saat ini.</small>
                            </div>

                            <div class="form-group">
                                <label for="photo">Upload Foto:</label>
                                <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*" capture="camera" required>
                                <small class="form-text text-muted">Harap mengambil foto baru. Foto dari galeri tidak diizinkan.</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Otomatis mengambil alamat, lokasi, tanggal, dan waktu saat ini
        function getCurrentLocation() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    // Gunakan Nominatim API untuk mendapatkan alamat berdasarkan lokasi
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.display_name) {
                                document.getElementById('address').value = data.display_name;
                                document.getElementById('location').value = `Lat: ${position.coords.latitude}, Long: ${position.coords.longitude}`;

                                var currentDate = new Date();
                                var formattedDate = currentDate.toISOString().slice(0, 19).replace("T", " ");
                                document.getElementById('datetime').value = formattedDate;
                            } else {
                                alert("Alamat tidak ditemukan. Harap masukkan alamat secara manual.");
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching address:', error);
                            alert("Terjadi kesalahan saat mencari alamat. Coba lagi nanti.");
                        });
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }


        getCurrentLocation();
    </script>
@endsection
