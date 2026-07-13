<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('login');
    }









    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Input
        |--------------------------------------------------------------------------
        */
        $request->validate([

            'username' => 'required',

            'password' => 'required',

        ]);

        /*
        |--------------------------------------------------------------------------
        | Ambil Username & Password dari .env
        |--------------------------------------------------------------------------
        */
        $username = env('HOTEL_USERNAME');

        $password = env('HOTEL_PASSWORD');

        /*
        |--------------------------------------------------------------------------
        | Cek Username & Password
        |--------------------------------------------------------------------------
        */
        if (

            $request->username == $username

            &&

            $request->password == $password

        ) {

            /*
            |--------------------------------------------------------------------------
            | Simpan Session Login
            |--------------------------------------------------------------------------
            */

            Session::put(
                'login',
                true
            );

            Session::put(
                'username',
                $username
            );

            /*
            |--------------------------------------------------------------------------
            | Redirect ke Dashboard
            |--------------------------------------------------------------------------
            */

            return redirect('/');

        }

        /*
        |--------------------------------------------------------------------------
        | Login Gagal
        |--------------------------------------------------------------------------
        */

        return back()

            ->with(

                'error',

                'Username atau Password salah.'

            )

            ->withInput();
    }









    /**
     * Logout
     */
    public function logout()
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus Seluruh Session
        |--------------------------------------------------------------------------
        */

        Session::flush();

        /*
        |--------------------------------------------------------------------------
        | Kembali ke Login
        |--------------------------------------------------------------------------
        */

        return redirect('/login');
    }
}