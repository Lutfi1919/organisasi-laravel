<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\StaffExport;
use Maatwebsite\Excel\Facades\Excel;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'nis' => 'required|min:8',
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama harus diisi minimal 3 karakter',
            'nis.required' => 'NIS harus diisi minimal 8 karakter',
            'nis.min' => 'NIS harus diisi minimal 8 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus diisi dengan data valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus diisi minimal 8 karakter',
        ]);


        $createData = User::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff'
        ]);

        if ($createData) {
            return redirect()->route('admin.users.index')->with('success', 'Berhasil Membuat Data!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama harus diisi minimal 3 karakter',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus diisi minimal 8 karakter',
        ]);

        $updateData = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($updateData) {
            return redirect()->route('admin.users.index')->with('success', 'Berhasil Mengubah Data');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan Coba Lagi');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {
        $deleteData = User::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->route('admin.users.index')->with('success', 'Berhasil Menghapus Data');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan Coba Lagi');
        }
    }

    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.users.trash', compact('users'));
    }

    public function restore($id)
    {
        $users = User::onlyTrashed()->findOrFail($id);
        $users->restore();
        return redirect()->route('admin.users.index')->with('success', 'Berhasil mengembalikan data!');
    }

    public function deletePermanent($id)
    {
        $users = User::onlyTrashed()->findOrFail($id);
        $users->forceDelete();
        return redirect()->route('admin.users.index')->with('success', 'Berhasil menghapus data untuk selamanya!');
    }

    public function export()
    {
        return Excel::download(new StaffExport, 'staff.xlsx');
    }
}
