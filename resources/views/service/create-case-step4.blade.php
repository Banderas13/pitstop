@extends('layouts.app')

@section('title', 'Nieuwe Case - Offerte Opstellen')

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
                            <div class="bg-pblue h-2 rounded-full transition-all duration-300" style="width: 80%"></div>
                        </div>
                        <div class="flex justify-between text-xs uppercase tracking-wider">
                            <span class="text-pblue font-bold">
                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Stap 1: Gebruiker & Voertuig
                            </span>
                            <span class="text-pblue font-bold">
                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Stap 2: Probleem Beschrijving
                            </span>
                            <span class="text-pblue font-bold">
                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Stap 3: Media Upload
                            </span>
                            <span class="text-pblue font-bold">Stap 4: Offerte Opstellen</span>
                            <span class="text-gray-400">Stap 5: Versturen</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Step 4 Form -->
        <section class="pb-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-9">
                <!-- VAT Toggle Card -->
                <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden mb-8">
                    <div class="p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold text-white mb-1 uppercase tracking-wider flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-chiffon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z"/>
                                    </svg>
                                    BTW Berekening
                                </h3>
                                <p class="text-gray-400 text-sm">BTW tarief: 21%</p>
                            </div>
                            <div class="flex items-center">
                                <input class="sr-only" type="checkbox" id="vatToggle" checked>
                                <label for="vatToggle" class="relative flex items-center cursor-pointer">
                                    <div class="w-12 h-6 bg-pblue rounded-full shadow-inner transition-all duration-300" id="toggleBg"></div>
                                    <div class="absolute w-4 h-4 bg-white rounded-full shadow transition-all duration-300 translate-x-6" id="toggleButton"></div>
                                </label>
                                <span class="ml-3 text-white font-bold uppercase tracking-wider text-sm" id="vatLabel">
                                    Prijzen Exclusief BTW
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Option Selection -->
                <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden mb-8">
                    <div class="bg-pblue p-6">
                        <h2 class="text-xl font-bold text-black uppercase tracking-wider flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                            Kies Offerte Methode
                        </h2>
                    </div>
                    <div class="p-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden cursor-pointer transition-all duration-300 hover:border-pblue hover:bg-gray-700/50" id="manualOption">
                                <div class="p-8 text-center">
                                    <svg class="w-16 h-16 mx-auto text-pblue mb-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                    </svg>
                                    <h3 class="text-lg font-bold text-white mb-2 uppercase tracking-wider">Handmatige Offerte</h3>
                                    <p class="text-gray-400 text-sm mb-4">Voer onderdelen en arbeid handmatig in</p>
                                    <button type="button" class="bg-pblue hover:bg-white text-black px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" onclick="selectOption('manual')">
                                        Selecteren
                                    </button>
                                </div>
                            </div>
                            <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden cursor-pointer transition-all duration-300 hover:border-pblue hover:bg-gray-700/50" id="uploadOption">
                                <div class="p-8 text-center">
                                    <svg class="w-16 h-16 mx-auto text-pblue mb-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                    <h3 class="text-lg font-bold text-white mb-2 uppercase tracking-wider">Upload Externe Offerte</h3>
                                    <p class="text-gray-400 text-sm mb-4">Upload een bestaand offerte bestand</p>
                                    <button type="button" class="bg-pblue hover:bg-white text-black px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" onclick="selectOption('upload')">
                                        Selecteren
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manual Offer Form -->
                <div id="manualForm" style="display: none;">
                    <form method="POST" action="{{ route('service.store.step4') }}" id="step4Form">
                        @csrf
                        <input type="hidden" name="offer_type" value="manual">
                        <input type="hidden" name="user_id" id="manual_user_id">
                        <input type="hidden" name="car_id" id="manual_car_id">
                        <input type="hidden" name="vat_enabled" id="manual_vat_enabled" value="1">
                        
                        <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                            <div class="bg-caribbean p-6">
                                <h2 class="text-xl font-bold text-white uppercase tracking-wider flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.35 19.43,11.03L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.22,8.95 2.27,9.22 2.46,9.37L4.57,11.03C4.53,11.35 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.22,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.68 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"/>
                                    </svg>
                                    Onderdelen en Arbeid
                                </h2>
                            </div>
                            <div class="p-10">
                                
                                <!-- Selected Info Summary (from Previous Steps) -->
                                <div class="bg-chiffon/10 border border-chiffon/30 rounded-lg p-8 mb-10">
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

                                <!-- Parts Section -->
                                <div class="mb-10">
                                    <div class="flex justify-between items-center mb-8">
                                        <h3 class="text-lg font-bold text-white uppercase tracking-wider flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-chiffon" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M3,3H9L12,9L9,15H3V3M5,5V7H7V5H5M5,9V11H7V9H5M5,13V15H7V13H5M11,3H17L20,9L17,15H11L14,9L11,3M13,5V7H15V5H13M13,9V11H15V9H13M13,13V15H15V13H13Z"/>
                                            </svg>
                                            Onderdelen
                                        </h3>
                                        <button type="button" class="bg-pblue hover:bg-white text-black px-4 py-2 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" onclick="addItem('parts')">
                                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                                            </svg>
                                            Onderdeel Toevoegen
                                        </button>
                                    </div>
                                    <div id="parts-container"></div>
                                </div>

                                <!-- Labour Section -->
                                <div class="mb-10">
                                    <div class="flex justify-between items-center mb-8">
                                        <h3 class="text-lg font-bold text-white uppercase tracking-wider flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-chiffon" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M21.71,9.29L16.5,4.08C16.1,3.68 15.55,3.47 15,3.47H9A4,4 0 0,0 5,7.47V16.53A4,4 0 0,0 9,20.53H15C15.55,20.53 16.1,20.32 16.5,19.92L21.71,14.71C22.1,14.32 22.1,13.68 21.71,13.29L21.71,9.29M9,5.47H15L20,10.47L15,15.47H9A2,2 0 0,1 7,13.47V7.47A2,2 0 0,1 9,5.47M10,7.47V9.47H12V11.47H10V13.47H8V11.47H6V9.47H8V7.47H10Z"/>
                                            </svg>
                                            Arbeid
                                        </h3>
                                        <button type="button" class="bg-pblue hover:bg-white text-black px-4 py-2 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" onclick="addItem('labour')">
                                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                                            </svg>
                                            Arbeid Toevoegen
                                        </button>
                                    </div>
                                    <div id="labour-container"></div>
                                </div>

                                <!-- Total Section -->
                                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h4 class="text-white font-bold mb-2">Subtotaal:</h4>
                                            <h4 class="text-white font-bold mb-2" id="vatSection" style="display: none;">BTW (21%):</h4>
                                            <h3 class="text-xl font-bold text-pblue">Totaal:</h3>
                                        </div>
                                        <div class="text-right">
                                            <h4 class="text-white font-bold mb-2">€<span id="subtotal">0.00</span></h4>
                                            <h4 class="text-white font-bold mb-2" id="vatAmount" style="display: none;">€<span id="vatValue">0.00</span></h4>
                                            <h3 class="text-xl font-bold text-pblue">€<span id="total">0.00</span></h3>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <!-- Manual Form Footer -->
                            <div class="bg-gray-800/50 border-t border-gray-700 p-6">
                                <div class="flex justify-between">
                                    <a href="{{ route('service.create.step3') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
                                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                                        </svg>
                                        Vorige Stap
                                    </a>
                                    <div class="flex space-x-3">
                                        <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" onclick="resetForm()">
                                            Reset
                                        </button>
                                        <button type="submit" id="nextStepBtn" class="bg-pblue hover:bg-white text-black px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none" disabled>
                                            Offerte Genereren
                                            <svg class="w-4 h-4 inline ml-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Upload Form -->
                <div id="uploadForm" style="display: none;">
                    <form method="POST" action="{{ route('service.store.step4') }}" enctype="multipart/form-data" id="uploadOfferForm">
                        @csrf
                        <input type="hidden" name="offer_type" value="upload">
                        <input type="hidden" name="user_id" id="upload_user_id">
                        <input type="hidden" name="car_id" id="upload_car_id">
                        
                        <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                            <div class="bg-caribbean p-6">
                                <h2 class="text-xl font-bold text-white uppercase tracking-wider flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                    Upload Externe Offerte
                                </h2>
                            </div>
                            <div class="p-10">
                                
                                                <!-- Upload Area -->
                <div class="border-2 border-dashed border-gray-600 rounded-lg p-10 text-center @error('offer_file') border-red-500 @enderror cursor-pointer transition-all duration-300 hover:border-pblue hover:bg-gray-800/30" 
                     id="offer-upload-area" 
                     ondrop="handleOfferDrop(event)" 
                     ondragover="handleDragOver(event)" 
                     ondragleave="handleDragLeave(event)">
                                    <div class="upload-content">
                                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                        </svg>
                                        <h3 class="text-white text-lg font-medium mb-2">Sleep offerte bestand hierheen of klik om te selecteren</h3>
                                        <p class="text-gray-400 text-sm mb-4">
                                            Ondersteunde formaten: PDF, DOC, DOCX<br>
                                            Maximale bestandsgrootte: 10MB
                                        </p>
                                        <input type="file" 
                                               class="hidden @error('offer_file') is-invalid @enderror" 
                                               id="offer_file" 
                                               name="offer_file" 
                                               accept=".pdf,.doc,.docx"
                                               onchange="handleOfferFileSelect(event)">
                                        <button type="button" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" onclick="document.getElementById('offer_file').click()">
                                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M10,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V8C22,6.89 21.1,6 20,6H12L10,4Z"/>
                                            </svg>
                                            Selecteer Offerte Bestand
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- File Preview -->
                                <div id="offer-preview" class="mt-6" style="display: none;">
                                    <div class="bg-green-900/20 border border-green-700 rounded-lg p-6">
                                        <h4 class="text-lg font-bold text-green-300 mb-4 uppercase tracking-wider flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                            </svg>
                                            Bestand Geselecteerd
                                        </h4>
                                        <p class="text-gray-300 mb-4" id="selected-file-info"></p>
                                        <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm transition-colors duration-300" onclick="clearOfferFile()">
                                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z"/>
                                            </svg>
                                            Verwijderen
                                        </button>
                                    </div>
                                </div>

                                <!-- Price Input for Upload -->
                                <div class="mt-10">
                                    <label for="upload_price" class="block text-lg font-bold text-white mb-4 uppercase tracking-wider">
                                        <svg class="w-5 h-5 inline mr-2 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"/>
                                        </svg>
                                        Offerte Prijs
                                        <span class="bg-red-600 text-white px-2 py-1 rounded text-xs ml-2">Verplicht</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">€</span>
                                        <input type="number" 
                                               class="w-full bg-gray-800 border border-gray-700 rounded-lg pl-8 pr-4 py-3 text-white placeholder-gray-400 focus:border-pblue focus:ring-pblue focus:ring-1 transition-colors duration-300 @error('upload_price') border-red-500 @enderror" 
                                               id="upload_price" 
                                               name="upload_price" 
                                               step="0.01" 
                                               min="0" 
                                               placeholder="0.00"
                                               onchange="validateUploadForm()">
                                    </div>
                                    <p class="text-gray-400 text-sm mt-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                                        </svg>
                                        Voer de totaalprijs van de geüploade offerte in
                                    </p>
                                    @error('upload_price')
                                        <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                @error('offer_file')
                                    <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Upload Form Footer -->
                            <div class="bg-gray-800/50 border-t border-gray-700 p-6">
                                <div class="flex justify-between">
                                    <a href="{{ route('service.create.step3') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
                                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                                        </svg>
                                        Vorige Stap
                                    </a>
                                    <button type="submit" id="uploadNextStepBtn" class="bg-pblue hover:bg-white text-black px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none" disabled>
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

            </div>
        </section>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load session data
            const userId = sessionStorage.getItem('case_user_id');
            const carId = sessionStorage.getItem('case_car_id');
            
            if (!userId || !carId) {
                alert('Sessie gegevens ontbreken. Je wordt terug gestuurd naar stap 1.');
                window.location.href = '{{ route("service.create") }}';
                return;
            }

            // Store uploaded media information from server session
            @if(session('uploaded_media'))
                const uploadedMedia = @json(session('uploaded_media'));
                sessionStorage.setItem('case_media', JSON.stringify(uploadedMedia));
            @endif

            // Display step 1 summary with names instead of IDs
            const userName = sessionStorage.getItem('case_user_name');
            const carInfo = sessionStorage.getItem('case_car_info');
            const displayUserName = userName || `Gebruiker ID: ${userId}`;
            const displayCarInfo = carInfo || `Voertuig ID: ${carId}`;
            
            document.getElementById('selected-user-display').innerHTML = `<strong>Gebruiker:</strong> ${displayUserName}`;
            document.getElementById('selected-car-display').innerHTML = `<strong>Voertuig:</strong> ${displayCarInfo}`;
            
            // Populate hidden inputs
            document.getElementById('manual_user_id').value = userId;
            document.getElementById('manual_car_id').value = carId;
            document.getElementById('upload_user_id').value = userId;
            document.getElementById('upload_car_id').value = carId;
        });

        // Global variables
        let currentOption = null;
        let itemCounter = 0;
        let vatEnabled = true;
        const VAT_RATE = 0.21;

        // Option selection
        function selectOption(option) {
            currentOption = option;
            
            // Reset selection visuals
            document.querySelectorAll('#manualOption, #uploadOption').forEach(card => {
                card.classList.remove('border-pblue', 'shadow-lg', 'shadow-pblue/25', 'bg-gray-700/80');
                card.classList.add('border-gray-700');
            });
            
            // Hide all forms
            document.getElementById('manualForm').style.display = 'none';
            document.getElementById('uploadForm').style.display = 'none';
            
            if (option === 'manual') {
                const manualOption = document.getElementById('manualOption');
                manualOption.classList.remove('border-gray-700');
                manualOption.classList.add('border-pblue', 'shadow-lg', 'shadow-pblue/25', 'bg-gray-700/80');
                document.getElementById('manualForm').style.display = 'block';
                
                // Only add initial rows if containers are empty
                const partsContainer = document.getElementById('parts-container');
                const labourContainer = document.getElementById('labour-container');
                
                if (partsContainer.children.length === 0) {
                    addItem('parts'); // Add initial part row
                }
                if (labourContainer.children.length === 0) {
                    addItem('labour'); // Add initial labour row
                }
            } else if (option === 'upload') {
                const uploadOption = document.getElementById('uploadOption');
                uploadOption.classList.remove('border-gray-700');
                uploadOption.classList.add('border-pblue', 'shadow-lg', 'shadow-pblue/25', 'bg-gray-700/80');
                document.getElementById('uploadForm').style.display = 'block';
            }
        }

        // VAT Toggle
        document.getElementById('vatToggle').addEventListener('change', function() {
            vatEnabled = this.checked;
            const label = document.getElementById('vatLabel');
            const vatSection = document.getElementById('vatSection');
            const vatAmount = document.getElementById('vatAmount');
            const toggleBg = document.getElementById('toggleBg');
            const toggleButton = document.getElementById('toggleButton');
            
            if (vatEnabled) {
                label.textContent = 'Prijzen Exclusief BTW';
                vatSection.style.display = 'block';
                vatAmount.style.display = 'block';
                toggleBg.classList.remove('bg-gray-600');
                toggleBg.classList.add('bg-pblue');
                toggleButton.classList.remove('translate-x-1');
                toggleButton.classList.add('translate-x-6');
            } else {
                label.textContent = 'Prijzen Inclusief BTW';
                vatSection.style.display = 'none';
                vatAmount.style.display = 'none';
                toggleBg.classList.remove('bg-pblue');
                toggleBg.classList.add('bg-gray-600');
                toggleButton.classList.remove('translate-x-6');
                toggleButton.classList.add('translate-x-1');
            }
            
            // Update hidden input
            document.getElementById('manual_vat_enabled').value = vatEnabled ? '1' : '0';
            
            calculateTotal();
        });

        // Add item (parts or labour)
        function addItem(type) {
            itemCounter++;
            const container = document.getElementById(type + '-container');
            const iconPath = type === 'parts' 
                ? 'M3,3H9L12,9L9,15H3V3M5,5V7H7V5H5M5,9V11H7V9H5M5,13V15H7V13H5M11,3H17L20,9L17,15H11L14,9L11,3M13,5V7H15V5H13M13,9V11H15V9H13M13,13V15H15V13H13Z'
                : 'M21.71,9.29L16.5,4.08C16.1,3.68 15.55,3.47 15,3.47H9A4,4 0 0,0 5,7.47V16.53A4,4 0 0,0 9,20.53H15C15.55,20.53 16.1,20.32 16.5,19.92L21.71,14.71C22.1,14.32 22.1,13.68 21.71,13.29L21.71,9.29M9,5.47H15L20,10.47L15,15.47H9A2,2 0 0,1 7,13.47V7.47A2,2 0 0,1 9,5.47M10,7.47V9.47H12V11.47H10V13.47H8V11.47H6V9.47H8V7.47H10Z';
            const placeholder = type === 'parts' ? 'Onderdeel naam...' : 'Arbeid beschrijving...';
            
            const itemHtml = `
                <div class="bg-gray-700 border border-gray-600 rounded-lg p-5 mb-4" id="${type}-${itemCounter}">
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-6 items-end">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-white mb-2 uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-2 text-chiffon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="${iconPath}"/>
                                </svg>
                                ${type === 'parts' ? 'Onderdeel' : 'Arbeid'}
                            </label>
                            <input type="text" 
                                   class="w-full bg-gray-800 border border-gray-600 rounded-md px-3 py-3 text-white placeholder-gray-400 focus:border-pblue focus:ring-pblue focus:ring-1 transition-colors duration-300" 
                                   name="${type}[${itemCounter}][name]" 
                                   placeholder="${placeholder}">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-white mb-2 uppercase tracking-wider">Aantal</label>
                            <input type="number" 
                                   class="w-full bg-gray-800 border border-gray-600 rounded-md px-3 py-3 text-white placeholder-gray-400 focus:border-pblue focus:ring-pblue focus:ring-1 transition-colors duration-300 quantity-input" 
                                   name="${type}[${itemCounter}][quantity]" 
                                   value="1" 
                                   min="1" 
                                   step="1"
                                   onchange="calculateTotal()">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-white mb-2 uppercase tracking-wider">Prijs per eenheid</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">€</span>
                                <input type="number" 
                                       class="w-full bg-gray-800 border border-gray-600 rounded-md pl-11 pr-3 py-3 text-white placeholder-gray-400 focus:border-pblue focus:ring-pblue focus:ring-1 transition-colors duration-300 price-input" 
                                       name="${type}[${itemCounter}][price]" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="0.00"
                                       onchange="calculateTotal()">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-white mb-2 uppercase tracking-wider">Totaal</label>
                            <div class="text-lg font-bold text-green-400" id="item-total-${itemCounter}">€0.00</div>
                        </div>
                        <div class="flex justify-center">
                            <button type="button" class="bg-red-600 text-white border-0 rounded-full w-8 h-8 flex items-center justify-center cursor-pointer text-lg font-bold transition-all duration-300 hover:bg-red-800 hover:scale-110" onclick="removeItem('${type}-${itemCounter}')">
                                ×
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', itemHtml);
            validateManualForm();
        }

        // Remove item
        function removeItem(itemId) {
            document.getElementById(itemId).remove();
            calculateTotal();
            validateManualForm();
        }

        // Calculate total
        function calculateTotal() {
            let subtotal = 0;
            
            // Calculate all item totals
            document.querySelectorAll('#parts-container > div, #labour-container > div').forEach(row => {
                const quantityInput = row.querySelector('.quantity-input');
                const priceInput = row.querySelector('.price-input');
                const totalElement = row.querySelector('[id^="item-total-"]');
                
                if (quantityInput && priceInput && totalElement) {
                    const quantity = parseFloat(quantityInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;
                    const itemTotal = quantity * price;
                    
                    totalElement.textContent = '€' + itemTotal.toFixed(2);
                    subtotal += itemTotal;
                }
            });
            
            // Update totals
            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            
            let finalTotal;
            if (vatEnabled) {
                // Prices are excluding VAT
                const vatAmount = subtotal * VAT_RATE;
                document.getElementById('vatValue').textContent = vatAmount.toFixed(2);
                finalTotal = subtotal + vatAmount;
            } else {
                // Prices are including VAT
                finalTotal = subtotal;
            }
            
            document.getElementById('total').textContent = finalTotal.toFixed(2);
        }

        // Validate manual form
        function validateManualForm() {
            // Check if there's at least one valid part
            const partRows = document.querySelectorAll('#parts-container > div');
            const hasValidParts = Array.from(partRows).some(row => {
                const nameInput = row.querySelector('input[name*="[name]"]');
                const quantityInput = row.querySelector('.quantity-input');
                const priceInput = row.querySelector('.price-input');
                
                return nameInput && nameInput.value.trim() && 
                       quantityInput && quantityInput.value && 
                       priceInput && priceInput.value;
            });

            // Check if there's at least one valid labour item
            const labourRows = document.querySelectorAll('#labour-container > div');
            const hasValidLabour = Array.from(labourRows).some(row => {
                const nameInput = row.querySelector('input[name*="[name]"]');
                const quantityInput = row.querySelector('.quantity-input');
                const priceInput = row.querySelector('.price-input');
                
                return nameInput && nameInput.value.trim() && 
                       quantityInput && quantityInput.value && 
                       priceInput && priceInput.value;
            });
            
            // Enable button if there's at least one valid part OR one valid labour item
            const hasAtLeastOneValidItem = hasValidParts || hasValidLabour;
            document.getElementById('nextStepBtn').disabled = !hasAtLeastOneValidItem;
        }

        // Reset form
        function resetForm() {
            document.getElementById('parts-container').innerHTML = '';
            document.getElementById('labour-container').innerHTML = '';
            itemCounter = 0;
            addItem('parts');
            addItem('labour');
            calculateTotal();
        }

        // Upload form functions
        function handleDragOver(e) {
            e.preventDefault();
            e.currentTarget.classList.add('bg-blue-900/10', 'border-blue-500');
            e.currentTarget.classList.remove('border-gray-600');
        }

        function handleDragLeave(e) {
            e.preventDefault();
            e.currentTarget.classList.remove('bg-blue-900/10', 'border-blue-500');
            e.currentTarget.classList.add('border-gray-600');
        }

        function handleOfferDrop(e) {
            e.preventDefault();
            e.currentTarget.classList.remove('bg-blue-900/10', 'border-blue-500');
            e.currentTarget.classList.add('border-gray-600');
            
            const files = Array.from(e.dataTransfer.files);
            if (files.length > 0) {
                processOfferFile(files[0]);
            }
        }

        function handleOfferFileSelect(e) {
            if (e.target.files.length > 0) {
                processOfferFile(e.target.files[0]);
            }
        }

        function processOfferFile(file) {
            const validTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            const maxSize = 10 * 1024 * 1024; // 10MB
            
            if (!validTypes.includes(file.type)) {
                alert('Alleen PDF, DOC en DOCX bestanden zijn toegestaan.');
                return;
            }
            
            if (file.size > maxSize) {
                alert('Bestand is te groot (max 10MB).');
                return;
            }
            
            // Show file info
            const fileInfo = `
                <strong>Bestand:</strong> ${file.name}<br>
                <strong>Grootte:</strong> ${(file.size / 1024 / 1024).toFixed(2)} MB<br>
                <strong>Type:</strong> ${file.type.split('/').pop().toUpperCase()}
            `;
            
            document.getElementById('selected-file-info').innerHTML = fileInfo;
            document.getElementById('offer-preview').style.display = 'block';
            
            validateUploadForm();
        }

        function clearOfferFile() {
            document.getElementById('offer_file').value = '';
            document.getElementById('offer-preview').style.display = 'none';
            validateUploadForm();
        }

        function validateUploadForm() {
            const fileInput = document.getElementById('offer_file');
            const priceInput = document.getElementById('upload_price');
            const hasFile = fileInput.files.length > 0;
            const hasPrice = priceInput.value && parseFloat(priceInput.value) > 0;
            
            document.getElementById('uploadNextStepBtn').disabled = !(hasFile && hasPrice);
        }

        // Form submission listeners
        document.getElementById('step4Form').addEventListener('submit', function(e) {

            // Store offer items data for step 5 preview
            const offerItems = [];
            let subtotal = 0;

            document.querySelectorAll('#parts-container > div, #labour-container > div').forEach(row => {
                const nameInput = row.querySelector('input[name*="[name]"]');
                const quantityInput = row.querySelector('.quantity-input');
                const priceInput = row.querySelector('.price-input');
                
                if (nameInput && nameInput.value.trim() && quantityInput && quantityInput.value && priceInput && priceInput.value) {
                    const quantity = parseFloat(quantityInput.value);
                    const price = parseFloat(priceInput.value);
                    const total = quantity * price;
                    
                    // Determine type from input name
                    const type = nameInput.name.includes('parts') ? 'part' : 'labour';
                    
                    offerItems.push({
                        description: nameInput.value.trim(),
                        type: type,
                        quantity: quantity,
                        price: price,
                        total: total
                    });
                    
                    subtotal += total;
                }
            });

            // Calculate VAT
            let vatAmount = 0;
            let finalTotal = subtotal;
            
            if (vatEnabled) {
                vatAmount = subtotal * VAT_RATE;
                finalTotal = subtotal + vatAmount;
            }

            // Store offer data in sessionStorage
            const offerData = {
                type: 'manual',
                items: offerItems,
                vat_enabled: vatEnabled,
                subtotal: subtotal,
                vat_amount: vatAmount,
                total: finalTotal
            };
            
            sessionStorage.setItem('case_offer_data', JSON.stringify(offerData));
        });

        // Upload form submission listener
        document.getElementById('uploadOfferForm').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('offer_file');
            const priceInput = document.getElementById('upload_price');
            
            if (!fileInput.files.length || !priceInput.value) {
                e.preventDefault();
                alert('Selecteer een bestand en voer een prijs in.');
                return;
            }

            // Store upload offer data for step 5 preview
            const offerData = {
                type: 'upload',
                filename: fileInput.files[0].name,
                price: parseFloat(priceInput.value),
                total: parseFloat(priceInput.value)
            };
            
            sessionStorage.setItem('case_offer_data', JSON.stringify(offerData));
        });



        // Add event listeners to form inputs
        document.addEventListener('input', function(e) {
            if (e.target.matches('.quantity-input, .price-input')) {
                calculateTotal();
                validateManualForm();
            }
            if (e.target.matches('input[name*="[name]"]')) {
                validateManualForm();
            }
            if (e.target.id === 'upload_price') {
                validateUploadForm();
            }
        });
    </script>
@endsection 