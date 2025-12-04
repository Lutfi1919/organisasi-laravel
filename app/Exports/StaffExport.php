<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class StaffExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
}
