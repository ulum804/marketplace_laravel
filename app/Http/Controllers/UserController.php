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
    $validated = $request->validate([
        'nama_user' => 'required|string|max:255',
        'email'     => 'required|string|email|max:255|unique:user_tabel,email',
        'password'  => 'required|string|min:8',
    ]);

    $validated['password'] = Hash::make($validated['password']);

    LoginModel::create($validated);

    return redirect()->back()->with('success', 'Akun berhasil dibuat!');
}

    /**
     * Handle user registration.
     */
    public function register(Request $request)
  {
    $validated = $request->validate([
        'name_user'                  => 'required|string|max:255',
        'email'                 => 'required|string|email|max:255|unique:user_tabel,email',
        'password'              => 'required|string|min:6|confirmed',
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $validated['nama_user'] = $validated['name_user'];
    unset($validated['name_user']);

    $user = LoginModel::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Registrasi berhasil! Silakan login untuk melanjutkan.',
        'user'    => $user
    ]);
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

    /**
     * Handle admin login.
     */
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
            session(['admin_user' => $user]);
            return redirect('/admin')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showRegisterForm()
    {
        return view('admin.register'); // Blade view untuk form register
    }
}
