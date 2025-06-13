<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\User;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze pagina.');
        }

        $mechanic = Auth::guard('mechanic')->user();
        
        // Get open cases (not approved yet)
        $openCases = CaseModel::where('mechanic_id', $mechanic->id)
            ->where('approval', false)
            ->with(['user', 'car.type.brand', 'offer'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get closed cases (approved)
        $closedCases = CaseModel::where('mechanic_id', $mechanic->id)
            ->where('approval', true)
            ->with(['user', 'car.type.brand', 'offer'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('service', compact('openCases', 'closedCases'));
    }

    public function create()
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        // Get all users for the dropdown
        $users = User::orderBy('name')->get();
        
        return view('service.create-case', compact('users'));
    }

    public function getUserCars(Request $request)
    {
        $userId = $request->get('user_id');
        
        if (!$userId) {
            return response()->json([]);
        }

        $cars = Car::where('user_id', $userId)
            ->with('type.brand')
            ->get()
            ->map(function ($car) {
                return [
                    'id' => $car->id,
                    'display_name' => "{$car->type->brand->name} {$car->type->name} ({$car->year}) - {$car->numberplate}"
                ];
            });

        return response()->json($cars);
    }
} 