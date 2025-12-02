<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;
class EventExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $rowNumber = 0;

    public function collection()
    {
        return Event::all();
    }

    public function headings() :array
    {
        return [
            'No',
            'Nama Event',
            'Tanggal Mulai',
            'Poster',
        ];
    }

    public function map($event) : array
    {
        return [
            ++$this->rowNumber,
            $event->name,
            Carbon::parse($event->date)->translatedFormat('j F Y'),
            asset('storage/' . $event->photo_event),
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
