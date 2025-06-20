@extends('layouts.app')

@section('title', 'Nieuwe Case - Versturen')

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
                            <div class="bg-pblue h-2 rounded-full transition-all duration-300" style="width: 100%"></div>
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
                            <span class="text-pblue font-bold">
                                <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                                Stap 4: Offerte Opstellen
                            </span>
                            <span class="text-pblue font-bold">Stap 5: Versturen</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Step 5 Content -->
        <section class="pb-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-9">
                
                <!-- Overview Card -->
                <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden mb-8">
                    <div class="bg-pblue p-6">
                        <h2 class="text-xl font-bold text-black uppercase tracking-wider flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/>
                            </svg>
                            Case Overzicht
                        </h2>
                    </div>
                    <div class="p-8">
                        
                        <!-- Step 1: User & Vehicle -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-chiffon mb-4 uppercase tracking-wider flex items-center border-b border-gray-700 pb-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                </svg>
                                Stap 1: Gebruiker & Voertuig
                            </h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-4">
                                    <h4 class="text-pblue font-bold mb-3 uppercase tracking-wider text-lg">Gebruiker</h4>
                                    <div id="user-overview-info" class="text-gray-300 text-base">
                                        <div class="animate-pulse">
                                            <div class="h-4 bg-gray-600 rounded mb-2 w-3/4"></div>
                                            <div class="h-4 bg-gray-600 rounded w-1/2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-4">
                                    <h4 class="text-pblue font-bold mb-3 uppercase tracking-wider text-lg">Voertuig</h4>
                                    <div id="car-overview-info" class="text-gray-300 text-base">
                                        <div class="animate-pulse">
                                            <div class="h-4 bg-gray-600 rounded mb-2 w-2/3"></div>
                                            <div class="h-4 bg-gray-600 rounded w-1/3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Description -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-chiffon mb-4 uppercase tracking-wider flex items-center border-b border-gray-700 pb-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9,5V9H21V7.5L16,12L21,16.5V15H9V19H7V5H9M5,5V19H3V5H5Z"/>
                                </svg>
                                Stap 2: Probleem Beschrijving
                            </h3>
                            <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-4">
                                <div id="description-overview" class="text-gray-300 text-lg">
                                    <div class="animate-pulse">
                                        <div class="h-4 bg-gray-600 rounded mb-2 w-full"></div>
                                        <div class="h-4 bg-gray-600 rounded mb-2 w-2/3"></div>
                                        <div class="h-4 bg-gray-600 rounded w-4/5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Media -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-chiffon mb-4 uppercase tracking-wider flex items-center border-b border-gray-700 pb-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4,4H7L9,2H15L17,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4M12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17A5,5 0 0,0 17,12A5,5 0 0,0 12,7M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9Z"/>
                                </svg>
                                Stap 3: Media Upload
                            </h3>
                            <div id="media-overview" class="text-gray-400 text-base mb-4">
                                <svg class="w-4 h-4 inline mr-2 animate-spin" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z"/>
                                </svg>
                                Media informatie laden...
                            </div>
                            
                            <!-- Media Preview Section -->
                            <div id="media-preview" class="mt-4" style="display: none;">
                                <div id="photos-preview" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-4"></div>
                                <div id="videos-preview" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
                            </div>
                            
                            <div class="mt-4">
                                <div class="text-pblue text-base">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                    </svg>
                                    <strong>Media upload voltooid</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Offer -->
                        <div class="mb-0">
                            <h3 class="text-xl font-bold text-chiffon mb-4 uppercase tracking-wider flex items-center border-b border-gray-700 pb-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                </svg>
                                Stap 4: Offerte
                            </h3>
                            
                            <!-- Offer Items Details -->
                            <div id="offer-items" class="mb-4" style="display: none;">
                                <div class="bg-gray-800/50 border border-gray-700 rounded-lg overflow-hidden">
                                    <table class="w-full text-xl">
                                        <thead class="bg-gray-700">
                                            <tr>
                                                <th class="text-left p-3 text-gray-300 ">Beschrijving</th>
                                                <th class="text-left p-3 text-gray-300 ">Type</th>
                                                <th class="text-right p-3 text-gray-300 ">Prijs</th>
                                            </tr>
                                        </thead>
                                        <tbody id="offer-items-body" class="text-gray-300">
                                            <!-- Items will be loaded here -->
                                        </tbody>
                                        <tfoot class="bg-gray-750 border-t border-gray-600">
                                            <tr id="subtotal-row" style="display: none;">
                                                <td colspan="2" class="p-3 font-bold text-white">Subtotaal</td>
                                                <td class="text-right p-3 font-bold text-white" id="subtotal-amount">€0,00</td>
                                            </tr>
                                            <tr id="vat-row" style="display: none;">
                                                <td colspan="2" class="p-3 font-bold text-white">BTW (21%)</td>
                                                <td class="text-right p-3 font-bold text-white" id="vat-amount">€0,00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="p-3 font-bold text-white">Totaal</td>
                                                <td class="text-right p-3 font-bold text-white" id="total-amount">€0,00</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                            <div id="offer-overview" class="text-gray-400 text-base mb-4">
                                <svg class="w-4 h-4 inline mr-2 animate-spin" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z"/>
                                </svg>
                                Offerte informatie laden...
                            </div>
                            
                            <div class="mt-4">
                                <div class="text-pblue text-base">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                    </svg>
                                    <strong>Offerte opgesteld</strong>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Action Card -->
                <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                    <div class="bg-caribbean p-6">
                        <h2 class="text-xl font-bold text-white uppercase tracking-wider flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"/>
                            </svg>
                            Case Versturen
                        </h2>
                    </div>
                    <div class="p-8">
                        
                        <div class="bg-blue-900/20 border border-blue-700 rounded-lg p-6 mb-6">
                            <h4 class="text-xl font-bold text-blue-300 mb-4 uppercase tracking-wider flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                                </svg>
                                Klaar om te versturen
                            </h4>
                            <p class="text-gray-300 text-base mb-0">
                                Controleer bovenstaande informatie en klik op "Verstuur naar Klant" om de case op te slaan en te versturen.
                                De offerte wordt automatisch als PDF bijgevoegd.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('service.store.step5') }}" id="finalSubmissionForm">
                            @csrf
                            <input type="hidden" name="user_id" id="final_user_id">
                            <input type="hidden" name="car_id" id="final_car_id">
                            
                            <div class="mb-6">
                                <h4 class="text-white font-bold mb-2 uppercase tracking-wider text-base">Let op:</h4>
                                <p class="text-gray-400 text-base">
                                    Na het versturen wordt de case opgeslagen en kun je deze terugvinden op de service pagina.
                                </p>
                            </div>
                            
                            <!-- Card Footer with Navigation -->
                            <div class="bg-gray-800/50 border-t border-gray-700 p-6 -m-8 mt-6">
                                <div class="flex justify-between">
                                    <a href="{{ route('service.create.step4') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
                                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                                        </svg>
                                        Vorige Stap
                                    </a>
                                    <button type="submit" class="bg-pblue hover:bg-white text-black px-8 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" id="sendToClientBtn">
                                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"/>
                                        </svg>
                                        Verstuur naar Klant
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </section>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get session storage data
            const userId = sessionStorage.getItem('case_user_id');
            const carId = sessionStorage.getItem('case_car_id');
            
            if (!userId || !carId) {
                alert('Sessie gegevens ontbreken. Je wordt terug gestuurd naar stap 1.');
                window.location.href = '{{ route("service.create") }}';
                return;
            }

            // Set hidden form inputs
            document.getElementById('final_user_id').value = userId;
            document.getElementById('final_car_id').value = carId;

            // Load and display overview data
            loadOverviewData(userId, carId);
        });

        async function loadOverviewData(userId, carId) {
            try {
                // Load user and car data
                const userResponse = await fetch(`{{ route('service.get-user-data') }}?user_id=${userId}`);
                const carResponse = await fetch(`{{ route('service.get-car-data') }}?car_id=${carId}`);
                
                if (userResponse.ok && carResponse.ok) {
                    const userData = await userResponse.json();
                    const carData = await carResponse.json();
                    
                    displayUserInfo(userData);
                    displayCarInfo(carData);
                }

                // Display session data
                displayDescriptionInfo();
                displayMediaInfo();
                displayOfferInfo();
                
            } catch (error) {
                console.error('Error loading overview data:', error);
                showError('Er is een fout opgetreden bij het laden van de case gegevens.');
            }
        }

        function displayUserInfo(userData) {
            const userInfo = document.getElementById('user-overview-info');
            userInfo.innerHTML = `
                <div class="mb-1"><strong class="text-white">Naam:</strong> <span class="text-gray-300">${userData.name}</span></div>
                <div class="mb-1"><strong class="text-white">Email:</strong> <span class="text-gray-300">${userData.email}</span></div>
                ${userData.telephone ? `<div class="mb-1"><strong class="text-white">Telefoon:</strong> <span class="text-gray-300">${userData.telephone}</span></div>` : ''}
                ${userData.vat ? `<div><strong class="text-white">BTW:</strong> <span class="text-gray-300">${userData.vat}</span></div>` : ''}
            `;
        }

        function displayCarInfo(carData) {
            const carInfo = document.getElementById('car-overview-info');
            carInfo.innerHTML = `
                <div class="mb-1"><strong class="text-white">Merk:</strong> <span class="text-gray-300">${carData.brand}</span></div>
                <div class="mb-1"><strong class="text-white">Model:</strong> <span class="text-gray-300">${carData.model}</span></div>
                <div class="mb-1"><strong class="text-white">Kenteken:</strong> <span class="text-gray-300">${carData.numberplate}</span></div>
                ${carData.year ? `<div class="mb-1"><strong class="text-white">Jaar:</strong> <span class="text-gray-300">${carData.year}</span></div>` : ''}
                ${carData.fuel ? `<div><strong class="text-white">Brandstof:</strong> <span class="text-gray-300">${carData.fuel}</span></div>` : ''}
            `;
        }

        function displayDescriptionInfo() {
            const descriptionDiv = document.getElementById('description-overview');
            descriptionDiv.innerHTML = `
                <div class="text-pblue">
                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    <strong>Probleem beschrijving opgeslagen</strong>
                </div>
                <p class="text-gray-400 text-xs mt-1">
                    Mechaniek diagnose en eventuele klant beschrijving zijn opgeslagen voor deze case.
                </p>
            `;
        }

        function displayMediaInfo() {
            const mediaDiv = document.getElementById('media-overview');
            const mediaPreview = document.getElementById('media-preview');
            const photosPreview = document.getElementById('photos-preview');
            const videosPreview = document.getElementById('videos-preview');
            
            // Get media from sessionStorage
            const mediaFiles = JSON.parse(sessionStorage.getItem('case_media') || '{}');
            
            let photoCount = 0;
            let videoCount = 0;
            
            // Display photos
            if (mediaFiles.photos && mediaFiles.photos.length > 0) {
                photoCount = mediaFiles.photos.length;
                mediaFiles.photos.forEach((photo, index) => {
                    if (index < 6) { // Show max 6 photos in preview
                        const photoDiv = document.createElement('div');
                        photoDiv.className = 'relative';
                        photoDiv.innerHTML = `
                            <div class="border border-gray-700 rounded-lg p-2 bg-gray-800/50">
                                <img src="/storage/${photo.path}" class="w-full h-20 object-cover rounded-lg border-2 border-gray-700" alt="Photo ${index + 1}">
                                <div class="text-center text-white text-xs mt-1">${photo.original_name.substring(0, 10)}${photo.original_name.length > 10 ? '...' : ''}</div>
                            </div>
                        `;
                        photosPreview.appendChild(photoDiv);
                    }
                });
                
                if (mediaFiles.photos.length > 6) {
                    const moreDiv = document.createElement('div');
                    moreDiv.className = 'relative';
                    moreDiv.innerHTML = `
                        <div class="border border-gray-700 rounded-lg p-2 bg-gray-800/50 flex items-center justify-center h-24">
                            <div class="text-center text-gray-400 text-xs">+${mediaFiles.photos.length - 6} meer</div>
                        </div>
                    `;
                    photosPreview.appendChild(moreDiv);
                }
            }
            
            // Display videos
            if (mediaFiles.videos && mediaFiles.videos.length > 0) {
                videoCount = mediaFiles.videos.length;
                mediaFiles.videos.forEach((video, index) => {
                    if (index < 3) { // Show max 3 videos in preview
                        const videoDiv = document.createElement('div');
                        videoDiv.className = 'relative';
                        videoDiv.innerHTML = `
                            <div class="border border-gray-700 rounded-lg p-2 bg-gray-800/50">
                                <video class="w-full h-16 object-cover rounded" muted>
                                    <source src="/storage/${video.path}" type="video/mp4">
                                    Video ${index + 1}
                                </video>
                                <div class="text-center text-white text-xs mt-1">${video.original_name.substring(0, 15)}${video.original_name.length > 15 ? '...' : ''}</div>
                            </div>
                        `;
                        videosPreview.appendChild(videoDiv);
                    }
                });
                
                if (mediaFiles.videos.length > 3) {
                    const moreDiv = document.createElement('div');
                    moreDiv.className = 'relative';
                    moreDiv.innerHTML = `
                        <div class="border border-gray-700 rounded-lg p-2 bg-gray-800/50 flex items-center justify-center h-20">
                            <div class="text-center text-gray-400 text-xs">+${mediaFiles.videos.length - 3} meer</div>
                        </div>
                    `;
                    videosPreview.appendChild(moreDiv);
                }
            }
            
            // Show preview if there are media files
            if (photoCount > 0 || videoCount > 0) {
                mediaPreview.style.display = 'block';
            }
            
            // Update overview text
            if (photoCount > 0 || videoCount > 0) {
                mediaDiv.innerHTML = `
                    <div class="text-gray-300 text-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                        </svg>
                        ${photoCount} foto's en ${videoCount} video's geüpload
                    </div>
                `;
            } else {
                mediaDiv.innerHTML = `
                    <div class="text-gray-400 text-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                        </svg>
                        Geen media bestanden geüpload
                    </div>
                `;
            }
        }

        function displayOfferInfo() {
            const offerDiv = document.getElementById('offer-overview');
            const offerItems = document.getElementById('offer-items');
            const offerItemsBody = document.getElementById('offer-items-body');
            const subtotalRow = document.getElementById('subtotal-row');
            const vatRow = document.getElementById('vat-row');
            
            // Get offer data from sessionStorage
            const offerData = JSON.parse(sessionStorage.getItem('case_offer_data') || '{}');
            
            if (offerData && offerData.type === 'manual' && offerData.items && offerData.items.length > 0) {
                // Display manual offer items
                offerItemsBody.innerHTML = '';
                
                offerData.items.forEach(item => {
                    const row = document.createElement('tr');
                    row.className = 'border-b border-gray-700';
                    row.innerHTML = `
                        <td class="p-3">
                            <div class="font-medium text-white">${item.description}</div>
                            <div class="text-xs text-gray-400">${item.quantity} x €${parseFloat(item.price).toFixed(2).replace('.', ',')}</div>
                        </td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs font-medium ${item.type === 'part' ? 'bg-blue-600 text-blue-100' : 'bg-green-600 text-green-100'}">
                                ${item.type === 'part' ? 'Onderdeel' : 'Arbeid'}
                            </span>
                        </td>
                        <td class="text-right p-3 font-bold text-white">€${parseFloat(item.total).toFixed(2).replace('.', ',')}</td>
                    `;
                    offerItemsBody.appendChild(row);
                });
                
                // Show/hide VAT and subtotal rows
                if (offerData.vat_enabled) {
                    subtotalRow.style.display = '';
                    vatRow.style.display = '';
                    document.getElementById('subtotal-amount').textContent = `€${parseFloat(offerData.subtotal).toFixed(2).replace('.', ',')}`;
                    document.getElementById('vat-amount').textContent = `€${parseFloat(offerData.vat_amount).toFixed(2).replace('.', ',')}`;
                } else {
                    subtotalRow.style.display = 'none';
                    vatRow.style.display = 'none';
                }
                
                document.getElementById('total-amount').textContent = `€${parseFloat(offerData.total).toFixed(2).replace('.', ',')}`;
                
                offerItems.style.display = 'block';
                
                offerDiv.innerHTML = `
                    <div class="text-gray-300 text-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                        </svg>
                        Handmatig opgemaakte offerte met ${offerData.items.length} item(s)
                        ${offerData.vat_enabled ? ' (inclusief BTW)' : ' (exclusief BTW)'}
                    </div>
                `;
            } else if (offerData.type === 'upload' && offerData.filename) {
                // Display upload offer info
                offerDiv.innerHTML = `
                    <div class="flex justify-between items-center">
                        <div class="text-gray-300 text-sm">
                            <svg class="w-4 h-4 inline mr-1 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                            <strong>Externe offerte:</strong> <span class="text-gray-400">${offerData.filename}</span>
                        </div>
                        <div class="text-right">
                            <strong class="text-pblue text-lg">€${parseFloat(offerData.price || 0).toFixed(2).replace('.', ',')}</strong>
                        </div>
                    </div>
                `;
            } else {
                // Fallback display
                offerDiv.innerHTML = `
                    <div class="text-gray-300 text-sm">
                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                        </svg>
                        Offerte opgesteld en klaar om te versturen
                    </div>
                `;
            }
        }

        function showError(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'bg-red-900/20 border border-red-700 rounded-lg p-4 mb-6 text-red-300';
            alertDiv.innerHTML = `
                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/>
                </svg>
                ${message}
            `;
            document.querySelector('.max-w-7xl').insertBefore(alertDiv, document.querySelector('.max-w-7xl').firstChild);
        }

        // Form submission with loading state
        document.getElementById('finalSubmissionForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('sendToClientBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg class="w-4 h-4 inline mr-2 animate-spin" fill="currentColor" viewBox="0 0 24 24"><path d="M12,4V2A10,10 0 0,0 2,12H4A8,8 0 0,1 12,4Z"/></svg>Versturen...';
        });
    </script>
@endsection 