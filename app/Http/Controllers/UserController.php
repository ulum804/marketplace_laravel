<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LoginModel;

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
            'nama_user' => 'required',
            'email' => 'required|email|unique:user_tabel,email',
            'password' => 'required|min:5'
        ]);

        LoginModel::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Registrasi berhasil!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = LoginModel::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user (assuming UserModel implements Authenticatable or use Auth::loginUsingId)
            // For simplicity, since UserModel is custom, we'll use session

            session([
                'user_id'   => $user->id,
                'nama_user' => $user->nama_user,
                'email'     => $user->email
            ]);

            session(['admin_user' => $user]);
            return redirect('/admin')->with('success', 'Login berhasil!');
        }

        session([
            'user_id' => $user->id,
            'nama_user' => $user->nama_user,
            'email' => $user->email
        ]);


        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // public function showRegisterForm()
    // {
    //     return view('admin.register'); // Blade view untuk form register
    // }
}
