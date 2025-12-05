@extends('templates.appTwo')

@section('navbar')

<link rel="stylesheet" href="{{ asset('css/gallery.css')}}">

<div class="container" style="margin-top: 130px !important; margin-bottom: 130px !important;">
    <div class="row g-3 justify-content-center">
        @foreach ($galleries->split(3) as $galleryCol)
            <div class="col-auto">
                @foreach ($galleryCol as $gallery)
                    <div class="gambar">
                        <img src="{{ asset('storage/' . $gallery->photo_gallery) }}" alt="" style="width: 300px; margin-bottom: 20px;">
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

@endsection
