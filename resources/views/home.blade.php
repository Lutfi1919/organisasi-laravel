@extends('templates.app')

@section('navbar')

<link rel="stylesheet" href="{{ asset('css/home.css')}}">

<div class="container">
    <div class="text-center" style="margin: 120px 0px">
        <h1 class="" style="font-family: Barbra; font-size: 85px;">OSIS - MPR</h1>
        <h1 class="wk-text" style="font-family: Unbounded; font-size: 85px;">SMK WIKRAMA BOGOR</h1>
        <p class="" style="font-family: Unbounded">Utamakan Belajar, Nomor Satukan Organisasi</p>
        <div class="mt-4" style="font-family: Unbounded;">
            <a href="{{ route('login')}}" class="btn btn-login-regis rounded-pill fs-2" style="padding: 6px 65px !important;">Login</a>
            <a href="{{ route('register')}}" class="btn btn-login-regis rounded-pill px-5 fs-2">Register</a>
        </div>
    </div>
</div>

    <div class="container-fluid text-center text-white row visiMisi p-5 g-0">
        <div class="col px-5 border-end border-5">
            <h1 class="mt-4" style="font-family: Barbra; font-size: 60px;">Visi</h1>
            <p class="mt-5" style="font-family: Unbounded">Merealisasikan potensi OSIS dan menumbuhkan kreativitas siswa/i SMK Wikrama Bogor.</p>
        </div>
        <div class="col px-5" style="">
            <h1 class="mt-4" style="font-family: Barbra; font-size: 60px;">Misi</h1>
            <p class="mt-5" style="font-family: Unbounded;">Membangun program kerja yang efektif dan inovatif, mengoptimalkan tugas pokok dan fungsi OSIS, serta menjadi wadah bagi siswa untuk menyalurkan aspirasi dan bakat mereka.</p>
        </div>
    </div>

    <div class="text-center" style="font-family: Unbounded; margin: 80px 0px ;">
        <a href="{{ route('laporGDS')}}" class="btn btn-lapor-gds shadow-lg fw-semibold rounded-pill py-3 px-5 fs-2">Lapor GDS</a>
    </div>

    <div class="container pb-5" style="font-family: Unbounded;">
        <h1 class="" style="max-width: 550px">Siapa Aja di Balik OSIS-MPR Wikrama?</h1>
        <p class="mt-4 mb-5">Inilah susunan pengurus OSIS-MPR SMK Wikrama yang bakal jadi motor penggerak berbagai kegiatan seru di sekolah. Setiap posisi punya peran penting, dan bersama-sama kita wujudkan sekolah yang aktif, kreatif, dan berprestasi.</p>
        <div class="row">
            <div class="col-4 card card-anggota" style="width: ;">
                <img src="https://i.pinimg.com/736x/eb/76/a4/eb76a46ab920d056b02d203ca95e9a22.jpg" class="card-img-top ci-anggota shadow" alt="Gambar anggota" style="height: 380px; object-fit: cover;">
                <div class="card-body cb-anggota">
                    <a class="btn btn-nama rounded-pill px-4">Budi Srepet</a>
                    <p class="card-text mt-1">Ketua</p>
                </div>
            </div>
            <div class="col-4 card card-anggota">
                <img src="https://i.pinimg.com/736x/a1/64/de/a164de3d8f1190f182c754a066123edd.jpg" class="card-img-top ci-anggota shadow" alt="Gambar anggota" style="height: 380px; object-fit: cover;">
                <div class="card-body cb-anggota">
                    <a class="btn btn-nama rounded-pill px-4">Siti Granger</a>
                    <p class="card-text mt-1">Wakil Ketua</p>
                </div>
            </div>
            <div class="col-4 card card-anggota" style="width: ;">
                <img src="https://i.pinimg.com/1200x/3a/1f/ab/3a1fab0bf9d70e9b4f52792cefdc3328.jpg" class="card-img-top ci-anggota shadow" alt="Gambar anggota" style="height: 380px; object-fit: cover;">
                <div class="card-body cb-anggota">
                    <a class="btn btn-nama rounded-pill px-4">Nanang</a>
                    <p class="card-text mt-1">Bendahara</p>
                </div>
            </div>
            <div class="col-4 card card-anggota" style="width: ;">
                <img src="https://i.pinimg.com/736x/92/12/46/9212466a7a662172657b69e063012c23.jpg" class="card-img-top ci-anggota shadow" alt="Gambar anggota" style="height: 380px; object-fit: cover;">
                <div class="card-body cb-anggota">
                    <a class="btn btn-nama rounded-pill px-4">Asep Resink</a>
                    <p class="card-text mt-1">Sekretaris</p>
                </div>
            </div>
            <div class="col-4 card card-anggota" style="width: ;">
                <img src="https://i.pinimg.com/736x/6d/5e/05/6d5e05772a65bc525497fe65d82bdea4.jpg" class="card-img-top ci-anggota shadow" alt="Gambar anggota" style="height: 380px; object-fit: cover;">
                <div class="card-body cb-anggota">
                    <a class="btn btn-nama rounded-pill px-4">James Bond</a>
                    <p class="card-text mt-1">Anggota</p>
                </div>
            </div>
            <div class="col-4 card card-anggota" style="width: ;">
                <img src="https://i.pinimg.com/736x/69/29/66/692966d68bd0eebe483d45b473473c95.jpg" class="card-img-top ci-anggota shadow" alt="Gambar anggota" style="height: 380px; object-fit: cover;">
                <div class="card-body cb-anggota">
                    <a class="btn btn-nama rounded-pill px-4">Alex Wijaya</a>
                    <p class="card-text mt-1">Anggota</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid text-white event mt-5 pb-5" style="font-family: Unbounded">
        <h1 class="text-center pt-5">UPCOMING EVENTS!🚀</h1>
        <div class="row pt-5">
            <div class="col-6">
                <div class="card card-event ps-5" style="width:;">
                    <img src="https://i.pinimg.com/736x/a7/ab/b6/a7abb66b2fd1c4280530d22bcebb3c99.jpg" class="card-img-top ci-event rounded-4 shadow" alt="Pentas Seni" style="height: 370px; object-fit: cover;">
                    <div class="card-body cb-event">
                        <h5 class="card-title fs-3">Pentas Seni</h5>
                        <p class="card-text text-secondary" style="margin-top: -5px">1 Januari - 2 Januari 2025</p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card card-event pe-5" style="width:;">
                    <img src="https://i.pinimg.com/736x/7a/94/55/7a9455742a84e6b61c2e52ccb50c51d5.jpg" class="card-img-top ci-event rounded-4 shadow" alt="Rombel Meeting" style="height: 370px; object-fit: cover;">
                    <div class="card-body cb-event">
                        <h5 class="card-title fs-3">Class Meeting</h5>
                        <p class="card-text text-secondary" style="margin-top: -5px">1 Januari - 2 Januari 2025</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
@endsection
