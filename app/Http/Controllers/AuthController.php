<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller {
    public function index() {
        return view('auth.index');
    }

    public function register() {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($user);

        return redirect()->route('dashboard.home.index');
    }

    public function authenticate(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember_me ?? false)) {
            return redirect()->route('dashboard.home.index');
        }

        return redirect()->back()->withInput($request->only('email', 'password', 'remember_me'))->with('error', 'Email or password is incorrect');
    }

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
    
        if (!$user) {
            return redirect()
                ->route('auth.index')
                ->with('error', 'Email is not registered');
        }

        Auth::login($user);

        return redirect()->route('dashboard.home.index');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('auth.index');
    }

    public function changePassword() {
        return view('auth.change-password', [
            'title' => 'Ubah Kata Sandi'
        ]);
    }

    public function updatePassword(UpdatePasswordRequest $request) {
        $user = User::find(Auth::user()->id);

        if (!Auth::attempt(['email' => $user->email, 'password' => $request->current_password])) {
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai'])->withInput();
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui');
    }
}
