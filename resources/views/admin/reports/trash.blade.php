@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/reports.css')}}">

    <div class="container d-flex justify-content-end" style="padding-top: 90px; font-family: Unbounded;">
        <a href="{{ route('admin.reports.index')}}" class="btn btn-secondary utility-btns"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>
    <h2 class="container" style="font-family: Unbounded;">Data Sampah Laporan GDS</h2>
    @if (Session::get('success'))
        <div class="container mt-3 alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="table-responsive container mb-5">
        <table class="table table-bordered table-hover align-middle custom-table" style="font-family: DM Sans;">
            <thead>
                <tr class="text-center" style="font-family: Unbounded;">
                    <th>#</th>
                    <th>ID Pelapor</th>
                    <th>ID Pelaku</th>
                    <th>ID Perbuatan</th>
                    <th>Foto Laporan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $key => $report)
                    <tr class="text-center align-middle">
                        <td class="fw-bold">{{ $key+1 }}</td>
                        <td>{{ $report['council']['id'] }}</td>
                        <td>{{ $report['suspect']['id'] }}</td>
                        <td>{{ $report['category']['id'] }}</td>
                        <td>
                            <img
                                src="{{ asset('storage/' . $report['photo_report']) }}"
                                alt="Report Photo"
                                width="100"
                                class="rounded"
                            >
                        </td>
                        <td>{{ $report['date'] }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <button type="button" class="btn btn-sm btn-outline-secondary utility-btns"
                                    data-report='@json($report)'
                                    onclick="showModal(this)">
                                    <i class="bi bi-search"></i> Detail
                                </button>
                                <form action="{{ route('admin.reports.restore', $report['id'])}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-success utility-btns"><i class="bi bi-recycle"></i> Pulihkan Data</button>
                                </form>
                                <form action="{{ route('admin.reports.delete_permanent', $report['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger utility-btns"><i class="bi bi-trash me-1"></i>Hapus Permanen</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div class="modal fade mt-5" id="modalDetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header text-center" style="font-family: Unbounded">
                <h1 class="modal-title fs-5 text-center" id="modalTitle"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalBody">...</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        window.showModal = function(button) {
            const item = JSON.parse(button.dataset.report);
            const image = "{{ asset('storage') }}/" + (item.photo_report ?? '');
            const content = `
                <img src="${image}" width="150" class="d-block mx-auto my-2">
                <hr>
                <ul class="list-unstyled" style="font-family: Outfit;">
                    <li><b>Pelapor :</b> ${item.council?.name ?? '-'}</li>
                    <li><b>Pelaku :</b> ${item.suspect?.name ?? '-'}</li>
                    <li><b>Perbuatan :</b> ${item.category?.name ?? '-'}</li>
                    <li><b>Tanggal :</b> ${item.date ?? '-'}</li>
                </ul>
            `;
            document.querySelector("#modalBody").innerHTML = content;
            document.querySelector("#modalTitle").innerText = `Laporan #${item.id}`;
            new bootstrap.Modal(document.getElementById('modalDetail')).show();
        }
    </script>
@endpush
