@extends('templates.appTwo')

@section('navbar')

<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">

<form method="POST" action="{{ route('staff.store') }}" class="container" enctype="multipart/form-data" style="margin-top: 160px !important; margin-bottom: 120px; font-family: Unbounded;">
    @csrf
    @if (Session::get('ok'))
        <div class="alert alert-success mt-4">{{ Session::get('ok') }}</div>
    @endif
    @if (Session::get('error'))
        <div class="alert alert-danger mt-4">{{ Session::get('error') }}</div>
    @endif
    <h1 class="text-center mb-5">Lapor Perbuatan</h1>
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="number" class="form-control  @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis') }}">
                @error('nis')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="action" class="form-label">Perbuatan</label>
                <br>
                <select class="form-select @error('action') is-invalid @enderror" name="action" style="border: 2px solid #ced1d4;">
                    <option value="">Pilih Perbuatan</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('action')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="day" class="form-label">Hari / Tanggal</label>
                <input type="date" class="form-control  @error('day_date') is-invalid @enderror" id="day" name="day_date" value="{{ old('day_date') }}">
                @error('day_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="reporter" class="form-label">Nama Pelapor</label>
                <input type="text" class="form-control  @error('name_reporter') is-invalid @enderror" id="reporter" name="name_reporter" value="{{ old('name_reporter') }}">
                @error('name_reporter')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="nis_reporter" class="form-label">NIS Pelapor</label>
                <input type="text" class="form-control  @error('nis_reporter') is-invalid @enderror" id="nis_reporter" name="nis_reporter" value="{{ old('nis_reporter') }}">
                @error('nis_reporter')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="photo_report" class="form-label">Foto Laporan</label>
                <input type="file" name="photo_report" id="photo_report" class="form-control  @error('photo_report') is-invalid @enderror">
                @error('photo_report')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-submit py-2 text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Submit</button>
    </div>
</form>

@endsection

@section('footer2')
@endsection
