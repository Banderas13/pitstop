@extends('layouts.app')

@section('title', 'Nieuwe Case Maken')

@section('content')
    <!-- Progress Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Nieuwe Case Maken</h4>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-primary fw-bold">Stap 1: Gebruiker & Voertuig</small>
                        <small class="text-muted">Stap 2: Probleem Beschrijving</small>
                        <small class="text-muted">Stap 3: Media Upload</small>
                        <small class="text-muted">Stap 4: Offerte Opstellen</small>
                        <small class="text-muted">Stap 5: Versturen</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 1 Form -->
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user-car me-2"></i>
                        Stap 1: Kies Gebruiker en Voertuig
                    </h5>
                </div>
                <div class="card-body">
                    <form id="step1Form">
                        @csrf
                        <!-- User Selection -->
                        <div class="mb-4">
                            <label for="user_id" class="form-label fw-bold">
                                <i class="fas fa-user me-2 text-primary"></i>
                                Selecteer Gebruiker
                            </label>
                            <select class="form-select form-select-lg" id="user_id" name="user_id" required>
                                <option value="">-- Kies een gebruiker --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Selecteer de gebruiker voor wie je een case wilt aanmaken
                            </div>
                        </div>

                        <!-- Car Selection (initially hidden) -->
                        <div class="mb-4" id="car-selection" style="display: none;">
                            <label for="car_id" class="form-label fw-bold">
                                <i class="fas fa-car me-2 text-primary"></i>
                                Selecteer Voertuig
                            </label>
                            <select class="form-select form-select-lg" id="car_id" name="car_id" required>
                                <option value="">-- Kies een voertuig --</option>
                            </select>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Selecteer het voertuig waarvoor de service nodig is
                            </div>
                            
                            <!-- Loading indicator -->
                            <div id="cars-loading" style="display: none;" class="mt-2">
                                <div class="d-flex align-items-center">
                                    <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <small class="text-muted">Voertuigen laden...</small>
                                </div>
                            </div>
                        </div>

                        <!-- Selected Information Display -->
                        <div id="selection-summary" style="display: none;" class="alert alert-info">
                            <h6 class="alert-heading">
                                <i class="fas fa-check-circle me-2"></i>
                                Geselecteerde Informatie
                            </h6>
                            <div id="selected-user-info"></div>
                            <div id="selected-car-info"></div>
                        </div>
                    </form>
                </div>
                
                <!-- Card Footer with Navigation -->
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('service.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Terug naar Service
                        </a>
                        <button type="button" id="nextStepBtn" class="btn btn-primary" disabled>
                            Volgende Stap
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userSelect = document.getElementById('user_id');
            const carSelect = document.getElementById('car_id');
            const carSelection = document.getElementById('car-selection');
            const carsLoading = document.getElementById('cars-loading');
            const selectionSummary = document.getElementById('selection-summary');
            const selectedUserInfo = document.getElementById('selected-user-info');
            const selectedCarInfo = document.getElementById('selected-car-info');
            const nextStepBtn = document.getElementById('nextStepBtn');

            // When user is selected, load their cars
            userSelect.addEventListener('change', function() {
                const userId = this.value;
                
                if (userId) {
                    // Show loading indicator
                    carsLoading.style.display = 'block';
                    carSelection.style.display = 'block';
                    
                    // Clear previous car selection
                    carSelect.innerHTML = '<option value="">-- Kies een voertuig --</option>';
                    carSelect.disabled = true;
                    
                    // Hide selection summary
                    selectionSummary.style.display = 'none';
                    nextStepBtn.disabled = true;

                    // Fetch cars for selected user
                    fetch(`{{ route('service.user-cars') }}?user_id=${userId}`)
                        .then(response => response.json())
                        .then(cars => {
                            carsLoading.style.display = 'none';
                            carSelect.disabled = false;
                            
                            if (cars.length > 0) {
                                cars.forEach(car => {
                                    const option = document.createElement('option');
                                    option.value = car.id;
                                    option.textContent = car.display_name;
                                    carSelect.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'Geen voertuigen gevonden voor deze gebruiker';
                                option.disabled = true;
                                carSelect.appendChild(option);
                            }

                            // Update user info in summary
                            const selectedUserText = userSelect.options[userSelect.selectedIndex].text;
                            selectedUserInfo.innerHTML = `<strong>Gebruiker:</strong> ${selectedUserText}`;
                        })
                        .catch(error => {
                            console.error('Error fetching cars:', error);
                            carsLoading.style.display = 'none';
                            carSelect.disabled = false;
                            alert('Er is een fout opgetreden bij het laden van de voertuigen.');
                        });
                } else {
                    // Hide car selection if no user is selected
                    carSelection.style.display = 'none';
                    selectionSummary.style.display = 'none';
                    nextStepBtn.disabled = true;
                }
            });

            // When car is selected, show summary and enable next button
            carSelect.addEventListener('change', function() {
                const carId = this.value;
                
                if (carId && userSelect.value) {
                    const selectedCarText = carSelect.options[carSelect.selectedIndex].text;
                    selectedCarInfo.innerHTML = `<strong>Voertuig:</strong> ${selectedCarText}`;
                    
                    selectionSummary.style.display = 'block';
                    nextStepBtn.disabled = false;
                } else {
                    selectionSummary.style.display = 'none';
                    nextStepBtn.disabled = true;
                }
            });

            // Next step button functionality
            nextStepBtn.addEventListener('click', function() {
                const userId = userSelect.value;
                const carId = carSelect.value;
                
                if (userId && carId) {
                    // Store selections in sessionStorage for the multi-step form
                    sessionStorage.setItem('case_user_id', userId);
                    sessionStorage.setItem('case_car_id', carId);
                    
                    // Navigate to step 2
                    window.location.href = '{{ route("service.create.step2") }}';
                } else {
                    alert('Selecteer zowel een gebruiker als een voertuig voordat je doorgaat.');
                }
            });
        });
    </script>
@endsection 