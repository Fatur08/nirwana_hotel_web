<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        // Jika sudah login, langsung ke dashboard
        if (Session::get('login')) {
            return redirect('/');
        }

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
        | Cari User Berdasarkan Username
        |--------------------------------------------------------------------------
        */
        $user = DB::table('users')

            ->where(
                'username',
                $request->username
            )

            ->first();

        /*
        |--------------------------------------------------------------------------
        | Username Tidak Ditemukan
        |--------------------------------------------------------------------------
        */
        if (!$user) {

            /*
            |--------------------------------------------------------------------------
            | Laravel Log
            |--------------------------------------------------------------------------
            */

            Log::warning(

                "\n"

                . "====================================================\n"

                . "                LOGIN HOTEL\n"

                . "====================================================\n"

                . "Tanggal      : " . now()->format('d-m-Y H:i:s') . "\n"

                . "Username     : {$request->username}\n"

                . "IP Address   : {$request->ip()}\n"

                . "Status       : GAGAL (Username tidak ditemukan)\n"

                . "===================================================="

            );

            return back()

                ->with(
                    'error',
                    'Username atau Password salah.'
                )

                ->withInput();

        }

        /*
        |--------------------------------------------------------------------------
        | Cek Password (bcrypt)
        |--------------------------------------------------------------------------
        */
        if (
            !Hash::check(

                $request->password,

                $user->password

            )
        ) {

            /*
            |--------------------------------------------------------------------------
            | Laravel Log
            |--------------------------------------------------------------------------
            */

            Log::warning(

                "\n"

                . "====================================================\n"

                . "                LOGIN HOTEL\n"

                . "====================================================\n"

                . "Tanggal      : " . now()->format('d-m-Y H:i:s') . "\n"

                . "Username     : {$request->username}\n"

                . "IP Address   : {$request->ip()}\n"

                . "Status       : GAGAL (Password salah)\n"

                . "===================================================="

            );

            return back()

                ->with(
                    'error',
                    'Username atau Password salah.'
                )

                ->withInput();

        }

        /*
        |--------------------------------------------------------------------------
        | Login Berhasil
        |--------------------------------------------------------------------------
        */
        Session::put(
            'login',
            true
        );

        Session::put(
            'id_users',
            $user->id_users
        );

        Session::put(
            'username',
            $user->username
        );



        /*
|--------------------------------------------------------------------------
| Laravel Log
|--------------------------------------------------------------------------
*/

        Log::info(

            "\n"

            . "====================================================\n"

            . "                LOGIN HOTEL\n"

            . "====================================================\n"

            . "Tanggal      : " . now()->format('d-m-Y H:i:s') . "\n"

            . "ID User      : {$user->id_users}\n"

            . "Username     : {$user->username}\n"

            . "IP Address   : {$request->ip()}\n"

            . "Status       : BERHASIL\n"

            . "===================================================="

        );

        /*
        |--------------------------------------------------------------------------
        | Redirect ke Dashboard
        |--------------------------------------------------------------------------
        */
        return redirect('/');
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