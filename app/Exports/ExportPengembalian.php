<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportPengembalian implements WithMapping, WithHeadings, ShouldAutoSize, FromView
{
    private $pengembalian;


    public function __construct($pengembalian)
    {
        $this->pengembalian = $pengembalian;
    }
    public function view(): View
    {
        return view('backoffice.pengembalian.export', ['pengembalian' => $this->pengembalian, 'fn' => $this]);
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
            'Tanggal Pengembalian',
            'Lama hari peminjaman',
            'Denda'
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
            $row->tanggal_pengembalian,

        ];
    }

    public function denda($tanggal_pengembalian, $tanggal_kembali)
    {
        if (!$tanggal_kembali) {
            return 0;
        }
        $denda = 0;
        $start = strtotime($tanggal_pengembalian);
        $end = strtotime($tanggal_kembali);
        $days = ($end - $start) / 60 / 60 / 24;
        if ($days > 0) {
            $denda = $days * 2000;
        }
        return $denda;
    }
}
