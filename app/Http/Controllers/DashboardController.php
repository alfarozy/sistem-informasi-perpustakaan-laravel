<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth()->user()->level == 'pustakawan') {

            $data = [
                'total_buku' => Book::count(),
                'total_anggota' => User::where('level', 'anggota')->count(),
                'total_buku_dipinjam' => BookUser::count(),
                'total_buku_sedang_dipinjam' => BookUser::whereNull('tanggal_pengembalian')->count(),
            ];
        } else {
            $data = [
                'total_buku_dipinjam' => BookUser::where('user_id', Auth()->id())->count(),
                'total_buku_belum_dikembalikan' => BookUser::where('user_id', Auth()->id())->whereNull('tanggal_pengembalian')->count(),
            ];
        }

        return view('backoffice.index')->with($data);
    }
    public function home()
    {
        return view('welcome')->with(['buku_terbaru' => Book::latest()->limit(10)->get()]);
    }

    public function profile()
    {
        return view('backoffice.profile.index');
    }
    public function editProfile()
    {
        return view('backoffice.profile.edit');
    }
    public function updateProfile(Request $request)
    {
        $attr = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth()->id())],
            'nis_nip' => ['required', Rule::unique('users', 'nis_nip')->ignore(Auth()->id())],
            'name' => 'required',
            'img' => 'image|mimes:png,jpg,jpeg'
        ]);

        if (isset($request->password) && $request->password) {

            $attr['password'] = bcrypt($request->password);
        }
        $file = $request->file('img');
        if (isset($file)) {

            if (Auth()->user()->img != 'users/default.svg') {
                Storage::delete(Auth()->user()->img);
            }

            $img = $file->store('users');
            $attr['img'] = $img;
        }
        User::where('id', Auth()->id())->update($attr);
        return redirect()->route('profile.index')->with('msg', 'Profil berhasil diperbaharui');
    }
}
