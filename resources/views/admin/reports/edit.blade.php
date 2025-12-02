@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">

<form method="POST" action="{{ route('admin.reports.update', $report['id']) }}" class="container" enctype="multipart/form-data" style="margin-top: 160px !important; margin-bottom: 120px; font-family: Unbounded;">
    @csrf
    @method('PUT')
    @if (Session::get('ok'))
        <div class="alert alert-success mt-4">{{ Session::get('ok') }}</div>
    @endif
    @if (Session::get('error'))
        <div class="alert alert-danger mt-4">{{ Session::get('error') }}</div>
    @endif
    <h1 class="text-center mb-3">Edit Data Laporan</h1>
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $report['suspect']['name'] }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ $report['suspect']['nis'] }}">
                @error('nis')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="action" class="form-label">Perbuatan</label>
                <br>
                <select class="form-select" name="action">
                    <option value="">Pilih Perbuatan</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $report['category_id'] == $category['id'] ? 'selected' : '' }}>{{ $category->name }}</option>
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
                <input type="date" class="form-control @error('day_date') is-invalid @enderror" id="day" name="day_date" value="{{ $report['date'] }}">
                @error('day_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="reporter" class="form-label">Nama Pelapor</label>
                <input type="text" class="form-control @error('name_reporter') is-invalid @enderror" id="reporter" name="name_reporter" value="{{ $report['council']['name'] }}">
                @error('name_reporter')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="nis_reporter" class="form-label">NIS Pelapor</label>
                <input type="text" class="form-control @error('nis_reporter') is-invalid @enderror" id="nis_reporter" name="nis_reporter" value="{{ $report['council']['nis'] }}">
                @error('nis_reporter')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="photo_report" class="form-label">Foto Laporan</label>
                <div class="">
                    <img src="{{ asset('storage/' . $report['photo_report']) }}" class="rounded mb-2" width="200" alt="">
                </div>
                <input type="file" name="photo_report" id="photo_report" class="form-control @error('photo_report') is-invalid @enderror">
                @error('photo_report')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex row">
        <div class="col-11">
            <button type="submit" class="btn btn-submit text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Submit</button>
        </div>
        <div class="col-1">
            <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</form>

@endsection
