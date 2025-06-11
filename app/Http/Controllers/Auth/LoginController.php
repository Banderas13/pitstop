<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $credentials['email'];
        $password = $credentials['password'];
        $remember = $request->filled('remember');

        
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            Auth::guard('web')->login($user, $remember);
            $request->session()->regenerate();
            $request->session()->put('user_type', 'user');
            
            
            return redirect()->intended('/'); // pas aan naar jouw user route
        }

        
        $mechanic = Mechanic::where('email', $email)->first();
        if ($mechanic && Hash::check($password, $mechanic->password)) {
            Auth::guard('mechanic')->login($mechanic, $remember);
            $request->session()->regenerate();
            $request->session()->put('user_type', 'mechanic');
            
            
            return redirect()->intended('/register'); // pas aan naar jouw mechanic route
        }

        
        return back()->withErrors([
            'email' => 'Ongeldige inloggegevens.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        
        Auth::guard('web')->logout();
        Auth::guard('mechanic')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }

    
    public function getCurrentUserType()
    {
        if (Auth::guard('web')->check()) {
            return 'user';
        } elseif (Auth::guard('mechanic')->check()) {
            return 'mechanic';
        }
        return null;
    }

    
    public function getCurrentUser()
    {
        if (Auth::guard('web')->check()) {
            return Auth::guard('web')->user();
        } elseif (Auth::guard('mechanic')->check()) {
            return Auth::guard('mechanic')->user();
        }
        return null;
    }
}
