@extends('templates.appTwo')

@section('navbar')


<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">


<form action="{{ route('login.auth') }}" method="POST" class="container" style="margin-top: 160px !important; margin-bottom: 120px; font-family: Unbounded;">
    @csrf
        @if (Session::get('ok'))
            <div class="alert alert-success">{{ Session::get('ok') }}</div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control border-black" id="exampleFormControlInput1" name="email">
            </div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="password" class="form-control border-black" id="exampleFormControlInput1" name="password">
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-submit text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Login</button>
    </div>
</form>

@endsection
@section('footer2')
@endsection
