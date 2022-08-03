<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportBuku implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row)
    {

        return new Book([
            'nama_buku'  => $row['nama_buku'],
            'kode_buku' => strtoupper($row['kode_buku']),
            'pengarang'  => $row['pengarang'],
            'penerbit'  => $row['penerbit'],
            'tahun_terbit'  => $row['tahun_terbit'],
            'kota_terbit'  => $row['kota_terbit'],
            'rak_buku'  => $row['rak_buku'],
            'jumlah'  => $row['jumlah'],
            'ebook' => null

        ]);
    }

    public function rules(): array
    {
        return [
            'kode_buku' => ['unique:books']
        ];
    }
}
