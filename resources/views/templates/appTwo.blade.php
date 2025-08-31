<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OSIS MPR</title>
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhSC9ATot-jy80-BnxZFgkRpScGjONkkm-cQ&s" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sora:wght@100..800&family=Unbounded:wght@200..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="background"></div>

    <nav class="navbar shadow bg-body-tertiary py-2">
        <div class="container container-fluid">
            <a class="navbar-brand" href="#">
                <img src=" {{ asset('images/Logo_OSIS_WK.jpeg')}}" alt="Logo" width="30" height="30" class="d-inline-block align-text-center shadow" style="border-radius: 100%">
                    <span class="osis ms-2 fs-6">OSIS - MPR</span>
            </a>
            <div class="" style="font-family: Unbounded;">
                <a class="ms-5 text-white text-decoration-none" href="{{ route('home')}}" style="font-size: 18px">Home</a>
                <a class="ms-5 text-white text-decoration-none" href="{{ route('gallery')}}" style="font-size: 18px">Gallery</a>
                <a class="btn btn-lapor-nav ms-5 px-4 py-1 text-white text-decoration-none" href="{{ route('laporGDS')}}" style="background-color: black; font-size: 18px; border-radius: 12px;">Lapor GDS</a>
            </div>
        </div>
    </nav>

    <div class="">
        @yield('navbar')
    </div>

    <footer class="container-fluid pt-5 pb-5" style="background-color: #0643A0">
        <div class="row">
            <div class="col-6 mt-5 d-flex flex-column" style="padding-left: 80px">
                <a class="text-decoration-none mb-5" href="https://www.instagram.com/smkwikrama?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                    <img src=" {{ asset('images/wikrama-logo.png')}}" alt="Logo" width="60" height="60" class="d-inline-block align-text-center shadow" style="border-radius: 100%">
                    <span class="osis ms-2 fs-4 text-white" style="font-family: Unbounded">SMK Wikrama Bogor</span>
                </a>
                <a class="text-decoration-none" href="https://www.instagram.com/osismpr_smkwikrama?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                    <img src=" {{ asset('images/Logo_OSIS_WK.jpeg')}}" alt="Logo" width="60" height="60" class="d-inline-block align-text-center shadow" style="border-radius: 100%">
                    <span class="osis ms-2 fs-4 text-white">OSIS - MPR</span>
                </a>
            </div>
            <div class="col-6 text-white" style="font-family: Unbounded">
                <h2>Saran dan Masukan Untuk Kami:</h2>
                <p class="mt-4">Email:</p>
                <p style="margin-top: -17px">osismpr@smkwikrama.sch.id</p>
                <p>Ikuti Kami</p>
                <div class="">
                    <a href="" class="fs-2 logo text-white"><i class="fa-brands fa-instagram"></i></a>
                    <a href="" class="fs-2 logo text-white ms-2"><i class="fa-brands fa-facebook"></i></a>
                    <a href="" class="fs-2 logo text-white ms-2"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <div class="">
        @yield('footer2')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
</body>
</html>
