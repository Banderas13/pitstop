<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\User;
use App\Models\Car;
use App\Models\Offer;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        // Check if user is authenticated as mechanic
        if (Auth::guard('mechanic')->check()) {
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
        // Check if user is authenticated as regular user
        elseif (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            
            // Get open cases for this user (not approved yet)
            $openCases = CaseModel::where('user_id', $user->id)
                ->where('approval', false)
                ->with(['mechanic', 'car.type.brand', 'offer'])
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Get closed cases for this user (approved)
            $closedCases = CaseModel::where('user_id', $user->id)
                ->where('approval', true)
                ->with(['mechanic', 'car.type.brand', 'offer'])
                ->orderBy('updated_at', 'desc')
                ->get();

            return view('service-user', compact('openCases', 'closedCases'));
        }
        else {
            abort(403, 'Je moet ingelogd zijn om deze pagina te bekijken.');
        }
    }

    public function show(CaseModel $case)
    {
        // Check if user is authenticated as mechanic
        if (Auth::guard('mechanic')->check()) {
            $mechanic = Auth::guard('mechanic')->user();
            
            // Check if this case belongs to the authenticated mechanic
            if ($case->mechanic_id !== $mechanic->id) {
                abort(403, 'Je hebt geen toegang tot deze case.');
            }

            // Load all related data
            $case->load([
                'user',
                'car.type.brand', 
                'offer',
                'media',
                'mechanic'
            ]);

            return view('service.show', compact('case'));
        }
        // Check if user is authenticated as regular user
        elseif (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            
            // Check if this case belongs to the authenticated user
            if ($case->user_id !== $user->id) {
                abort(403, 'Je hebt geen toegang tot deze case.');
            }

            // Load all related data
            $case->load([
                'user',
                'car.type.brand', 
                'offer',
                'media',
                'mechanic'
            ]);

            return view('service.show', compact('case'));
        }
        else {
            abort(403, 'Je moet ingelogd zijn om deze case te bekijken.');
        }
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

    public function createStep2()
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        return view('service.create-case-step2');
    }

    public function storeStep2(Request $request)
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        $request->validate([
            'mechanic_description' => 'required|string|min:10|max:2000',
            'client_description' => 'nullable|string|max:1000',
        ]);

        // Combine descriptions into structured format
        $combinedDescription = '';
        
        if ($request->client_description) {
            $combinedDescription .= "=== KLANT BESCHRIJVING ===\n";
            $combinedDescription .= trim($request->client_description) . "\n\n";
        }
        
        $combinedDescription .= "=== MECHANIEK DIAGNOSE ===\n";
        $combinedDescription .= trim($request->mechanic_description);

        // Store in session for the multi-step form
        session(['case_description' => $combinedDescription]);

        // Redirect to step 3 (to be created)
        return redirect()->route('service.create.step3');
    }

    public function createStep3()
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        // Check if previous steps are completed
        if (!session()->has('case_description')) {
            return redirect()->route('service.create.step2')
                ->with('error', 'Voltooi eerst stap 2 voordat je doorgaat naar media upload.');
        }

        return view('service.create-case-step3');
    }

    public function storeStep3(Request $request)
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        // Check if previous steps are completed
        if (!session()->has('case_description')) {
            return redirect()->route('service.create.step2')
                ->with('error', 'Voltooi eerst stap 2 voordat je doorgaat naar media upload.');
        }

        $request->validate([
            'photos' => 'nullable|array|max:10',
            'photos.*' => 'image|mimes:jpeg,jpg,png,gif|max:5120', // 5MB max per photo
            'videos' => 'nullable|array|max:5',
            'videos.*' => 'mimes:mp4,avi,mov,wmv|max:51200', // 50MB max per video
        ]);

        $uploadedFiles = [];

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                if ($photo->isValid()) {
                    $filename = 'case_photo_' . time() . '_' . $index . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('case_media/photos', $filename, 'public');
                    $uploadedFiles['photos'][] = [
                        'original_name' => $photo->getClientOriginalName(),
                        'stored_name' => $filename,
                        'path' => $path,
                        'size' => $photo->getSize(),
                        'type' => 'photo'
                    ];
                }
            }
        }

        // Handle video uploads
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $index => $video) {
                if ($video->isValid()) {
                    $filename = 'case_video_' . time() . '_' . $index . '.' . $video->getClientOriginalExtension();
                    $path = $video->storeAs('case_media/videos', $filename, 'public');
                    $uploadedFiles['videos'][] = [
                        'original_name' => $video->getClientOriginalName(),
                        'stored_name' => $filename,
                        'path' => $path,
                        'size' => $video->getSize(),
                        'type' => 'video'
                    ];
                }
            }
        }

        // Store media info in session for the multi-step form
        session(['case_media' => $uploadedFiles]);

        // Redirect to step 4 with media info
        return redirect()->route('service.create.step4')
            ->with('uploaded_media', $uploadedFiles);
    }

    public function createStep4()
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        // Check if previous steps are completed
        if (!session()->has('case_description')) {
            return redirect()->route('service.create.step2')
                ->with('error', 'Voltooi eerst de vorige stappen voordat je doorgaat naar offerte opstelling.');
        }

        return view('service.create-case-step4');
    }

    public function storeStep4(Request $request)
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        // Check if previous steps are completed
        if (!session()->has('case_description')) {
            return redirect()->route('service.create.step2')
                ->with('error', 'Voltooi eerst de vorige stappen voordat je doorgaat naar offerte opstelling.');
        }

        $offerType = $request->input('offer_type');

        if ($offerType === 'manual') {
            return $this->handleManualOffer($request);
        } elseif ($offerType === 'upload') {
            return $this->handleUploadOffer($request);
        }

        return redirect()->back()->with('error', 'Ongeldige offerte type.');
    }

    private function handleManualOffer(Request $request)
    {
        // Validate manual offer data
        $request->validate([
            'parts' => 'nullable|array',
            'parts.*.name' => 'required_with:parts|string|max:255',
            'parts.*.quantity' => 'required_with:parts|numeric|min:1',
            'parts.*.price' => 'required_with:parts|numeric|min:0',
            'labour' => 'nullable|array',
            'labour.*.name' => 'required_with:labour|string|max:255',
            'labour.*.quantity' => 'required_with:labour|numeric|min:1',
            'labour.*.price' => 'required_with:labour|numeric|min:0',
        ]);

        $parts = $request->input('parts', []);
        $labour = $request->input('labour', []);
        
        // Check if at least one item is provided
        if (empty($parts) && empty($labour)) {
            return redirect()->back()->with('error', 'Voeg minimaal één onderdeel of arbeid toe.');
        }

        // Get session data - we'll get these from hidden inputs in the form
        $userId = $request->input('user_id') ?? session('case_user_id');
        $carId = $request->input('car_id') ?? session('case_car_id');
        $description = session('case_description');
        $mechanic = Auth::guard('mechanic')->user();
        
        if (!$userId || !$carId) {
            return redirect()->route('service.create')
                ->with('error', 'Gebruiker of voertuig gegevens ontbreken. Start opnieuw.');
        }

        // Get related data for PDF
        $user = User::find($userId);
        $car = Car::with('type.brand')->find($carId);

        if (!$user || !$car) {
            return redirect()->route('service.create')
                ->with('error', 'Gebruiker of voertuig niet gevonden. Start opnieuw.');
        }

        // Calculate totals
        $items = [];
        $subtotal = 0;

        // Process parts
        foreach ($parts as $part) {
            if (!empty($part['name']) && !empty($part['quantity']) && !empty($part['price'])) {
                $itemTotal = $part['quantity'] * $part['price'];
                $items[] = [
                    'type' => 'parts',
                    'name' => $part['name'],
                    'quantity' => $part['quantity'],
                    'price' => $part['price'],
                    'total' => $itemTotal
                ];
                $subtotal += $itemTotal;
            }
        }

        // Process labour
        foreach ($labour as $labourItem) {
            if (!empty($labourItem['name']) && !empty($labourItem['quantity']) && !empty($labourItem['price'])) {
                $itemTotal = $labourItem['quantity'] * $labourItem['price'];
                $items[] = [
                    'type' => 'labour',
                    'name' => $labourItem['name'],
                    'quantity' => $labourItem['quantity'],
                    'price' => $labourItem['price'],
                    'total' => $itemTotal
                ];
                $subtotal += $itemTotal;
            }
        }

        // Check VAT settings from request
        $vatEnabled = $request->input('vat_enabled', '1') === '1';
        $vatRate = 0.21;
        $vatAmount = $vatEnabled ? $subtotal * $vatRate : 0;
        $total = $subtotal + $vatAmount;

        // Prepare data for PDF
        $mechanicData = [
            'company_name' => $mechanic->company_name,
            'adress' => $mechanic->adress,
            'email' => $mechanic->email,
            'telephone' => $mechanic->telephone,
            'vat' => $mechanic->vat,
        ];

        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            'telephone' => $user->telephone,
            'vat' => $user->vat,
        ];

        $carData = [
            'brand' => $car->type->brand->name,
            'model' => $car->type->name,
            'numberplate' => $car->numberplate,
            'year' => $car->year,
            'fuel' => $car->fuel,
        ];

        $offerData = [
            'case_id' => 'TBD', // Will be set after case creation
            'offer_number' => 'OFF-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'date' => date('d-m-Y'),
            'description' => $description,
            'items' => $items,
            'subtotal' => $subtotal,
            'vat_enabled' => $vatEnabled,
            'vat_amount' => $vatAmount,
            'total' => $total,
        ];

        // Generate PDF
        $pdf = PDF::loadView('pdf.offer-template', compact('mechanicData', 'userData', 'carData', 'offerData'));
        
        // Generate unique filename
        $filename = 'offer_' . time() . '_' . $mechanic->id . '.pdf';
        $filePath = 'case_media/offers/' . $filename;
        
        // Save PDF to storage
        Storage::disk('public')->put($filePath, $pdf->output());

        // Create offer record
        $offer = Offer::create([
            'path' => $filePath,
            'price' => $total,
        ]);

        // Store offer info in session
        session([
            'case_offer_id' => $offer->id,
            'case_offer_data' => [
                'type' => 'manual',
                'items' => $items,
                'vat_enabled' => $vatEnabled,
                'subtotal' => $subtotal,
                'vat_amount' => $vatAmount,
                'total' => $total,
            ]
        ]);

        // Redirect to step 5 (to be created)
        return redirect()->route('service.create.step5');
    }

    private function handleUploadOffer(Request $request)
    {
        // Validate upload offer data
        $request->validate([
            'offer_file' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB
            'upload_price' => 'required|numeric|min:0.01',
        ]);

        $file = $request->file('offer_file');
        $price = $request->input('upload_price');
        $mechanic = Auth::guard('mechanic')->user();

        // Generate unique filename
        $filename = 'offer_upload_' . time() . '_' . $mechanic->id . '.' . $file->getClientOriginalExtension();
        $filePath = 'case_media/offers/' . $filename;
        
        // Store uploaded file
        $file->storeAs('case_media/offers', $filename, 'public');

        // Create offer record
        $offer = Offer::create([
            'path' => $filePath,
            'price' => $price,
        ]);

        // Store offer info in session
        session([
            'case_offer_id' => $offer->id,
            'case_offer_data' => [
                'type' => 'upload',
                'price' => $price,
                'filename' => $file->getClientOriginalName(),
            ]
        ]);

        // Redirect to step 5 (to be created)
        return redirect()->route('service.create.step5');
    }

    public function createStep5()
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        // Check if previous steps are completed
        if (!session()->has('case_description') || !session()->has('case_offer_id')) {
            return redirect()->route('service.create')
                ->with('error', 'Voltooi eerst alle vorige stappen voordat je doorgaat naar de eindstap.');
        }

        return view('service.create-case-step5');
    }

    public function storeStep5(Request $request)
    {
        // Check if user is authenticated as mechanic
        if (!Auth::guard('mechanic')->check()) {
            abort(403, 'Alleen mechaniekers hebben toegang tot deze functie.');
        }

        // Validate final submission data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
        ]);

        // Get session data
        $userId = $request->input('user_id');
        $carId = $request->input('car_id');
        $description = session('case_description');
        $mediaFiles = session('case_media', []);
        $offerId = session('case_offer_id');
        $mechanic = Auth::guard('mechanic')->user();

        // Verify all required data exists
        if (!$description || !$offerId || !$userId || !$carId) {
            return redirect()->route('service.create')
                ->with('error', 'Ontbrekende gegevens. Begin opnieuw.');
        }

        try {
            // Start database transaction
            \DB::beginTransaction();

            // Create the case record
            $case = CaseModel::create([
                'user_id' => $userId,
                'mechanic_id' => $mechanic->id,
                'car_id' => $carId,
                'description' => $description,
                'offer_id' => $offerId,
                'approval' => false, // Default to not approved
            ]);

            // Update the offer with the case ID for PDF reference
            $offer = Offer::find($offerId);
            if ($offer) {
                // If it's a generated PDF, update it with the correct case ID
                if (strpos($offer->path, 'offer_') === 0) {
                    $this->updateOfferPdfWithCaseId($offer, $case, $mechanic);
                }
            }

            // Save media files to database if any exist
            if (!empty($mediaFiles)) {
                $this->saveMediaFiles($case->id, $mediaFiles);
            }

            // Commit the transaction
            \DB::commit();

            // Clear session data
            $this->clearCaseSession();

            // Redirect with success message
            return redirect()->route('service.index')
                ->with('success', 'Case succesvol aangemaakt en opgeslagen! De case is nu zichtbaar in je service overzicht.');

        } catch (\Exception $e) {
            // Rollback transaction on error
            \DB::rollback();
            
            \Log::error('Error creating case: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Er is een fout opgetreden bij het opslaan van de case. Probeer het opnieuw.');
        }
    }

    private function updateOfferPdfWithCaseId(Offer $offer, CaseModel $case, Mechanic $mechanic)
    {
        try {
            // Get the original data for PDF regeneration
            $user = User::find($case->user_id);
            $car = Car::with('type.brand')->find($case->car_id);

            if (!$user || !$car) {
                return;
            }

            // Prepare data for PDF (same as in handleManualOffer but with correct case ID)
            $mechanicData = [
                'company_name' => $mechanic->company_name,
                'adress' => $mechanic->adress,
                'email' => $mechanic->email,
                'telephone' => $mechanic->telephone,
                'vat' => $mechanic->vat,
            ];

            $userData = [
                'name' => $user->name,
                'email' => $user->email,
                'telephone' => $user->telephone,
                'vat' => $user->vat,
            ];

            $carData = [
                'brand' => $car->type->brand->name,
                'model' => $car->type->name,
                'numberplate' => $car->numberplate,
                'year' => $car->year,
                'fuel' => $car->fuel,
            ];

            $offerData = [
                'case_id' => $case->id, // Now we have the correct case ID
                'offer_number' => 'OFF-' . date('Y') . '-' . str_pad($case->id, 4, '0', STR_PAD_LEFT),
                'date' => date('d-m-Y'),
                'description' => $case->description,
                'items' => [], // Would need to be stored in session if we want to regenerate
                'subtotal' => $offer->price, // Simplified - using total price
                'vat_enabled' => false,
                'vat_amount' => 0,
                'total' => $offer->price,
            ];

            // Generate updated PDF
            $pdf = PDF::loadView('pdf.offer-template', compact('mechanicData', 'userData', 'carData', 'offerData'));
            
            // Update the existing PDF file
            Storage::disk('public')->put($offer->path, $pdf->output());

        } catch (\Exception $e) {
            \Log::error('Error updating PDF with case ID: ' . $e->getMessage());
            // Don't throw - this is not critical for the case creation
        }
    }

    private function saveMediaFiles($caseId, $mediaFiles)
    {
        // Create Media model if it doesn't exist
        $mediaRecords = [];
        
        // Save photos
        if (isset($mediaFiles['photos'])) {
            foreach ($mediaFiles['photos'] as $photo) {
                $mediaRecords[] = [
                    'case_id' => $caseId,
                    'path' => $photo['path'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Save videos
        if (isset($mediaFiles['videos'])) {
            foreach ($mediaFiles['videos'] as $video) {
                $mediaRecords[] = [
                    'case_id' => $caseId,
                    'path' => $video['path'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Bulk insert media records
        if (!empty($mediaRecords)) {
            \DB::table('media')->insert($mediaRecords);
        }
    }

    private function clearCaseSession()
    {
        // Clear all case-related session data
        session()->forget([
            'case_description',
            'case_media',
            'case_offer_id',
            'case_offer_data'
        ]);
    }

    public function getUserData(Request $request)
    {
        $userId = $request->get('user_id');
        
        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        $user = User::find($userId);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'telephone' => $user->telephone,
            'vat' => $user->vat,
        ]);
    }

    public function getCarData(Request $request)
    {
        $carId = $request->get('car_id');
        
        if (!$carId) {
            return response()->json(['error' => 'Car ID is required'], 400);
        }

        $car = Car::with('type.brand')->find($carId);
        
        if (!$car) {
            return response()->json(['error' => 'Car not found'], 404);
        }

        return response()->json([
            'id' => $car->id,
            'brand' => $car->type->brand->name,
            'model' => $car->type->name,
            'numberplate' => $car->numberplate,
            'year' => $car->year,
            'fuel' => ucfirst($car->fuel),
        ]);
    }

    public function approve(CaseModel $case)
    {
        // Check if user is authenticated as regular user (not mechanic)
        if (!Auth::guard('web')->check()) {
            abort(403, 'Alleen klanten kunnen cases goedkeuren.');
        }

        $user = Auth::guard('web')->user();
        
        // Check if this case belongs to the authenticated user
        if ($case->user_id !== $user->id) {
            abort(403, 'Je hebt geen toegang tot deze case.');
        }

        // Check if case is already approved
        if ($case->approval) {
            return redirect()->back()->with('info', 'Deze case is al goedgekeurd.');
        }

        try {
            // Update the case to approved
            $case->update([
                'approval' => true,
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Case succesvol goedgekeurd! De status is bijgewerkt.');

        } catch (\Exception $e) {
            \Log::error('Error approving case: ' . $e->getMessage());
            
            return redirect()->back()->with('error', 'Er is een fout opgetreden bij het goedkeuren van de case. Probeer het opnieuw.');
        }
    }
} 