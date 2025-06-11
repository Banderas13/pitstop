<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Je naam is succesvol bijgewerkt.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Je wachtwoord is succesvol bijgewerkt.');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'current_password' => ['required', 'current_password'],
        ]);

        $user = auth()->user();
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Je e-mailadres is succesvol bijgewerkt.');
    }
} 