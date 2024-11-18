<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validasi input termasuk captcha
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ]);

        // Jika validasi berhasil, lanjutkan dengan logika login default
        if (Auth::attempt($request->only('email', 'password'))) {
            // Cek apakah akun tidak aktif setelah login berhasil
            if (Auth::user()->status == 'Tidak Aktif') {
                Auth::logout();
                Session::flash('error', "Akun yang kamu gunakan sudah Tidak Aktif !");
                return redirect('login');
            }
            return redirect()->intended($this->redirectPath());
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Fungsi untuk memeriksa status pengguna setelah login.
     */
    protected function authenticated()
    {
        if (Auth::user()->status == 'Tidak Aktif') {
            Auth::logout();
            Session::flash('error', "Akun yang kamu gunakan sudah Tidak Aktif !");
            return redirect('login');
        }
    }
}
