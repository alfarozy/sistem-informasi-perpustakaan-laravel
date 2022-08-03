<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = BookUser::latest()->get();
        return view('backoffice.pengembalian.index',)->with(['fn' => $this, 'pengembalian' => $pengembalian]);
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

    public function create()
    {
        return redirect()->back();
    }

    public function edit($id)
    {
        $data = BookUser::find($id);
        $users = User::where('level', 'anggota')->get();
        $books = Book::get();
        return view('backoffice.pengembalian.edit', compact('data', 'users', 'books'));
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'tanggal_pengembalian' => 'required',
        ], [
            '*.required' => 'Bidang ini wajib',
        ]);
        $pinjam = BookUser::find($id);
        if (!$pinjam->tanggal_pengembalian) {

            $book = Book::find($pinjam->buku_id);
            $book->update(['jumlah' => $book->jumlah + 1]);
        }
        BookUser::where('id', $id)->update($attr);
        return redirect()->route('pengembalian.index')->with('msg', 'Data pengembalian berhasil disimpan');
    }

    public function riwayat()
    {
        $books = BookUser::where('user_id', Auth()->id())->orderBy('id', 'DESC')->get();

        return view('backoffice.peminjaman.riwayat', ['books' => $books, 'fn' => $this]);
    }
}
