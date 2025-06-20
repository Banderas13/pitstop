<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Mechanic;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web,mechanic']);
    }

    public function index()
    {
        if (Auth::guard('mechanic')->check()) {
            $user = Auth::guard('mechanic')->user();
        } else {
            $user = Auth::guard('web')->user();
        }
        return view('profile', compact('user'));
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        if (Auth::guard('mechanic')->check()) {
            $user = Auth::guard('mechanic')->user();
            $request->validate([
                'telephone' => ['required', 'string', 'max:20'],
            ]);
            $user->telephone = $request->telephone;
        } else {
            $user = Auth::guard('web')->user();
        }

        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Je gegevens zijn succesvol bijgewerkt.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (Auth::guard('mechanic')->check()) {
            $user = Auth::guard('mechanic')->user();
        } else {
            $user = Auth::guard('web')->user();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Je wachtwoord is succesvol bijgewerkt.');
    }

    public function updateEmail(Request $request)
    {
        if (Auth::guard('mechanic')->check()) {
            $user = Auth::guard('mechanic')->user();
            $uniqueRule = 'unique:mechanics,email,' . $user->id;
        } else {
            $user = Auth::guard('web')->user();
            $uniqueRule = 'unique:users,email,' . $user->id;
        }

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', $uniqueRule],
            'current_password' => ['required', 'current_password'],
        ]);

        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Je e-mailadres is succesvol bijgewerkt.');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
        ]);

        if (Auth::guard('mechanic')->check()) {
            $user = Auth::guard('mechanic')->user();
            Auth::guard('mechanic')->logout();
            $user->delete();
        } else {
            $user = Auth::guard('web')->user();
            Auth::guard('web')->logout();
            $user->delete();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Je account is succesvol verwijderd.');
    }
} 