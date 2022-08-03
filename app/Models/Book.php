<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['kode_buku', 'nama_buku', 'ebook', 'pengarang', 'penerbit', 'tahun_terbit', 'kota_terbit', 'rak_buku', 'jumlah'];
}
