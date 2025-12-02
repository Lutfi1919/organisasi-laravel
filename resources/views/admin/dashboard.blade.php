@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/home.css')}}">

    <div class="container text-center" style="margin-top: 130px; font-family: DM Sans;">
        <div class="row">
            <div class="col">
                <div class="card card-dash shadow-sm text-center p-3 rounded-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="fw-semibold">{{ $jumlahStaff }}</h1>
                            <small style="color: #7d7d7d">Jumlah Staff</small>
                        </div>
                        <div class="col text-end mt-1 me-3">
                            <i class="fs-1 bi bi-people-fill" style="color:#032761"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-dash text-center p-3 rounded-3 shadow-sm">
                    <div class="row">
                        <div class="col">
                            <h1 class="fw-semibold">{{ $jumlahOsis }}</h1>
                            <small style="color: #7d7d7d">Jumlah Anggota OSIS</small>
                        </div>
                        <div class="col text-end mt-1 me-3">
                            <i class="fs-1 bi bi-person-arms-up" style="color:#032761"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-dash shadow-sm text-center p-3 rounded-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="fw-semibold">{{ $jumlahLaporan }}</h1>
                            <small class="text-truncate" style="color: #7d7d7d">Jumlah Laporan Masuk</small>
                        </div>
                        <div class="col text-end mt-1 me-3">
                            <i class="fs-1 bi bi-journals" style="color:#032761"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-8 rounded-3">
                <div class="card card-dash shadow-sm align-middle p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="m-0 ms-3 fw-bold">Data Laporan Masuk</h2>
                        <a href="{{ route('admin.reports.index') }}" class="btn utility-btns d-flex align-items-center gap-2 px-3 py-1 rounded-3 shadow-sm text-white" style="background-color:#0642a0">
                            <span>Detail</span>
                            <i class="bi bi-arrow-right fs-5"></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive container">
                        <table class="table table-hover align-middle custom-table" style="font-family: DM Sans;">
                            <thead>
                                <tr class="text-center" style="font-family: Unbounded;">
                                    <th>#</th>
                                    <th>Pelapor</th>
                                    <th>Pelaku</th>
                                    <th>Perbuatan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $key => $report)
                                    <tr class="text-center align-middle">
                                        <td class="fw-bold">{{ $key+1 }}</td>
                                        <td class="text-start">{{ $report['council']['name'] }}</td>
                                        <td>{{ $report['suspect']['name'] }}</td>
                                        <td>{{ $report['category']['name'] }}</td>
                                        <td>{{ $report['formatted_date'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4 rounded-3">
                <div class="card card-dash shadow-sm p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0 ms-3 fw-bold" style="letter-spacing: -0.5px">Data Anggota OSIS</h5>
                        <a href="{{ route('admin.osis.index') }}" class="btn utility-btns d-flex align-items-center gap-2 px-3 py-1 rounded-3 shadow-sm text-white" style="background-color:#0642a0">
                            <span>Detail</span>
                            <i class="bi bi-arrow-right fs-5"></i>
                        </a>
                    </div>
                    <hr>
                    <div class="table-responsive container">
                        <table class="table table-hover align-middle custom-table" style="font-family: DM Sans;">
                            <tbody>
                                @foreach ($councils as $key => $council)
                                    <tr class="text-center align-middle">
                                        <td>
                                            <img
                                                src="{{ asset('storage/' . $council['photo_council']) }}"
                                                alt="Council Photo"
                                                width="50"
                                                height="50"
                                                class="rounded-circle object-fit-cover shadow-sm"
                                            >
                                        </td>
                                        <td class="text-start">{{ $council['name'] }}</td>
                                        <td>{{ $council['nis'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container bg-white rounded-3 border shadow p-4 mt-5">
            <h2 class="fw-bold">Grafik Aktivitas</h2>
            <div class="mt-3">
                <h5>Data Laporan Masuk Bulan {{ now()->format('F') }}</h5>
                <canvas class="mt-3 w-" id="chartBar"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        let labelBar = [];
        let dataBar = [];

        $(function() {
            $.ajax({
                url: "{{ route('admin.reports.chart') }}",
                method: "GET",
                success: function(response) {
                    labelBar = response.labels;
                    dataBar = response.data;
                    chartBar();
                },
                error: function(err) {
                    alert('Gagal mengambil data untuk chart bar!');
                }
            })
        });

        function chartBar(){
            const ctx = document.getElementById('chartBar');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelBar,
                    datasets: [{
                        label: 'Laporan Masuk Bulan Ini',
                        data: dataBar,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endpush
