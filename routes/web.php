<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengembalianController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
    Route::get('/register', [LoginController::class, 'registerForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register');
});



// dashboard
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // anggota
    Route::resource('anggota', AnggotaController::class);
    Route::post('export/anggota', [AnggotaController::class, 'export'])->name('anggota.export');
    Route::post('import/anggota', [AnggotaController::class, 'import'])->name('anggota.import');
    Route::get('import/download/data-anggota', [AnggotaController::class, 'download'])->name('anggota.download');
    // buku
    Route::resource('buku', BookController::class);
    Route::get('export/buku', [BookController::class, 'export'])->name('buku.export');
    Route::post('import/buku', [BookController::class, 'import'])->name('buku.import');
    Route::get('import/download/data-buku', [BookController::class, 'download'])->name('buku.download');
    Route::get('buku/ebook/{ebook}', [BookController::class, 'downloadEbook'])->name('download.ebook');
    Route::get('book/{id}', [BookController::class, 'show'])->name('buku.show');
    // peminjaman 
    Route::get('peminjaman', [BookUserController::class, 'index'])->name('peminjaman.index');
    Route::get('peminjaman/create', [BookUserController::class, 'create'])->name('peminjaman.create');
    Route::post('peminjaman/create', [BookUserController::class, 'store'])->name('peminjaman.store');
    Route::get('peminjaman/edit/{id}', [BookUserController::class, 'edit'])->name('peminjaman.edit');
    Route::post('peminjaman/update/{id}', [BookUserController::class, 'update'])->name('peminjaman.update');
    Route::delete('peminjaman/destroy/{id}', [BookUserController::class, 'destroy'])->name('peminjaman.destroy');

    // Pengembalian 
    Route::resource('pengembalian', PengembalianController::class);


    // user
    Route::get('cari-buku', [BookController::class, 'cariBuku'])->name('buku.cari');
    Route::get('pinjam-buku/{book_id}', [BookController::class, 'pinjam'])->name('buku.pinjam');
    Route::get('riwayat-pengembalian', [PengembalianController::class, 'riwayat'])->name('buku.riwayat');


    // laporan
    Route::get('laporan/data-buku', [LaporanController::class, 'buku'])->name('laporan.buku');
    Route::get('laporan/data-buku/export', [LaporanController::class, 'exportBuku'])->name('laporan.exportBuku');

    Route::get('laporan/data-anggota', [LaporanController::class, 'anggota'])->name('laporan.anggota');
    Route::get('laporan/data-anggota/export', [LaporanController::class, 'exportAnggota'])->name('laporan.exportAnggota');

    Route::get('laporan/data-peminjaman', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
    Route::get('laporan/data-peminjaman/export', [LaporanController::class, 'exportPeminjaman'])->name('laporan.exportPeminjaman');

    Route::get('laporan/data-pengembalian', [LaporanController::class, 'pengembalian'])->name('laporan.pengembalian');
    Route::get('laporan/data-pengembalian/export', [LaporanController::class, 'exportPengembalian'])->name('laporan.exportPengembalian');

    Route::get('profile', [DashboardController::class, 'profile'])->name('profile.index');
    Route::get('profile/edit', [DashboardController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
});

Route::get('/', [DashboardController::class, 'home'])->name('home');
