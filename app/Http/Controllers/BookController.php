<?php

namespace App\Http\Controllers;

use App\Exports\ExportBuku;
use App\Imports\ImportBuku;
use App\Models\Book;
use App\Models\BookUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function index()
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }
        $books = Book::latest()->get();
        return view('backoffice.buku.index', compact('books'));
    }

    public function create()
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }
        $kode_buku = 'BK0' . (Book::count() + 1);
        return view('backoffice.buku.create', compact('kode_buku'));
    }
    public function store(Request $request)
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }
        $attr = $request->validate([
            'kode_buku' => 'required|unique:books',
            'nama_buku' => 'required',
            'pengarang' => 'required',
            'penerbit'  => 'required',
            'tahun_terbit'  => 'required',
            'kota_terbit'  => 'required',
            'rak_buku'  => 'required',
            'jumlah'  => 'required',
            'ebook' => 'mimes:pdf'
        ], [
            '*.required'    => 'Bidang ini wajib diisi',
            'kode_buku.unique' => 'Kode Buku Sudah tersedia'

        ]);
        $file = $request->file('ebook');
        if (isset($file)) {
            $ebook = $file->store('ebook');
        } else {
            $ebook = null;
        }
        $attr['ebook'] = $ebook;
        // upload file pdf
        Book::create($attr);
        return redirect()->route('buku.index')->with('msg', 'Data buku berhasil simpan');
    }

    public function edit($id)
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }
        $buku = Book::findOrFail($id);
        return view('backoffice.buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }
        $book = Book::find($id);
        $attr = $request->validate([
            'kode_buku' => 'required',
            'nama_buku' => 'required',
            'pengarang' => 'required',
            'penerbit'  => 'required',
            'tahun_terbit'  => 'required',
            'kota_terbit'  => 'required',
            'rak_buku'  => 'required',
            'jumlah'  => 'required',
        ], [
            'kode_buku.required'    => 'Bidang ini wajib diisi',
            'nama_buku.required'    => 'Bidang ini wajib diisi',
            'pengarang.required'    => 'Bidang ini wajib diisi',
            'penerbit.required'    => 'Bidang ini wajib diisi',
            'tahun_terbit.required'    => 'Bidang ini wajib diisi',
            'kota_terbit.required'    => 'Bidang ini wajib diisi',
            'rak_buku.required'    => 'Bidang ini wajib diisi',
            'jumlah.required'    => 'Bidang ini wajib diisi',
        ]);
        $file = $request->file('ebook');
        if (isset($file)) {
            Storage::delete($book->ebook);

            $ebook = $file->store('ebook');
            $attr['ebook'] = $ebook;
        }
        Book::where('id', $id)->update($attr);
        return redirect()->route('buku.index')->with('msg', 'Data buku berhasil perbaharui');
    }
    public function destroy($id)
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }
        $book = Book::find($id);
        if ($book->ebook) {
            Storage::delete($book->ebook);
        }
        Book::destroy($id);
        return redirect()->route('buku.index')->with('msg', 'Data buku berhasil hapus');
    }
    public function show($id)
    {
        $buku = Book::find($id);
        return view('backoffice.buku.show', compact('buku'));
    }
    public function import(Request $request)
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }

        $file = $request->file('file');
        $import = Excel::import(new ImportBuku, $file);
        return redirect()->back()->with('msg', 'Data buku berhasil diimport');
    }

    public function download()
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }
        $file = public_path() . "/import/contoh-data-buku.xlsx";
        return Response()->download($file, 'contoh-data-buku.xlsx', [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="contoh-data-buku.xlsx"'
        ]);
    }
    public function export()
    {
        if (Auth()->user()->level != 'pustakawan') {
            return abort(404);
        }
        $books = Book::get();
        return Excel::download(new ExportBuku($books), 'buku-' . date('YmdHis') . '.xlsx');
    }

    // user
    public function cariBuku()
    {
        if (Auth()->user()->level != 'anggota') {
            return abort(404);
        }

        $books = Book::latest()->get();
        return view('backoffice.buku.search', compact('books'));
    }
    public function pinjam(Request $request)
    {
        if (Auth()->user()->level != 'anggota') {
            return abort(404);
        }

        $nextWeek =  Carbon::today()->addDay(7)->format('Y-m-d');
        $data = [
            'no_pinjam' => 'PJM0' . (BookUser::count() + 1),
            'buku_id' => $request->book_id,
            'user_id' => Auth()->id(),
            'tanggal_pinjam' => Carbon::today()->format('Y-m-d'),
            'tanggal_kembali' => $nextWeek,
        ];
        $book = Book::find($request->book_id);
        $book->update(['jumlah' => $book->jumlah - 1]);
        BookUser::create($data);
        return redirect()->route('buku.riwayat')->with('msg', 'Buku berhasil dipinjam');
    }

    public function downloadEbook($id)
    {
        $buku = Book::find($id);
        return Storage::download($buku->ebook);
    }
}
