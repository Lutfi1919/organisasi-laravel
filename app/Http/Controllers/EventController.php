<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\EventExport;
use Maatwebsite\Excel\Facades\Excel;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'day_date' => 'required|date',
            'photo_event' => 'required|mimes:jpg,jpeg,png,svg,webp,pdf',
        ] , [
            'name.required' => 'Nama Event Harus Diisi',
            'day_date.required' => 'Tanggal tidak boleh kosong',
            'photo_event.required' => 'Poster Event Harus Diisi',
            'photo_event.mimes' => 'Poster File Harus Berupa JPG/JPEG/PNG/SVG/WEBP/PDF',
        ]);

        $gambar = $request->file('photo_event');
        $namaGambar = Str::random(5) . "-event." . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs("events", $namaGambar, "public");

        $createData = Event::create([
            'name' => $request->name,
            'date' => $request->day_date,
            'photo_event' => $path,
        ]);

        if ($createData) {
            return redirect()->route('admin.events.index')->with('success', 'Berhasil Membuat Event!');
        } else {
            return redirect()->back()->with('error', 'Gagal Membuat Event! Silahkan Coba Lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $events = Event::findOrFail($id);
        return view('admin.events.edit', compact('events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'day_date' => 'required|date',
            'photo_event' => 'mimes:jpg,jpeg,png,svg,webp,pdf',
        ] , [
            'name.required' => 'Nama Event Harus Diisi',
            'day_date.required' => 'Tanggal tidak boleh kosong',
            'photo_event.mimes' => 'Poster File Harus Berupa JPG/JPEG/PNG/SVG/WEBP/PDF',
        ]);

        $event = Event::findOrFail($id);
        if ($request->file('photo_event')) {
            $fileSebelumnya = storage_path("app/public/" . $event['photo_event']);

            if (file_exists($fileSebelumnya)) {
                unlink($fileSebelumnya);
            }

            $gambar = $request->file('photo_event');
            $namaGambar = Str::random(5) . "-event." . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs("events", $namaGambar, "public");
        }

        $updateData = $event->update([
            'name' => $request['name'],
            'photo_event' => $path ?? $event['photo_event'],
            'date' => $request['day_date'],
        ]);

        if ($updateData) {
            return redirect()->route('admin.events.index')->with('success', 'Berhasil Ubah Data Event!');
        } else {
            return redirect()->back()->with('error', 'Gagal Mengubah Event! Silahkan Coba Lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteData = Event::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->route('admin.events.index')->with('success', 'Berhasil Menghapus Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan Coba Lagi');
        }
    }

    public function trash()
    {
        $events = Event::onlyTrashed()->get();
        return view('admin.events.trash', compact('events'));
    }

    public function restore($id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->restore();
        return redirect()->route('admin.events.index')->with('success', 'Berhasil mengembalikan data!');
    }

    public function deletePermanent($id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        $photo_path = storage_path("app/public/" . $event['photo_event']);

        if (!empty($event['photo_event']) && file_exists($photo_path) && !is_dir($photo_path)) {
            unlink($photo_path);
        }
        $event->forceDelete();

        return redirect()->route('admin.events.index')->with('success', 'Berhasil menghapus data selamanya!');
    }

    public function export()
    {
        return Excel::download(new EventExport, 'event.xlsx');
    }
}
