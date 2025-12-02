@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/users.css')}}">

    <div class="container mb-5" style="margin-top: 100px; font-family: Unbounded;">
        @if (Session::get('failed'))
            <div class="alert alert-danger mt-4">{{ Session::get('failed') }}</div>
        @endif
        <div class="d-flex justify-content-end gap-1">
            <a href="{{ route('admin.events.index')}}" class="btn utility-btns btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        @if (Session::get('success'))
            <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>
        @endif
        <h2>Data Sampah Event</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle custom-table mt-3" style="font-family: DM Sans;">
                <thead>
                    <tr class="text-center" style="font-family: Unbounded;">
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $key => $event)
                        <tr class="fw-light">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td class="text-center">
                                <img
                                    src="{{ asset('storage/' . $event['photo_event']) }}"
                                    alt="Event Photo"
                                    width="100"
                                    class="rounded"
                                >
                            </td>
                            <td>{{ $event['name'] }}</td>
                            <td class="text-center">{{ $event['formatted_date'] }}</td>
                            <td class="text-center action-btns">
                                <form action="{{ route('admin.events.restore', $event['id'])}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-success utility-btns"><i class="bi bi-recycle"></i> Pulihkan Data</button>
                                </form>
                                <form action="{{ route('admin.events.delete_permanent', $event['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger ms-1"><i class="bi bi-trash me-1"></i>Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
