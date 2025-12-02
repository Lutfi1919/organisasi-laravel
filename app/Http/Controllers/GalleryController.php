<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\GalleryExport;
use Maatwebsite\Excel\Facades\Excel;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function gallery()
    {
        $galleries = Gallery::latest()->get();
        return view('gallery', compact('galleries'));
    }

    public function index()
    {
        $galleries = Gallery::all();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo_gallery' => 'required|mimes:jpg,jpeg,png,svg,webp,pdf',
            'day_date' => 'required|date',
        ], [
            'name.required' => 'Nama Harus Diisi',
            'photo_gallery.required' => 'Foto Harus Diisi',
            'photo_gallery.mimes' => 'File Harus Berupa JPG/JPEG/PNG/SVG/WEBP/PDF',
            'day_date.required' => 'Tanggal Tidak Boleh Kosong',
        ]);

        $gambar = $request->file('photo_gallery');
        $namaGambar = Str::random(5) . "-gallery." . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs("galleries", $namaGambar, "public");

        $createData = Gallery::create([
            'name' => $request->name,
            'photo_gallery' => $path,
            'date' => $request->day_date,
        ]);

        if ($createData) {
            return redirect()->route('admin.gallery.index')->with('success', 'Berhasil Membuat Foto Untuk Gallery!');
        } else {
            return redirect()->back()->with('error', 'Gagal Membuat Foto! Silahkan Coba Lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $galleries = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('galleries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'photo_gallery' => 'mimes:jpg,jpeg,png,svg,webp,pdf',
            'day_date' => 'required|date',
        ], [
            'name.required' => 'Nama Harus Diisi',
            'photo_gallery.mimes' => 'File Harus Berupa JPG/JPEG/PNG/SVG/WEBP/PDF',
            'day_date.required' => 'Tanggal Tidak Boleh Kosong',
        ]);

        $gallery = Gallery::findOrFail($id);
        if ($request->file('photo_gallery')) {
            $fileSebelumnya = storage_path("app/public/" . $gallery['photo_gallery']);

            if (file_exists($fileSebelumnya)) {
                unlink($fileSebelumnya);
            }

            $gambar = $request->file('photo_gallery');
            $namaGambar = Str::random(5) . "-gallery." . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs("galleries", $namaGambar, "public");
        }

        $updateData = $gallery->update([
            'name' => $request['name'],
            'photo_gallery' => $path ?? $gallery['photo_gallery'],
            'date' => $request['day_date'],
        ]);

        if ($updateData) {
            return redirect()->route('admin.gallery.index')->with('success', 'Berhasil Ubah Data Gallery!');
        } else {
            return redirect()->back()->with('error', 'Gagal Mengubah Gallery! Silahkan Coba Lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteData = Gallery::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->route('admin.gallery.index')->with('success', 'Berhasil Menghapus Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan Coba Lagi');
        }
    }

     public function trash()
    {
        $galleries = Gallery::onlyTrashed()->get();
        return view('admin.gallery.trash', compact('galleries'));
    }

    public function restore($id)
    {
        $gallery = Gallery::onlyTrashed()->findOrFail($id);
        $gallery->restore();
        return redirect()->route('admin.gallery.index')->with('success', 'Berhasil mengembalikan data!');
    }

    public function deletePermanent($id)
    {
        $gallery = Gallery::onlyTrashed()->findOrFail($id);
        $photo_path = storage_path("app/public/" . $gallery['photo_gallery']);

        if (!empty($event['photo_gallery']) && file_exists($photo_path) && !is_dir($photo_path)) {
            unlink($photo_path);
        }
        $gallery->forceDelete();

        return redirect()->route('admin.gallery.index')->with('success', 'Berhasil menghapus data selamanya!');
    }

    public function export()
    {
        return Excel::download(new GalleryExport, 'gallery.xlsx');
    }
}
