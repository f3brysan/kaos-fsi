<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tr_biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        // dd(session()->all());
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function auth (Request $request){
        // dd($request->all());

        $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required']            
        ]);

        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],           
        ]);

        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            $biodataCheck = Tr_biodata::where('user_id', $user->id)->first();
            Session::put('bio', $biodataCheck);

            return redirect()->intended('/');
        }

        // dd(session()->all());
        
        
        return back()->with('LoginError','Email atau Password Anda salah !' );
    }

    public function store_register(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email:dns|unique:users',
                'password' => 'required|min:8',
                'captcha' => 'required|captcha'
            ]);

            $create = User::create([
                'email' => $request->email,
                'password' =>bcrypt($request->password),
            ]);
            $create->assignRole('customer');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return redirect('/login')->with('success', 'Registrasi Anda berhasil !');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/login');
    }

}
