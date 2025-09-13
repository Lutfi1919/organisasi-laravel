<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'nis' => 'required|min:8',
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama harus diisi minimal 3 karakter',
            'nis.required' => 'NIS harus diisi minimal 8 karakter',
            'nis.min' => 'NIS harus diisi minimal 8 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus diisi dengan data valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus diisi minimal 8 karakter',
        ]);

        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Hash : enkripsi data agar yg tersimpan di db karakter acak, untuk menghindari kebocoran data password
            'password' => Hash::make($request->password),
            // role diisi langsung dengan user, agar tdk mengakses admin/staff
            'role' => 'user',
            'nis' => $request->nis,
        ]);

         if ($createUser) {
            // redirect() : memindahkan halaman, route() : memanggil name route, with () : mengirimkan session data, biasanya untuk notifikasi
            return redirect()->route('login')->with('ok', 'Berhasil membuat akun! silahkan login');
        } else {
            // back() : kembali ke halaman sebelumnya
            return redirect()->back()->with('error', 'Gagal! silahkan coba lagi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Harus Diisi',
            'password.required' => 'Password Harus Diisi'
        ]);
        $data = $request->only(keys: ['email', 'password']);

        if(Auth::attempt($data)) {
            if (Auth::user()->role == 'staff') {
                return redirect()->route('staff.home') -> with('success', 'Login Berhasil Dilakukan!');
            } else {
                return redirect()->route('home')->with('success', 'Login Berhasil Dilakukan');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal Login! Coba Lagi');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('logout', 'Berhasil Logout! Silahkan Login Kembali Untuk Akses Lengkap');
    }
}
