@extends('layouts.superadmin')
@section('content')


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


    {{-- <h1>Sales List</h1> --}}

    <a href="{{ route('sales.create') }}">Create New Sales</a>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            {{-- &year; --}}
            Daftar Sales
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        {{-- <th>NIK</th> --}}
                        
                        <!-- Add more table headings for other attributes -->
                        <th>Nama</th>
                        <th>E-mail</th>
                        <th>Action</th>
                        {{-- <th>Cek Detail</th> --}}
                        {{-- <th>Edit</th> --}}
                        {{-- <th>Hapus</th> --}}
                       
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        {{-- <th>NIK</th> --}}
                        {{-- <th>Nama</th> --}}
                        <th>Nama</th>
                        <th>E-mail</th>
                        <th>Action</th>
                        <!-- Add more table headings for other attributes -->
                        {{-- <th>Cek Detail</th> --}}
                        {{-- <th>Edit</th> --}}
                        {{-- <th>Hapus</th> --}}
                       
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        {{-- <td>{{ $sale->nik }}</td> --}}
                        {{-- <td>{{ $sale->name }}</td> --}}
                        <td>
                            <a href="{{ route('view-sales-details-shop-data', ['namasales' => $sale->name]) }}">
                            {{-- <a href="{{ route('view-sales-details-shop-data', ['name' => $sale->name ?? '']) }}"> --}}
                                {{ $sale->name }}
                            </a>
                        </td>
                        <td>{{ $sale->email }}</td>
                        <td>
                            <a class="btn" href="{{ route('sales.show', $sale->id) }}">
                                <i class="fas fa-eye"></i>
                                Lihat Detail Data Sales
                            </a>

                            <br>

                            <a class="btn" href="{{ route('sales.edit', $sale->id) }}">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>

                            <br>

                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </td>



                                                                                                                                                                 
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection




