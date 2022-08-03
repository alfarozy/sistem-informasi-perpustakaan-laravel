<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    use HasFactory;

    protected $fillable = ['no_pinjam', 'buku_id', 'user_id', 'tanggal_pinjam', 'tanggal_pengembalian', 'tanggal_kembali'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'buku_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
