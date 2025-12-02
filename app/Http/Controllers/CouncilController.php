<?php

namespace App\Http\Controllers;

use App\Models\Council;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\CouncilExport;
use Maatwebsite\Excel\Facades\Excel;
class CouncilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $councils = Council::all();
        return view('admin.osis.index', compact('councils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.osis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'nis' => 'required|min:8',
            'photo_council' => 'required|mimes:jpg,jpeg,png,svg,webp,pdf',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama harus diisi minimal 3 karakter',
            'nis.required' => 'NIS harus diisi minimal 8 karakter',
            'nis.min' => 'NIS harus diisi minimal 8 karakter',
            'photo_council.required' => 'Foto Pengguna Harus Diisi',
            'photo_council.mimes' => 'Foto Pengguna Harus Berupa JPG/JPEG/PNG/SVG/WEBP/PDF',
        ]);

        $gambar = $request->file('photo_council');
        $namaGambar = Str::random(5) . '-council.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs("councils", $namaGambar, "public");

        $createData = Council::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'photo_council' => $path,
        ]);

        if ($createData) {
            return redirect()->route('admin.osis.index')->with('success', 'Berhasil Membuat Data!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Council $council)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $councils = Council::findOrFail($id);
        return view('admin.osis.edit', compact('councils'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'nis' => 'required|min:8',
            'photo_council' => 'mimes:jpg,jpeg,png,svg,webp,pdf',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama harus diisi minimal 3 karakter',
            'nis.required' => 'NIS harus diisi minimal 8 karakter',
            'nis.min' => 'NIS harus diisi minimal 8 karakter',
            'photo_council.mimes' => 'Foto Pengguna Harus Berupa JPG/JPEG/PNG/SVG/WEBP/PDF',
        ]);

        $council = Council::findOrFail($id);
        $path = $council->photo_council;

        if ($request->file('photo_council')) {
            if (!empty($council['photo_council'])) {
                $fileSebelumnya = storage_path("app/public/" . $council['photo_council']);

            if (file_exists($fileSebelumnya) && is_file($fileSebelumnya)) {
                unlink($fileSebelumnya);
            }
    }

            $gambar = $request->file('photo_council');
            $namaGambar = Str::random(5) . "-council." . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs("councils", $namaGambar, "public");
        }

        $updateData = $council->update([
            'name' => $request->name,
            'nis' => $request->nis,
            'photo_council' => $path,
        ]);

        if ($updateData) {
            return redirect()->route('admin.osis.index')->with('success', 'Berhasil Ubah Data OSIS!');
        } else {
            return redirect()->back()->with('error', 'Gagal Mengubah OSIS! Silahkan Coba Lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteData = Council::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->route('admin.osis.index')->with('success', 'Berhasil Menghapus Data');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan Coba Lagi');
        }
    }

    public function trash()
    {
        $councils = Council::onlyTrashed()->get();
        return view('admin.osis.trash', compact('councils'));
    }

    public function restore($id)
    {
        $councils = Council::onlyTrashed()->findOrFail($id);
        $councils->restore();
        return redirect()->route('admin.osis.index')->with('success', 'Berhasil mengembalikan data!');
    }

    public function deletePermanent($id)
    {
        $councils = Council::onlyTrashed()->findOrFail($id);
        $councils->forceDelete();
        return redirect()->route('admin.osis.index')->with('success', 'Berhasil menghapus data untuk selamanya!');
    }

    public function export()
    {
        return Excel::download(new CouncilExport, 'osis.xlsx');
    }
}
