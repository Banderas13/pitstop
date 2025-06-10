<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mechanic;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        $brands = Brand::all();
        $types = Type::with('brand')->get();
        
        return view('auth.register', compact('brands', 'types'));
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($request->role === 'user') {
            return $this->createUser($request);
        } elseif ($request->role === 'mechanic') {
            return $this->createMechanic($request);
        }

        return back()->withErrors(['role' => 'Please select a valid role.']);
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        $rules = [
            'role' => ['required', 'in:user,mechanic'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        // Add role-specific validation rules
        if (isset($data['role'])) {
            if ($data['role'] === 'user') {
                $rules = array_merge($rules, [
                    'bday' => ['nullable', 'date', 'before:today'],
                    'vat' => ['nullable', 'string', 'max:20'],
                    'cars' => ['nullable', 'array'],
                    'cars.*.brand_id' => ['nullable', 'exists:brands,id'],
                    'cars.*.type_id' => ['nullable', 'exists:types,id'],
                    'cars.*.year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
                    'cars.*.chasis_number' => ['nullable', 'string', 'max:17'],
                    'cars.*.numberplate' => ['nullable', 'string', 'max:20'],
                    'cars.*.fuel' => ['nullable', Rule::in(['diesel', 'gasoline', 'hybrid/diesel', 'hybrid/gasoline', 'lpg', 'electric', 'hydrogen'])],
                ]);
                
                // Check if email exists in users table
                $rules['email'][] = 'unique:users,email';
            } elseif ($data['role'] === 'mechanic') {
                $rules = array_merge($rules, [
                    'company_name' => ['nullable', 'string', 'max:255'],
                    'vat' => ['required', 'string', 'max:20'],
                    'adress' => ['required', 'string', 'max:500'],
                    'telephone' => ['required', 'string', 'max:20'],
                ]);
                
                // Check if email exists in mechanics table
                $rules['email'][] = 'unique:mechanics,email';
            }
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance.
     */
    protected function createUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bday' => $request->bday,
            'vat' => $request->vat,
        ]);

        // Create cars if provided
        if ($request->has('cars')) {
            foreach ($request->cars as $carData) {
                if (!empty($carData['brand_id']) && !empty($carData['type_id'])) {
                    Car::create([
                        'user_id' => $user->id,
                        'brand_id' => $carData['brand_id'], // Add this line
                        'type_id' => $carData['type_id'],
                        'year' => $carData['year'] ?? null,
                        'chasis_number' => $carData['chasis_number'] ?? null,
                        'numberplate' => $carData['numberplate'] ?? null,
                        'fuel' => $carData['fuel'] ?? null,
                    ]);
                }
            }
        }

        // Log the user in and verify
        if (auth()->login($user)) {
            return redirect()->intended('/')->with('success', 'Welkom! U bent succesvol geregistreerd en ingelogd.');
        }

        // If login fails, redirect to login page
        return redirect()->route('login')->with('error', 'Account aangemaakt maar automatisch inloggen mislukt. Probeer handmatig in te loggen.');
    }

    /**
     * Create a new mechanic instance.
     */
    protected function createMechanic(Request $request)
    {
        $mechanic = Mechanic::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_name' => $request->company_name,
            'vat' => $request->vat,
            'adress' => $request->adress,
            'telephone' => $request->telephone,
        ]);

        // Log the mechanic in using the mechanic guard
        auth('mechanic')->login($mechanic);

        return redirect()->intended('/login')->with('success', 'Monteur account succesvol aangemaakt! Log in om door te gaan.');
    }
}