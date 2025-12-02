<?php

namespace App\Exports;

use App\Models\Council;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;
class CouncilExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $rowNumber = 0;

    public function collection()
    {
        return Council::all();
    }

    public function headings() :array
    {
        return [
            'No',
            'Nama',
            'Nis',
            'Tanggal Bergabung',
            'Foto',
        ];
    }

    public function map($councils) : array
    {
        return [
            ++$this->rowNumber,
            $councils->name,
            $councils->nis,
            Carbon::parse($councils->created_at)->translatedFormat('j F Y'),
            asset('storage/' . $councils->photo_council),
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
