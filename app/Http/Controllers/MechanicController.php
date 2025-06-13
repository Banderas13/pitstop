<?php

namespace App\Http\Controllers;
use App\Models\Mechanic;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MechanicController extends Controller
{

    public function index(){
        $user = Auth::user();
        $mechanics = $user->mechanics;
        $searchedMechanics = collect();
        return view('mechanics', compact('mechanics', 'searchedMechanics'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $mechanics = $user->mechanics;
        $query = Mechanic::query();
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }
    
        $searchedMechanics = $query->get();
    
        return view('mechanics', compact('mechanics', 'searchedMechanics'));
    }

    public function addToContacts($id)
    {
        $user = Auth::user();
        $mechanic = Mechanic::findOrFail($id);
    
        // Prevent duplicate entries
        if (!$user->mechanics->contains($mechanic->id)) {
        $user->mechanics()->attach($mechanic->id);
        }
    
        return redirect()->back()->with('success', 'Mechanieker toegevoegd aan je contactlijst!');
    }
}
