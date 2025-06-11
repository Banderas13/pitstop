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
            $cars = $user->cars;
            $cases = $user->cases;
            // Instead of using the relationship, we'll get all mechanics
            $mechanics = Mechanic::all();
            $mechanicCases = [];
        }
        elseif($mechanic != null){
            $mechanicCases = $mechanic->cases->where('approval', true);
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
