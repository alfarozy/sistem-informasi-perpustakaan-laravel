<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPeminjaman implements WithMapping, WithHeadings, ShouldAutoSize, FromView
{
    private $peminjaman;

    public function view(): View
    {
        return view('backoffice.peminjaman.export', ['peminjaman' => $this->peminjaman]);
    }
    public function __construct($peminjaman)
    {
        $this->peminjaman = $peminjaman;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nomor Pinjam',
            'Judul',
            'Nama Peminjam',
            'Tanggal pinjam',
            'Tanggal kembali',
            'Lama hari'
        ];
    }

    public function map($row): array
    {
        return [
            $row->no_pinjam,
            $row->buku->nama_buku,
            $row->user->name,
            $row->tanggal_pinjam,
            $row->tanggal_kembali,

        ];
    }
}
