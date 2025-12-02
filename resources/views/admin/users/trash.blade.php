@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/users.css')}}">

    <div class="container mb-5" style="margin-top: 100px; font-family: Unbounded;">
        <div class="d-flex justify-content-end gap-1">
            <a href="{{ route('admin.users.index')}}" class="btn btn-secondary utility-btns"><i class="bi bi-arrow-left"></i> Kembali</a>
        </div>
        @if (Session::get('success'))
            <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>
        @elseif (Session::get('failed'))
            <div class="alert alert-danger mt-4">{{ Session::get('failed') }}</div>
        @endif

        <h2>Data Sampah Pengguna</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle custom-table mt-3" style="font-family: DM Sans;">
                <thead>
                    <tr class="text-center" style="font-family: Unbounded;">
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $item)
                        <tr class=" fw-light">
                            <td class="text-center fw-bold">{{ $key+1 }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td class="text-center">
                                @if ($item['role'] === 'admin')
                                    <span class="badge text-bg-success px-3 py-2 text-capitalize">{{ $item['role'] }}</span>
                                @elseif ($item['role'] === 'staff')
                                    <span class="badge text-bg-primary fw-medium px-3 py-2 text-capitalize">{{ $item['role'] }}</span>
                                @endif
                            </td>
                            <td class="text-center action-btns">
                                <form action="{{ route('admin.users.restore', $item['id'])}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn utility-btns btn-sm btn-outline-success"><i class="bi bi-recycle"></i> Pulihkan Data</button>
                                </form>
                                <form action="{{ route('admin.users.delete_permanent', $item['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger utility-btns"><i class="bi bi-trash"></i> Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
