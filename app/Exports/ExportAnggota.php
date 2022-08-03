<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAnggota implements WithMapping, WithHeadings, ShouldAutoSize, FromView
{
    private $users;

    public function view(): View
    {
        return view('backoffice.anggota.export', ['users' => $this->users]);
    }
    public function __construct($users)
    {
        $this->users = $users;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama Lengkap',
            'Email',
            'Nis/Nip'
        ];
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->email,
            $row->nis_nip,
        ];
    }
}
