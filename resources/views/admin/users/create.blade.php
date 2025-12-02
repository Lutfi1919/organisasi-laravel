@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">

<div class="w-75 d-block mx-auto p-4" style="margin-top: 100px; font-family: Unbounded;">
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <h2 class="text-center mb-3">
            Buat Data Staff
        </h2>
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="number" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') }}">
                    @error('nis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">{{ old('password') }}</input>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-10">
                    <button type="submit" class="btn btn-submit text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Submit</button>
                </div>
                <div class="col-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary utility-btns"><i class="bi bi-arrow-left"></i> Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
