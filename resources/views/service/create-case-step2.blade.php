@extends('layouts.app')

@section('title', 'Nieuwe Case - Probleem Beschrijving')

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
                            <div class="bg-pblue h-2 rounded-full transition-all duration-300" style="width: 40%"></div>
                        </div>
                        <div class="flex justify-between text-xs uppercase tracking-wider">
                            <span class="text-pblue font-bold">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z"/>
                                </svg>
                                Stap 1: Gebruiker & Voertuig
                            </span>
                            <span class="text-pblue font-bold">Stap 2: Probleem Beschrijving</span>
                            <span class="text-gray-400">Stap 3: Media Upload</span>
                            <span class="text-gray-400">Stap 4: Offerte Opstellen</span>
                            <span class="text-gray-400">Stap 5: Versturen</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Step 2 Form -->
        <section class="pb-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-9">
                <form method="POST" action="{{ route('service.store.step2') }}" id="step2Form">
                    @csrf
                    
                    <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                        <div class="bg-pblue p-6">
                            <h2 class="text-xl font-bold text-black uppercase tracking-wider flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19,3H5C3.9,3 3,3.9 3,5V19C3,20.1 3.9,21 5,21H19C20.1,21 21,20.1 21,19V5C21,3.9 20.1,3 19,3M19,19H5V5H19V19M17,12H12V17H10V12H7L11.5,7.5L16,12H17Z"/>
                                </svg>
                                Stap 2: Beschrijf het Probleem
                            </h2>
                        </div>
                        <div class="p-8">
                            
                            <!-- Selected Info Summary (from Step 1) -->
                            <div class="bg-chiffon/10 border border-chiffon/30 rounded-lg p-6 mb-8">
                                <h3 class="text-lg font-bold text-chiffon mb-4 uppercase tracking-wider flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 21H5V3H13V9H19Z"/>
                                    </svg>
                                    Geselecteerde Informatie
                                </h3>
                                <div id="step1-summary" class="text-gray-300">
                                    <div id="selected-user-display" class="text-white mb-2"></div>
                                    <div id="selected-car-display" class="text-white"></div>
                                </div>
                            </div>

                            <!-- Client Description Section (Optional) -->
                            <div class="mb-8">
                                <label for="client_description" class="block text-lg font-bold text-white mb-4 uppercase tracking-wider">
                                    <svg class="w-5 h-5 inline mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                    </svg>
                                    Klant Beschrijving
                                    <span class="bg-gray-600 text-gray-200 text-xs px-2 py-1 rounded ml-2">Optioneel</span>
                                </label>
                                <textarea 
                                    class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-4 rounded-lg focus:outline-none focus:border-pblue transition-colors duration-300 @error('client_description') border-red-500 @enderror" 
                                    id="client_description" 
                                    name="client_description" 
                                    rows="4" 
                                    placeholder="Beschrijf hier wat de klant heeft verteld over het probleem of de klachten..."
                                    maxlength="1000">{{ old('client_description') }}</textarea>
                                
                                <div class="mt-2 text-sm text-gray-400">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                                    </svg>
                                    Beschrijf hier de oorspronkelijke klacht of het probleem zoals door de klant beschreven.
                                    <br>
                                    <span class="text-gray-500">Voorbeeld: "Auto maakt raar geluid bij het remmen, vooral bij lage snelheid."</span>
                                </div>
                                <div class="mt-1">
                                    <small class="text-gray-400">
                                        <span id="client-char-count">0</span>/1000 karakters
                                    </small>
                                </div>
                                
                                @error('client_description')
                                    <div class="text-red-400 text-sm mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Divider -->
                            <div class="border-t border-gray-700 my-8"></div>

                            <!-- Mechanic Description Section (Required) -->
                            <div class="mb-8">
                                <label for="mechanic_description" class="block text-lg font-bold text-white mb-4 uppercase tracking-wider">
                                    <svg class="w-5 h-5 inline mr-2 text-pblue" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.57,14.86L22,13.43L20.57,12L17,15.57L8.43,7L12,3.43L10.57,2L9.14,3.43L7.71,2L5.57,4.14L4.14,2.71L2.71,4.14L4.14,5.57L2,7.71L3.43,9.14L4.86,7.71L13.43,16.29L9.86,19.86L11.29,21.29L12.71,19.86L14.14,21.29L16.29,19.14L17.71,20.57L19.14,19.14L17.71,17.71L19.86,15.57L18.43,14.14L20.57,14.86Z"/>
                                    </svg>
                                    Mechaniek Diagnose
                                    <span class="bg-red-600 text-white text-xs px-2 py-1 rounded ml-2">Verplicht</span>
                                </label>
                                <textarea 
                                    class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-4 rounded-lg focus:outline-none focus:border-pblue transition-colors duration-300 @error('mechanic_description') border-red-500 @enderror" 
                                    id="mechanic_description" 
                                    name="mechanic_description" 
                                    rows="6" 
                                    placeholder="Beschrijf hier je professionele diagnose en bevindingen..."
                                    maxlength="2000" 
                                    required>{{ old('mechanic_description') }}</textarea>
                                
                                <div class="mt-2 text-sm text-gray-400">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                                    </svg>
                                    Beschrijf hier je professionele diagnose, wat je hebt gevonden en wat er gedaan moet worden.
                                    <br>
                                    <span class="text-gray-500">Voorbeeld: "Na inspectie blijken de remblokken versleten. Voorste remschijven tonen ook slijtage. Vervanging van remblokken en schijven noodzakelijk voor veiligheid."</span>
                                </div>
                                <div class="mt-1">
                                    <small class="text-gray-400">
                                        <span id="mechanic-char-count">0</span>/2000 karakters (minimaal 10 karakters)
                                    </small>
                                </div>
                                
                                @error('mechanic_description')
                                    <div class="text-red-400 text-sm mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        
                        <!-- Card Footer with Navigation -->
                        <div class="bg-gray-800/50 border-t border-gray-700 p-6">
                            <div class="flex justify-between">
                                <a href="{{ route('service.create') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                                    </svg>
                                    Vorige Stap
                                </a>
                                <button type="submit" id="nextStepBtn" class="bg-pblue hover:bg-white text-black px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300 disabled:bg-gray-600 disabled:text-gray-400 disabled:cursor-not-allowed" disabled>
                                    Volgende Stap
                                    <svg class="w-4 h-4 inline ml-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

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
            const userName = sessionStorage.getItem('case_user_name');
            const carInfo = sessionStorage.getItem('case_car_info');
            
            if (!userId || !carId) {
                alert('Sessie gegevens ontbreken. Je wordt terug gestuurd naar stap 1.');
                window.location.href = '{{ route("service.create") }}';
                return;
            }

            // Display step 1 summary with names instead of IDs
            const displayUserName = userName || `Gebruiker ID: ${userId}`;
            const displayCarInfo = carInfo || `Voertuig ID: ${carId}`;
            
            document.getElementById('selected-user-display').innerHTML = `<strong>Gebruiker:</strong> ${displayUserName}`;
            document.getElementById('selected-car-display').innerHTML = `<strong>Voertuig:</strong> ${displayCarInfo}`;

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