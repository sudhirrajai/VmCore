<?php

namespace App\Http\Controllers\Admin\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      return redirect()->route('admin.dashboard');
    }

    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required|string|min:6',
    ]);

    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();
      return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.auth-login-basic');
  }
}
