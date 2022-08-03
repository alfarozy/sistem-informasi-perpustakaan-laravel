<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3'
        ], [
            'email.required' => 'Email wajib',
            'password.required' => 'Password wajib',
            'password.min' => 'Password minimal 3 karakter',
        ]);

        // query user berdasarkan email
        $user = User::where('email', $request->email)->first();

        //cek jika ada user
        if ($user) {

            // cek password
            if (Hash::check($request->password, $user->password)) {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('dashboard');
                }
            } else {
                return redirect()->back()->with('msg', 'Password anda salah');
            }
        } else {
            return redirect()->back()->with('msg', 'Email belum terdaftar');
        }
    }

    public function registerForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required',
            'nis_nip' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3'
        ], [
            'name.required' => 'Nama lengkap wajib',
            'nis.required' => 'Nis wajib',
            'nis.unique' => 'Nis sudah terdaftar',
            'email.required' => 'Email wajib',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib',
            'password.min' => 'Password minimal 3 karakter',
        ]);
        $attr['password'] = bcrypt($attr['password']);
        $attr['level'] = 'anggota';
        User::create($attr);
        return redirect()->route('login')->with('success', 'Akun anda berhasil terdaftar, silahkan login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }
}
