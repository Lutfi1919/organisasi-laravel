<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class StaffExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $rowNumber = 0;

    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Email',
            'Role',
            'Tanggal Bergabung',
        ];
    }

    public function map($user): array
    {
        return [
            ++$this->rowNumber,
            $user->name,
            $user->email,
            $user->role,
            Carbon::parse($user->created_at)->translatedFormat('j F Y')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

         // Header bold
        $sheet->getStyle('A1:'.$highestColumn.'1')->getFont()->setBold(true);
        $sheet->getStyle('A1:'.$highestColumn.'1')->getAlignment()->setHorizontal('center');

        // Border untuk semua cell terisi
        $sheet->getStyle('A1:'.$highestColumn.$highestRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);
    }
}
