<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with(['type.brand', 'user'])
            ->where('user_id', Auth::id())
            ->get();
            
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        $fuels = ['gasoline', 'diesel', 'electric', 'hybrid/diesel', 'hybrid/gasoline', 'hydrogen'];
        return view('cars.create', compact('fuels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string',
            'type_name' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'numberplate' => 'required|string|unique:cars,numberplate',
            'fuel' => 'required|in:gasoline,diesel,electric,hybrid/diesel,hybrid/gasoline,hydrogen',
            'chasis_number' => 'nullable|string|unique:cars,chasis_number',
        ]);

        // Zoek of maak het merk
        $brand = Brand::firstOrCreate(['name' => $request->brand_name]);

        // Zoek of maak het type/model
        $type = Type::firstOrCreate([
            'name' => $request->type_name,
            'brand_id' => $brand->id
        ]);

        // Maak de auto
        Car::create([
            'type_id' => $type->id,
            'year' => $request->year,
            'numberplate' => $request->numberplate,
            'fuel' => $request->fuel,
            'chasis_number' => $request->chasis_number,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('cars.index')->with('success', 'Wagen succesvol toegevoegd!');
    }

    public function searchBrands(Request $request)
    {
        $query = $request->get('q', '');
        $forceApi = $request->get('force_api', false);
        
        // Zoek eerst in eigen database
        $localBrands = Brand::where('name', 'LIKE', "%{$query}%")
            ->pluck('name')
            ->toArray();

        $apiBrands = [];
        $apiError = null;

        // Zoek via API als er geen lokale resultaten zijn OF als force_api true is
        if ((empty($localBrands) || $forceApi) && !empty($query) && strlen($query) >= 2) {
            try {
                $response = Http::withOptions([
                    'verify' => false, // Disable SSL verification for development
                ])->timeout(15)->get("https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json");
                
                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data['Results']) && is_array($data['Results'])) {
                        $apiBrands = collect($data['Results'])
                            ->pluck('Make_Name')
                            ->filter(function ($brand) use ($query) {
                                return stripos($brand, $query) !== false;
                            })
                            ->take(15)
                            ->toArray();
                    } else {
                        $apiError = "API response does not contain Results array";
                    }
                } else {
                    $apiError = "API returned status: " . $response->status();
                }
            } catch (\Exception $e) {
                $apiError = $e->getMessage();
            }
        }

        $allBrands = array_unique(array_merge($localBrands, $apiBrands));
        
        return response()->json([
            'brands' => $allBrands,
            'local_count' => count($localBrands),
            'api_count' => count($apiBrands),
            'api_error' => $apiError,
            'total_count' => count($allBrands)
        ]);
    }

    public function searchModels(Request $request)
    {
        $brandName = $request->get('brand');
        
        if (empty($brandName)) {
            return response()->json([]);
        }

        $models = [];

        // Altijd API raadplegen voor alle beschikbare modellen
        try {
            $response = Http::withOptions([
                'verify' => false, // Disable SSL verification for development
            ])->timeout(15)->get("https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformake/{$brandName}?format=json");
            
            if ($response->successful()) {
                $data = $response->json();
                $models = collect($data['Results'] ?? [])
                    ->pluck('Model_Name')
                    ->filter() // Remove empty values
                    ->unique()
                    ->sort() // Sort alphabetically
                    ->values() // Reset keys
                    ->toArray();
            }
        } catch (\Exception $e) {
            // Als API faalt, fallback naar lokale database
            $brand = Brand::where('name', $brandName)->first();
            $models = $brand ? $brand->types->pluck('name')->sort()->values()->toArray() : [];
        }

        return response()->json($models);
    }

    public function destroy(Car $car)
    {
        // Controleer of de auto van de ingelogde gebruiker is
        if ($car->user_id !== Auth::id()) {
            abort(403);
        }

        $car->delete();
        
        return redirect()->route('cars.index')->with('success', 'Wagen succesvol verwijderd!');
    }
}
