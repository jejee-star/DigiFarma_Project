<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login'); 
    }
    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();
        if (auth()->user()->role === 'admin') {
            return redirect()->route('produk.index'); 
        }
        return redirect()->route('store');
    }
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
    }

    public function registerView() 
    {
        return view('pages.auth.register');
    }
   
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'buyer',
            'role_id' => 1
        ]);

        if (Auth::attempt(['email'=>$request->email, 'password' => $request->password])) {
            return redirect()->route('store');
        }

        return redirect('/login')->with('success', 'Berhasil mendaftar!');
    }

     public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->with('error', 'Email belum terdaftar. Silahkan registrasi terlebih dahulu!');
        }
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(auth()->user()->role === 'admin') {
                return redirect()->route('produk.index');
            } else {
                return redirect()->route('store');
            }
        }
 
        return back()->withErrors([
            'email' => 'Terjadi kesalahan. Periksa kembali email atau password Anda.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
