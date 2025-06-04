<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user != null){
            $cars = $user->cars;
            $cases = $user->cases;
        }
        else{
            $cars = [];
            $cases = [];
        }
        

        return view('home', compact('cars'), compact('cases'));
    }
}
