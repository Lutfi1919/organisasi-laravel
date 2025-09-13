@extends('templates.appTwo')

@section('navbar')

<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">


<form class="container" method="POST" action="" style="margin-top: 160px !important; margin-bottom: 120px; font-family: Unbounded;">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input type="text" class="form-control border-black @error ('name') is-invalid @enderror" id="exampleFormControlInput1" name="name" value="{{ old('name')}}">
            </div>
            @error('name')
                {{-- @error('name_input') : mengambil error validasi input tsb --}}
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIS</label>
                <input type="text" class="form-control border-black @error ('nis') is-invalid @enderror" id="exampleFormControlInput1" name="nis" value="{{ old('nis')}}">
            </div>
            @error('nis')
                    <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control border-black @error ('email') is-invalid @enderror" id="exampleFormControlInput1" name="email" value="{{ old('email')}}">
            </div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="password" class="form-control border-black @error ('password') is-invalid @enderror" id="exampleFormControlInput1" name="password" value="{{ old('password')}}">
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-submit text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Register</button>
    </div>
</form>

@endsection

@section('footer2')
@endsection
