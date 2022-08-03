<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookUserController extends Controller
{

    public function index()
    {
        $peminjaman = BookUser::latest()->get();
        return view('backoffice.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $users = User::where('level', 'anggota')->get();
        $books = Book::get();
        $no_pinjam = 'PJM0' . (BookUser::count() + 1);
        return view('backoffice.peminjaman.create', compact('users', 'books', 'no_pinjam'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'no_pinjam' => 'required|unique:book_users',
            'buku_id' => 'required',
            'user_id' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ], [
            '*.required' => 'Bidang ini wajib',
            'no_pinjam.unique' => 'Nomor Pinjam sudah tersedia'
        ]);
        $book = Book::find($request->buku_id);
        $book->update(['jumlah' => $book->jumlah - 1]);
        BookUser::create($attr);
        return redirect()->route('peminjaman.index')->with('msg', 'Data peminjam berhasil disimpan');
    }

    public function edit($id)
    {
        $data = BookUser::find($id);
        $users = User::where('level', 'anggota')->get();
        $books = Book::get();
        return view('backoffice.peminjaman.edit', compact('data', 'users', 'books'));
    }

    public function update(Request $request, $id)
    {
        $attr = $request->validate([
            'no_pinjam' => 'required',
            'buku_id' => 'required',
            'user_id' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ], [
            '*.required' => 'Bidang ini wajib',
        ]);
        BookUser::where('id', $id)->update($attr);
        return redirect()->route('peminjaman.index')->with('msg', 'Data peminjam berhasil disimpan');
    }
    public function destroy($id)
    {
        BookUser::destroy($id);
        return redirect()->route('peminjaman.index')->with('msg', 'Data peminjaman berhasil hapus');
    }
}
