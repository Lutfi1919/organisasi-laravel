<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Report;
use App\Models\Council;
use App\Models\Suspect;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with(['council', 'suspect', 'category'])->get();
        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // ambil semua perbuatan
        return view('staff.laporGDS', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'nis' => 'required|min:8',
            'name_reporter' => 'required|min:3',
            'nis_reporter' => 'required|min:8',
            'action'  => 'required|exists:categories,id',
            'day_date' => 'required|date',
            'photo_report' => 'required|mimes:jpg,jpeg,png,svg,webp,pdf',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama harus diisi minimal 3 karakter',
            'nis.required' => 'NIS harus diisi minimal 8 karakter',
            'nis.min' => 'NIS harus diisi minimal 8 karakter',
            'name_reporter.required' => 'Nama Pelapor tidak boleh kosong',
            'name_reporter.min' => 'Nama Pelapor harus diisi minimal 3 karakter',
            'nis_reporter.required' => 'NIS Pelapor harus diisi minimal 8 karakter',
            'nis_reporter.min' => 'NIS Pelapor diisi minimal 8 karakter',
            'action.required' => 'Perbuatan harus diisi!',
            'day_date.required' => 'Tanggal tidak boleh kosong',
            'photo_report.required' => 'Foto Laporan Harus Diisi',
            'photo_report.mimes' => 'Foto Laporan Harus Berupa JPG/JPEG/PNG/SVG/WEBP/PDF',
        ]);

        $council = Council::firstOrCreate(
['nis' => $validated['nis_reporter']],
    ['name' => $validated['name_reporter']]
        );

        $gambar = $request->file('photo_report');
        $namaGambar = Str::random(5) . '-report.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs("reports", $namaGambar, "public");

        $suspect = Suspect::firstOrCreate(
['nis' => $validated['nis']],
    ['name' => $validated['name']]
        );

        $createReport = Report::create([
            'council_id' => $council->id,
            'suspect_id' => $suspect->id,
            'category_id' => $validated['action'],
            'photo_report' => $path,
            'date' => $validated['day_date'],
        ]);

        if ($createReport) {
            return redirect()->route('staff.laporGDS')->with('ok', 'Berhasil Melapor!');
        } else {
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $report = Report::with('council')->findOrFail($id);
        $categories = Category::all();
        return view('admin.reports.edit', compact('report', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'nis' => 'required|min:8',
            'name_reporter' => 'required|min:3',
            'nis_reporter' => 'required|min:8',
            'action'  => 'required|exists:categories,id',
            'day_date' => 'required|date',
            'photo_report' => 'mimes:jpg,jpeg,png,svg,webp,pdf',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama harus diisi minimal 3 karakter',
            'nis.required' => 'NIS harus diisi minimal 8 karakter',
            'nis.min' => 'NIS harus diisi minimal 8 karakter',
            'name_reporter.required' => 'Nama Pelapor tidak boleh kosong',
            'name_reporter.min' => 'Nama Pelapor harus diisi minimal 3 karakter',
            'nis_reporter.required' => 'NIS Pelapor harus diisi minimal 8 karakter',
            'nis_reporter.min' => 'NIS Pelapor diisi minimal 8 karakter',
            'action.required' => 'Perbuatan harus diisi!',
            'day_date.required' => 'Tanggal tidak boleh kosong',
            'photo_report.mimes' => 'Foto Laporan Harus Berupa JPG/JPEG/PNG/SVG/WEBP/PDF',
        ]);

        $report = Report::findOrFail($id);
        if ($request->file('photo_report')) {
            $fileSebelumnya = storage_path("app/public/" . $report['photo_report']);

            if (file_exists($fileSebelumnya)) {
                unlink($fileSebelumnya);
            }

            $gambar = $request->file('photo_report');
            $namaGambar = Str::random(5) . "-report." . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs("reports", $namaGambar, "public");
        }

        $council = Council::firstOrCreate(
    ['nis' => $request->nis_reporter],
        ['name' => $request->name_reporter]
        );

        $suspect = Suspect::firstOrCreate(
    ['nis' => $request->nis],
        ['name' => $request->name]
        );

        $updateData = $report->update([
            'council_id' => $council->id,
            'suspect_id' => $suspect->id,
            'category_id' => $request['action'],
            'photo_report' => $path ?? $report['photo_report'],
            'date' => $request['day_date'],
        ]);

        if ($updateData) {
            return redirect()->route('admin.reports.index')->with('success', 'Berhasil Ubah Data Laporan!');
        } else {
            return redirect()->back()->with('error', 'Gagal Membuat Film! Silahkan Coba Lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteData = Report::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->route('admin.reports.index')->with('success', 'Berhasil Menghapus Data!');
        } else {
            return redirect()->back()->with('failed', 'Gagal! Silahkan Coba Lagi');
        }
    }

    public function trash()
    {
        $reports = Report::onlyTrashed()->get();
        return view('admin.reports.trash', compact('reports'));
    }

    public function restore($id)
    {
        $report = Report::onlyTrashed()->findOrFail($id);
        $report->restore();
        return redirect()->route('admin.reports.index')->with('success', 'Berhasil mengembalikan data!');
    }

    public function deletePermanent($id)
    {
        $report = Report::onlyTrashed()->findOrFail($id);
        $photo_path = storage_path("app/public/" . $report['photo_report']);

        if (!empty($report['photo_report']) && file_exists($photo_path) && !is_dir($photo_path)) {
            unlink($photo_path);
        }
        $report->forceDelete();

        return redirect()->route('admin.reports.index')->with('success', 'Berhasil menghapus data selamanya!');
    }

    public function export()
    {
        return Excel::download(new ReportExport, 'report.xlsx');
    }

    public function exportPdf($id)
    {
        $report = Report::where('id', $id)->with(['council', 'suspect', 'category'])->first()->toArray();
        view()->share('report', ['report' => $report]);
        $pdf = Pdf::LoadView('admin.reports.pdf', $report);
        $fileName = 'REPORT' . $report['id'] . '.pdf';
        return $pdf->download($fileName);
    }
}
