<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;
class EventExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
}
