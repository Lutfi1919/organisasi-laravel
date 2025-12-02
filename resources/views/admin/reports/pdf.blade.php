<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Laporan GDS</title>

    <style>
        h1 {
            text-align: center
        }
    </style>
</head>
<body>
    <div class="">
        @foreach ($report as $laporan)
            <div class="">
                <h1><b>Data Laporan GDS ke-{{ $laporan['id'] }}</b></h1>
                <hr>
                <h2><b>{{ $laporan['category']['name'] }}</b></h2>
                <hr>
                <img src="{{ public_path('storage/' . $laporan['photo_report']) }}" alt="Foto Laporan" width="100">
                <p>
                    Tanggal : {{ \Carbon\Carbon::parse($laporan['date'])->format('d F, Y') }}
                </p>
                <p>
                    Pelaku : {{ $laporan['suspect']['name'] }}
                </p>
                <p>
                    Pelapor : {{ $laporan['council']['name'] }}
                </p>
            </div>
        @endforeach
    </div>
</body>
</html>
