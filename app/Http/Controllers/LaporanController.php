<?php

namespace App\Http\Controllers;

use App\Exports\ExportAnggota;
use App\Exports\ExportBuku;
use App\Exports\ExportPeminjaman;
use App\Exports\ExportPengembalian;
use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function buku(Request $request)
    {
        if (isset($request->start_date) && isset($request->end_date)) {
            $books = Book::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $books = Book::get();
        }
        return view('backoffice.laporan.book', compact('books'));
    }

    public function exportBuku(Request $request)
    {
        if ($request->start_date != '-' && $request->end_date != '-') {
            $books = Book::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $books = Book::get();
        }
        return Excel::download(new ExportBuku($books), 'buku-' . date('YmdHis') . '.xlsx');
    }

    public function anggota(Request $request)
    {
        if (isset($request->start_date) && isset($request->end_date)) {
            $users = User::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $users = User::get();
        }

        return view('backoffice.laporan.anggota', compact('users'));
    }

    public function exportAnggota(Request $request)
    {
        if ($request->level == 'all') {
            if ($request->start_date != '-' && $request->end_date != '-') {
                $users = User::whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
            } else {
                $users = User::get();
            }
        } else {
            if ($request->start_date != '-' && $request->end_date != '-') {
                $users = User::where('level', $request->level)->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
            } else {
                $users = User::where('level', $request->level)->get();
            }
        }
        return Excel::download(new ExportAnggota($users), 'laporan-anggota-' . date('YmdHis') . '.xlsx');
    }

    public function peminjaman(Request $request)
    {
        if (isset($request->start_date) && isset($request->end_date)) {
            $peminjaman = BookUser::whereBetween('tanggal_pinjam', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $peminjaman = BookUser::get();
        }

        return view('backoffice.laporan.peminjaman', compact('peminjaman'));
    }
    public function exportPeminjaman(Request $request)
    {
        if ($request->start_date != '-' && $request->end_date != '-') {
            $peminjaman = BookUser::whereBetween('tanggal_pinjam', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $peminjaman = BookUser::get();
        }
        return Excel::download(new ExportPeminjaman($peminjaman), 'peminjaman-' . date('YmdHis') . '.xlsx');
    }
    public function pengembalian(Request $request)
    {
        if (isset($request->start_date) && isset($request->end_date)) {
            $pengembalian = BookUser::whereBetween('tanggal_pinjam', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $pengembalian = BookUser::get();
        }

        return view('backoffice.laporan.pengembalian')->with(['fn' => $this, 'pengembalian' => $pengembalian]);
    }
    public function exportPengembalian(Request $request)
    {
        if ($request->start_date != '-' && $request->end_date != '-') {
            $pengembalian = BookUser::whereBetween('tanggal_pinjam', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
        } else {
            $pengembalian = BookUser::get();
        }
        return Excel::download(new ExportPengembalian($pengembalian,), 'pengembalian-' . date('YmdHis') . '.xlsx');
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
