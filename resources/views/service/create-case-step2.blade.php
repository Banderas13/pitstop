@extends('layouts.app')

@section('title', 'Nieuwe Case - Probleem Beschrijving')

@section('content')
    <!-- Progress Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Nieuwe Case Maken</h4>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-success">
                            <i class="fas fa-check me-1"></i>
                            Stap 1: Gebruiker & Voertuig
                        </small>
                        <small class="text-primary fw-bold">Stap 2: Probleem Beschrijving</small>
                        <small class="text-muted">Stap 3: Media Upload</small>
                        <small class="text-muted">Stap 4: Offerte Opstellen</small>
                        <small class="text-muted">Stap 5: Versturen</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 2 Form -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <form method="POST" action="{{ route('service.store.step2') }}" id="step2Form">
                @csrf
                
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-clipboard-list me-2"></i>
                            Stap 2: Beschrijf het Probleem
                        </h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Selected Info Summary (from Step 1) -->
                        <div class="alert alert-light border mb-4">
                            <h6 class="mb-2">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Geselecteerde Informatie
                            </h6>
                            <div id="step1-summary" class="small text-muted">
                                <div id="selected-user-display"></div>
                                <div id="selected-car-display"></div>
                            </div>
                        </div>

                        <!-- Client Description Section (Optional) -->
                        <div class="mb-4">
                            <label for="client_description" class="form-label fw-bold">
                                <i class="fas fa-user-comment me-2 text-warning"></i>
                                Klant Beschrijving
                                <span class="badge bg-secondary ms-2">Optioneel</span>
                            </label>
                            <textarea 
                                class="form-control form-control-lg @error('client_description') is-invalid @enderror" 
                                id="client_description" 
                                name="client_description" 
                                rows="4" 
                                placeholder="Beschrijf hier wat de klant heeft verteld over het probleem of de klachten..."
                                maxlength="1000">{{ old('client_description') }}</textarea>
                            
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Beschrijf hier de oorspronkelijke klacht of het probleem zoals door de klant beschreven.
                                <br>
                                <span class="text-muted">Voorbeeld: "Auto maakt raar geluid bij het remmen, vooral bij lage snelheid."</span>
                            </div>
                            <div class="mt-1">
                                <small class="text-muted">
                                    <span id="client-char-count">0</span>/1000 karakters
                                </small>
                            </div>
                            
                            @error('client_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Mechanic Description Section (Required) -->
                        <div class="mb-4">
                            <label for="mechanic_description" class="form-label fw-bold">
                                <i class="fas fa-tools me-2 text-primary"></i>
                                Mechaniek Diagnose
                                <span class="badge bg-danger ms-2">Verplicht</span>
                            </label>
                            <textarea 
                                class="form-control form-control-lg @error('mechanic_description') is-invalid @enderror" 
                                id="mechanic_description" 
                                name="mechanic_description" 
                                rows="6" 
                                placeholder="Beschrijf hier je professionele diagnose en bevindingen..."
                                maxlength="2000" 
                                required>{{ old('mechanic_description') }}</textarea>
                            
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Beschrijf hier je professionele diagnose, wat je hebt gevonden en wat er gedaan moet worden.
                                <br>
                                <span class="text-muted">Voorbeeld: "Na inspectie blijken de remblokken versleten. Voorste remschijven tonen ook slijtage. Vervanging van remblokken en schijven noodzakelijk voor veiligheid."</span>
                            </div>
                            <div class="mt-1">
                                <small class="text-muted">
                                    <span id="mechanic-char-count">0</span>/2000 karakters (minimaal 10 karakters)
                                </small>
                            </div>
                            
                            @error('mechanic_description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                    </div>
                    
                    <!-- Card Footer with Navigation -->
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('service.create') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Vorige Stap
                            </a>
                            <button type="submit" id="nextStepBtn" class="btn btn-primary" disabled>
                                Volgende Stap
                                <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Add FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clientDescription = document.getElementById('client_description');
            const mechanicDescription = document.getElementById('mechanic_description');
            const clientCharCount = document.getElementById('client-char-count');
            const mechanicCharCount = document.getElementById('mechanic-char-count');
            const nextStepBtn = document.getElementById('nextStepBtn');

            // Load Step 1 data from sessionStorage
            const userId = sessionStorage.getItem('case_user_id');
            const carId = sessionStorage.getItem('case_car_id');
            
            if (!userId || !carId) {
                alert('Sessie gegevens ontbreken. Je wordt terug gestuurd naar stap 1.');
                window.location.href = '{{ route("service.create") }}';
                return;
            }

            // Display step 1 summary (you might want to fetch this data via AJAX for display)
            document.getElementById('selected-user-display').innerHTML = `<strong>Gebruiker ID:</strong> ${userId}`;
            document.getElementById('selected-car-display').innerHTML = `<strong>Voertuig ID:</strong> ${carId}`;

            // Character counting
            function updateCharCount(textarea, countElement) {
                const count = textarea.value.length;
                countElement.textContent = count;
                
                if (textarea === mechanicDescription) {
                    // Check if mechanic description meets minimum requirement
                    validateForm();
                }
            }

            // Form validation
            function validateForm() {
                const mechanicValid = mechanicDescription.value.trim().length >= 10;
                nextStepBtn.disabled = !mechanicValid;
            }

            // Event listeners
            clientDescription.addEventListener('input', function() {
                updateCharCount(this, clientCharCount);
            });

            mechanicDescription.addEventListener('input', function() {
                updateCharCount(this, mechanicCharCount);
                validateForm();
            });

            // Initialize counts and validation
            updateCharCount(clientDescription, clientCharCount);
            updateCharCount(mechanicDescription, mechanicCharCount);
            validateForm();

            // Form submission - store data in session for next steps
            document.getElementById('step2Form').addEventListener('submit', function(e) {
                // Additional client-side validation
                if (mechanicDescription.value.trim().length < 10) {
                    e.preventDefault();
                    alert('De mechaniek diagnose moet minimaal 10 karakters bevatten.');
                    mechanicDescription.focus();
                }
            });
        });
    </script>
@endsection 