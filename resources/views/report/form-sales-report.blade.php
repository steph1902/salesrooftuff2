@if(Auth::check())

    @if(Auth::user()->role === 'sales')
        @extends('layouts.sales')
    @elseif(Auth::user()->role === 'SUPERADMIN')
        @extends('layouts.superadmin')
    @endif
@endif

@section('content')


@php
    use Carbon\Carbon;
    $users = \App\Models\User::all();
    $bulan = '1';
    $tahun = '2024';
@endphp



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sales Report Form</div>

                <div class="card-body">
                    <form action="{{ route('sales-report') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="users">Nama Sales:</label>
                            <select name="users" id="users" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bulan">Pilih Bulan:</label>
                            <select name="bulan" id="bulan" class="form-control">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}"{{ $i == $bulan ? ' selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tahun">Pilih Tahun:</label>
                            <select name="tahun" id="tahun" class="form-control">
                                @for ($i = date('Y'); $i >= 2022; $i--)
                                    <option value="{{ $i }}"{{ $i == $tahun ? ' selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

