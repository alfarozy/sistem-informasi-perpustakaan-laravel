<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportBuku implements WithMapping, WithHeadings, ShouldAutoSize, FromView
{
    private $books;

    public function view(): View
    {
        return view('backoffice.buku.export', ['books' => $this->books]);
    }
    public function __construct($books)
    {
        $this->books = $books;
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode Buku',
            'Judul buku',
            'pengarang',
            'penerbit',
            'tahun_terbit',
            'kota_terbit',
            'rak_buku',
            'jumlah'
        ];
    }

    public function map($row): array
    {
        return [
            $row->kode_buku,
            $row->nama_buku,
            $row->pengarang,
            $row->penerbit,
            $row->tahun_terbit,
            $row->kota_terbit,
            $row->rak_buku,
            $row->jumlah,
        ];
    }
}
