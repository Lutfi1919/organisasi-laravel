@extends('templates.app')

@section('navbar')

<link rel="stylesheet" href="{{ asset('css/home.css')}}">
@if (Session::get('success'))
        {{-- Auth::user() : mengambil data pengguna, Auth::user()->fieldtableusers --}}
    <div class="alert alert-success container w-100 rounded-3" style="margin-top: 90px; font-family: Unbounded;">{{ Session::get('success') }}
        <b>Selamat Datang, {{ Auth::user()->name }}!</b>
    </div>
@endif
@if (Session::get('logout'))
    <div class="alert alert-warning container rounded-3" style="margin-top: 90px; font-family: Unbounded;">{{ Session::get('logout') }}</div>
@endif

<div class="container">
    <div class="text-center" style="margin: 120px 0px">
        <h1 class="" style="font-family: Barbra; font-size: 85px;">OSIS - MPR</h1>
        <h1 class="wk-text" style="font-family: Unbounded; font-size: 85px;">SMK WIKRAMA BOGOR</h1>
        <p class="" style="font-family: Unbounded">Utamakan Belajar, Nomor Satukan Organisasi</p>
        @if (Auth::check())
            <div class="mt-4" style="font-family: Unbounded;">
                <a href="{{ route('logout') }}" class="btn btn-login-regis rounded-pill fs-2" style="padding: 6px 65px !important;">Logout</a>
            </div>
        @else
        <div class="mt-4 tooltip-login" style="font-family: Unbounded;">
            <a href="{{ route('login')}}" class="btn btn-login-regis rounded-pill fs-2" style="padding: 6px 65px !important;"
                data-bs-toggle="tooltip"
                data-bs-placement="bottom"
                title="Hanya untuk OSIS dan Admin">
                Login
            </a>
        </div>
        @endif
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

    @if (Auth::check() && Auth::user()->role == 'staff')
        <div class="text-center" style="font-family: Unbounded; margin: 80px 0px ;">
            <a href="{{ route('staff.laporGDS')}}" class="btn btn-lapor-gds shadow-lg fw-semibold rounded-pill py-3 px-5 fs-3">Lapor GDS</a>
        </div>
    @else
        <div class="text-center d-none" style="font-family: Unbounded; margin: 80px 0px ;">
            <a href="{{ route('staff.laporGDS')}}" class="btn btn-lapor-gds shadow-lg fw-semibold rounded-pill py-3 px-5 fs-3">Lapor GDS</a>
        </div>
    @endif

    @if (Auth::check() && Auth::user()->role == 'staff')
        <div class="d-none"></div>
    @else
        <div class="p-5"></div>
    @endif

    <div class="container pb-5" style="font-family: Unbounded;">
        <h1 class="" style="max-width: 550px">Siapa Aja di Balik OSIS-MPR Wikrama?</h1>
        <p class="mt-4 mb-5">Inilah susunan pengurus OSIS-MPR SMK Wikrama yang bakal jadi motor penggerak berbagai kegiatan seru di sekolah. Setiap posisi punya peran penting, dan bersama-sama kita wujudkan sekolah yang aktif, kreatif, dan berprestasi.</p>
        <div class="row">
            @foreach ($councils as $key => $council)
                <div class="col-4 card card-anggota" style="width: ;">
                    <img src="{{ asset('storage/' . $council->photo_council) }}" class="card-img-top ci-anggota shadow" alt="Gambar anggota" style="height: 380px; object-fit: cover;">
                    <div class="card-body cb-anggota">
                        <a class="btn btn-nama rounded-pill px-4">{{ $council['name'] }}</a>
                        @if ($key == 0)
                            <p class="card-text mt-1">Ketua</p>
                        @elseif ($key == 1)
                            <p class="card-text mt-1">Wakil Ketua</p>
                        @elseif ($key == 2)
                            <p class="card-text mt-1">Bendahara</p>
                        @elseif ($key == 3)
                            <p class="card-text mt-1">Sekretaris</p>
                        @else
                            <p class="card-text mt-1">Anggota</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid text-white event mt-5 pb-5" style="font-family: Unbounded">
        <h1 class="text-center pt-5">UPCOMING EVENTS!🚀</h1>
        <div id="eventCarousel" class="carousel slide pt-5" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach ($events->chunk(2) as $chunkIndex => $eventChunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            @foreach ($eventChunk as $event)
                                <div class="col-md-5">
                                    <div class="card card-event rounded-4">
                                        <img src="{{ asset('storage/' . $event->photo_event) }}" class="card-img-top rounded-4" style="height:370px;object-fit:cover;">
                                        <div class="card-body text-center">
                                            <h5 class="fs-3">{{ $event->name }}</h5>
                                            <p class="text-secondary" style="margin-top:-5px">{{ $event->formatted_date }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
                <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            [...tooltipTriggerList].forEach(tooltipTriggerEl => {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

    </script>
@endpush

@section('footer')
@endsection
