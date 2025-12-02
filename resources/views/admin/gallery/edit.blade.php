@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">

<div class="w-75 d-block mx-auto p-4" style="margin-top: 100px; font-family: Unbounded;">
        @if (Session::get('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <h2 class="text-center mb-5">
            Edit Data Gallery
        </h2>
        <form method="POST" action="{{ route('admin.gallery.update', $galleries['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $galleries['name'] }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="day" class="form-label">Hari / Tanggal</label>
                    <input type="date" class="form-control  @error('day_date') is-invalid @enderror" id="day_date" name="day_date" value="{{ $galleries['date'] }}">
                    @error('day_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="photo_gallery" class="form-label">Foto</label>
                        <div class="">
                            <img src="{{ asset('storage/' . $galleries['photo_gallery']) }}" class="rounded mb-2" width="200" alt="">
                        </div>
                        <input type="file" name="photo_gallery" id="photo_gallery" class="form-control  @error('photo_gallery') is-invalid @enderror">
                        @error('photo_gallery')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-10">
                    <button type="submit" class="btn btn-submit text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Submit</button>
                </div>
                <div class="col-2">
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
