<?php

namespace App\Exports;

use App\Models\Gallery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class GalleryExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $rowNumber = 0;

    public function collection()
    {
        return Gallery::all();
    }

    public function headings() :array
    {
        return [
            'No',
            'Nama Foto',
            'Tanggal',
            'Foto',
        ];
    }

    public function map($gallery) : array
    {
        return [
            ++$this->rowNumber,
            $gallery->name,
            Carbon::parse($gallery->date)->translatedFormat('j F Y'),
            asset('storage/' . $gallery->photo_gallery),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $sheet->getStyle('A1:'.$highestColumn.'1')->getFont()->setBold(true);
        $sheet->getStyle('A1:'.$highestColumn.'1')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('A1:'.$highestColumn.$highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        $sheet->getStyle('A1:'.$highestColumn.$highestRow)->getAlignment()->setWrapText(true);
    }
}
