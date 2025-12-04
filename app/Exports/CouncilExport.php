<?php

namespace App\Exports;

use App\Models\Council;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;
class CouncilExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
}
