@extends('templates.appTwo')

@section('navbar')


<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">

<h1 class="text-center mb-5" style="margin-top: 160px !important; font-family: Unbounded;">Login</h1>
<form action="{{ route('login.auth') }}" method="POST" class="container" style="margin-bottom: 120px; font-family: Unbounded;">
    @csrf
        @if (Session::get('ok'))
            <div class="alert alert-success">{{ Session::get('ok') }}</div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
    <div class="row">
        <div class="col-6">
            <div class="">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
            </div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-6">
            <div class="">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="text-center mt-3">
        <button type="submit" class="btn btn-submit py-2 text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Login</button>
    </div>
</form>

@endsection
@section('footer2')
@endsection
