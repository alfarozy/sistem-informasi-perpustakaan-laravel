<?php

namespace App\Http\Controllers;

use App\Exports\ExportAnggota;
use App\Imports\ImportAnggota;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::latest()->get();
        return view('backoffice.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('backoffice.anggota.create');
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:3',
            'nis_nip' => 'required|unique:users',
            'level' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'nis_nip.required' => 'NIS/NIP wajib diisi',
            'nis_nip.unique' => 'NIS/NIP sudah terdaftar',
            'level.required' => 'level wajib diisi',
            'img'   => 'image|mimes:png,jpg,jpeg'

        ]);
        $file = $request->file('img');
        if (isset($file)) {
            $img = $file->store('users');
        } else {
            $img = 'users/default.svg';
        }
        $attr['img'] = $img;
        $attr['password'] = bcrypt($request->password);

        $user = User::create($attr);
        return redirect()->route('anggota.index')->with('msg', 'Data anggota berhasil disimpan');
    }

    public function edit($id)
    {
        $anggota = User::find($id);
        return view('backoffice.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $attr = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'nis_nip' => ['required', Rule::unique('users')->ignore($id)],
            'level' => 'required',
            'img'   => 'image|mimes:png,jpg,jpeg'
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'nis_nip.required' => 'NIS/NIP wajib diisi',
            'nis_nip.unique' => 'NIS/NIP sudah terdaftar',
            'level.required' => 'level wajib diisi',
        ]);

        if (isset($request->password) && $request->password) {

            $attr['password'] = bcrypt($request->password);
        }
        $file = $request->file('img');
        if (isset($file)) {

            if ($user->img != 'users/default.svg') {
                Storage::delete($user->img);
            }

            $img = $file->store('users');
            $attr['img'] = $img;
        }
        User::where('id', $id)->update($attr);
        return redirect()->route('anggota.index')->with('msg', 'Data anggota berhasil diperbaharui');
    }
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('msg', 'Data anggota berhasil dihapus');
    }

    public function export(Request $request)
    {
        if ($request->level === 'all') {
            $users = User::get();
        } else {
            $users = User::where('level', $request->level)->get();
        }
        return Excel::download(new ExportAnggota($users), 'anggota-' . date('YmdHis') . '.xlsx');
    }

    public function import(Request $request)
    {

        $file = $request->file('file');

        $import = new ImportAnggota;
        $import->import($file);

        return redirect()->back()->with('msg', 'Data anggota berhasil diimport');
    }

    public function download()
    {
        $file = public_path() . "/import/contoh-data-anggota.xlsx";
        return Response()->download($file, 'contoh-data-anggota.xlsx', [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="contoh-data-anggota.xlsx"'
        ]);
    }
}
