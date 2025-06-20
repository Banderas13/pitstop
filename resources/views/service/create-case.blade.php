@extends('layouts.app')

@section('title', 'Nieuwe Case Maken')

@section('content')
    <div class="min-h-screen bg-black">
        <!-- Progress Bar -->
        <section class="pt-32 pb-8">
            <div class="max-w-7xl mx-auto px-6 lg:px-9">
                <div class=" overflow-hidden">
                    <div class="p-8">
                        <h1 class="text-4xl lg:text-6xl font-black uppercase tracking-widest mb-8 text-white text-center">
                            NIEUWE CASE MAKEN
                        </h1>
                        <div class="w-full bg-gray-800 rounded-full h-2 mb-6">
                            <div class="bg-pblue h-2 rounded-full transition-all duration-300" style="width: 20%"></div>
                        </div>
                        <div class="flex justify-between text-xs uppercase tracking-wider">
                            <span class="text-pblue font-bold">Stap 1: Gebruiker & Voertuig</span>
                            <span class="text-gray-400">Stap 2: Probleem Beschrijving</span>
                            <span class="text-gray-400">Stap 3: Media Upload</span>
                            <span class="text-gray-400">Stap 4: Offerte Opstellen</span>
                            <span class="text-gray-400">Stap 5: Versturen</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Step 1 Form -->
        <section class="pb-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-9">
                <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                    <div class="bg-pblue p-6">
                        <h2 class="text-xl font-bold text-black uppercase tracking-wider flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                            </svg>
                            Stap 1: Kies Gebruiker en Voertuig
                        </h2>
                    </div>
                    <div class="p-8">
                        <form id="step1Form">
                            @csrf
                            <!-- User Selection -->
                            <div class="mb-8">
                                <label for="user_id" class="block text-lg font-bold text-white mb-4 uppercase tracking-wider">
                                    <svg class="w-5 h-5 inline mr-2 text-pblue" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                    </svg>
                                    Selecteer Gebruiker
                                </label>
                                <select class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-4 rounded-lg focus:outline-none focus:border-pblue transition-colors duration-300" id="user_id" name="user_id" required>
                                    <option value="">-- Kies een gebruiker --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                <div class="mt-2 text-sm text-gray-400">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                                    </svg>
                                    Selecteer de gebruiker voor wie je een case wilt aanmaken
                                </div>
                            </div>

                            <!-- Car Selection (initially hidden) -->
                            <div class="mb-8" id="car-selection" style="display: none;">
                                <label for="car_id" class="block text-lg font-bold text-white mb-4 uppercase tracking-wider">
                                    <svg class="w-5 h-5 inline mr-2 text-pblue" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                    </svg>
                                    Selecteer Voertuig
                                </label>
                                <select class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-4 rounded-lg focus:outline-none focus:border-pblue transition-colors duration-300" id="car_id" name="car_id" required>
                                    <option value="">-- Kies een voertuig --</option>
                                </select>
                                <div class="mt-2 text-sm text-gray-400">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                                    </svg>
                                    Selecteer het voertuig waarvoor de service nodig is
                                </div>
                                
                                <!-- Loading indicator -->
                                <div id="cars-loading" style="display: none;" class="mt-4">
                                    <div class="flex items-center">
                                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-pblue mr-3"></div>
                                        <span class="text-sm text-gray-400">Voertuigen laden...</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Selected Information Display -->
                            <div id="selection-summary" style="display: none;" class="bg-chiffon/10 border border-chiffon/30 rounded-lg p-6">
                                <h3 class="text-lg font-bold text-chiffon mb-4 uppercase tracking-wider flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 21H5V3H13V9H19Z"/>
                                    </svg>
                                    Geselecteerde Informatie
                                </h3>
                                <div id="selected-user-info" class="text-white mb-2"></div>
                                <div id="selected-car-info" class="text-white"></div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Card Footer with Navigation -->
                    <div class="bg-gray-800/50 border-t border-gray-700 p-6">
                        <div class="flex justify-between">
                            <a href="{{ route('service.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                                </svg>
                                Terug naar Service
                            </a>
                            <button type="button" id="nextStepBtn" class="bg-pblue hover:bg-white text-black px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300 disabled:bg-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed" disabled>
                                Volgende Stap
                                <svg class="w-4 h-4 inline ml-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
                    // Get user and car display names
                    const selectedUserText = userSelect.options[userSelect.selectedIndex].text;
                    const selectedCarText = carSelect.options[carSelect.selectedIndex].text;
                    
                    // Extract only the name part (before the email in parentheses)
                    const userName = selectedUserText.split('(')[0].trim();
                    
                    // Store selections in sessionStorage for the multi-step form
                    sessionStorage.setItem('case_user_id', userId);
                    sessionStorage.setItem('case_car_id', carId);
                    sessionStorage.setItem('case_user_name', userName);
                    sessionStorage.setItem('case_car_info', selectedCarText);
                    
                    // Navigate to step 2
                    window.location.href = '{{ route("service.create.step2") }}';
                } else {
                    alert('Selecteer zowel een gebruiker als een voertuig voordat je doorgaat.');
                }
            });
        });
    </script>
@endsection 