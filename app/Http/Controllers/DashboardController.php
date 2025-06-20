<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Mechanic;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mechanic = Auth::guard('mechanic')->user();
        
        if($user != null){
            $cars = $user->cars()->with(['type.brand', 'cases'])->get();
            $cases = $user->cases()->with(['mechanic', 'car.type.brand'])->get();
            // Instead of using the relationship, we'll get all mechanics
            $mechanics = Mechanic::all();
            $mechanicCases = [];
        }
        elseif($mechanic != null){
            $mechanicCases = $mechanic->cases()->with(['user', 'car.type.brand'])->get();
            $cars = [];
            $cases = [];
            $mechanics = [];
        }
        else{
            $cars = [];
            $cases = [];
            $mechanics = [];
            $mechanicCases = [];
        }
        
        return view('home', compact('cars', 'cases', 'mechanics', 'mechanicCases'));
    }
}
