@extends('templates.appTwo')

@section('navbar')

<link rel="stylesheet" href="{{ asset(path: 'css/GDS.css')}}">

<form action="" class="container" style="margin-top: 160px !important; margin-bottom: 120px; font-family: Unbounded;">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input type="text" class="form-control border-black" id="exampleFormControlInput1" name="name">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIS</label>
                <input type="text" class="form-control border-black" id="exampleFormControlInput1" name="nis">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Perbuatan</label>
                <input type="text" class="form-control border-black" id="exampleFormControlInput1" name="action">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Hari / Tanggal</label>
                <input type="date" class="form-control border-black" id="exampleFormControlInput1" name="day_date">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Pelapor</label>
                <input type="text" class="form-control border-black" id="exampleFormControlInput1" name="name_reporter">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">NIS Pelapor</label>
                <input type="text" class="form-control border-black" id="exampleFormControlInput1" name="nis_reporter">
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-submit text-white" style="background-color: #0643A0; border-radius: 13px; padding: 7px 250px;">Submit</button>
    </div>
</form>

@endsection

@section('footer2')
@endsection
