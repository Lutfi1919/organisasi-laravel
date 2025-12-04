<?php

namespace App\Exports;

use App\Models\Gallery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class GalleryExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
}
