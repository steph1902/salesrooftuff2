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
                        {{-- <th>Nama</th> --}}
                        <!-- Add more table headings for other attributes -->
                        <th>E-mail</th>
                        <th>Cek Detail</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                       
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        {{-- <th>NIK</th> --}}
                        {{-- <th>Nama</th> --}}
                        <th>E-mail</th>
                        <!-- Add more table headings for other attributes -->
                        <th>Cek Detail</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                       
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        {{-- <td>{{ $sale->nik }}</td> --}}
                        {{-- <td>{{ $sale->name }}</td> --}}
                        <td>{{ $sale->email }}</td>
                        <td>
                            <a href="{{ route('sales.show', $sale->id) }}">Lihat Detail</a>
                        </td>
                        <td>
                            <a href="{{ route('sales.edit', $sale->id) }}">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" type="submit">Hapus</button>
                            </form>
                        </td>
                                                                                                                                                                 
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- 
-- Table: public.users

-- DROP TABLE IF EXISTS public.users;

CREATE TABLE IF NOT EXISTS public.users
(
    id bigint NOT NULL DEFAULT nextval('users_id_seq'::regclass),
    name character varying(255) COLLATE pg_catalog."default",
    email character varying(255) COLLATE pg_catalog."default",
    email_verified_at timestamp(0) without time zone,
    password text COLLATE pg_catalog."default",
    remember_token character varying(100) COLLATE pg_catalog."default",
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    role character varying(255) COLLATE pg_catalog."default" DEFAULT 'user'::character varying,
    peran_user character varying(255) COLLATE pg_catalog."default",
    tanggal_lahir date,
    nomor_ktp_sales character varying(255) COLLATE pg_catalog."default",
    nomor_handphone_sales character varying(255) COLLATE pg_catalog."default",
    verification_code character varying(255) COLLATE pg_catalog."default",
    verification_expires_at timestamp without time zone,
    is_verified boolean DEFAULT false,
    CONSTRAINT users_pkey PRIMARY KEY (id),
    CONSTRAINT users_email_unique UNIQUE (email)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.users
    OWNER to stephs; --}}


@endsection




