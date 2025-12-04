<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class ReportExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $rowNumber = 0;
    public function collection()
    {
        return Report::all();
    }

    public function headings() : array
    {
        return [
            'No',
            'Nama Pelapor',
            'Nama Pelaku',
            'Perbuatan',
            'Foto Laporan',
            'Tanggal',
        ];
    }

    public function map($report) : array
    {
        return [
            ++$this->rowNumber,
            $report->council->name,
            $report->suspect->name,
            $report->category->name,
            asset('storage/' . $report->photo_report),
            Carbon::parse($report->date)->translatedFormat('j F Y')
        ];
    }
}
