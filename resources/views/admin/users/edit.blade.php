@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">

    <div class="w-75 d-block mx-auto p-4" style="margin-top: 100px; font-family: Unbounded;">
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <h2 class="text-center mb-3">
            Edit Data Staff
        </h2>
        <form method="POST" action="{{ route('admin.users.update', $users['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $users['name'] }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $users['email'] }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-flex row">
                <div class="col-10">
                    <button type="submit" class="btn btn-submit utility-btns text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Submit</button>
                </div>
                <div class="col-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary utility-btns">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
