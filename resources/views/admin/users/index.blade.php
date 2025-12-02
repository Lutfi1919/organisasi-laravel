@extends('templates.appTwo')

@section('navbar')
<link rel="stylesheet" href="{{ asset(path: 'css/users.css')}}">

    <div class="container mb-5" style="margin-top: 100px; font-family: Unbounded;">
        @if (Session::get('failed'))
            <div class="alert alert-danger mt-4">{{ Session::get('failed') }}</div>
        @endif
        <div class="d-flex justify-content-end gap-1">
            <a href="{{ route('admin.users.trash')}}" class="btn utility-btns btn-secondary"><i class="bi bi-trash"></i> Data Sampah</a>
            <a href="{{ route('admin.users.export')}}" class="btn utility-btns btn-primary"><i class="bi bi-file-earmark-spreadsheet"></i> Export Data</a>
            <a href="{{ route('admin.users.create')}}" class="btn utility-btns btn-success"><i class="bi bi-plus-circle"></i> Tambah Data</a>
        </div>
        @if (Session::get('success'))
            <div class="alert alert-success mt-4">{{ Session::get('success') }}</div>
        @endif
        <h2>Data Pengguna (Admin & Staff)</h2>
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
                        <tr class="fw-light">
                            <td class="text-center">{{ $key+1 }}</td>
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
                                <a href="{{ route('admin.users.edit', $item['id']) }}" class="btn utility-btns btn-sm btn-outline-primary"><i class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form action="{{ route('admin.users.delete', $item['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn utility-btns btn-sm btn-outline-danger ms-1"><i class="bi bi-trash me-1"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
