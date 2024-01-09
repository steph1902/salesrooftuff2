<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request; // Import kelas Request yang benar
use Illuminate\Support\Facades\Crypt; // Import kelas Crypt yang benar
use Illuminate\Support\Facades\Auth; // Import kelas Auth yang benar



class LoginController extends Controller
{
    

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

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password'); // Mengambil email dan password dari permintaan

        // Mendapatkan pengguna dengan email yang cocok
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Mendekripsi password yang ada di database
            $decryptedPassword = Crypt::decrypt($user->password);

            if ($decryptedPassword == $credentials['password']) {
                // Password cocok, pengguna berhasil login
                Auth::login($user);
                return redirect('/home'); // Ganti '/home' sesuai dengan rute yang Anda inginkan
            }
        }

        // Password tidak cocok atau pengguna tidak ditemukan
        return redirect()->back()->withInput()->withErrors(['email' => 'Email atau kata sandi salah']);
    }




}
