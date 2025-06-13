@extends('layouts.app')

@section('title', 'Nieuwe Case - Versturen')

@section('content')
    <!-- Progress Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Nieuwe Case Maken</h4>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-success">
                            <i class="fas fa-check me-1"></i>
                            Stap 1: Gebruiker & Voertuig
                        </small>
                        <small class="text-success">
                            <i class="fas fa-check me-1"></i>
                            Stap 2: Probleem Beschrijving
                        </small>
                        <small class="text-success">
                            <i class="fas fa-check me-1"></i>
                            Stap 3: Media Upload
                        </small>
                        <small class="text-success">
                            <i class="fas fa-check me-1"></i>
                            Stap 4: Offerte Opstellen
                        </small>
                        <small class="text-primary fw-bold">Stap 5: Versturen</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 5 Content -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            
            <!-- Overview Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-eye me-2"></i>
                        Case Overzicht
                    </h5>
                </div>
                <div class="card-body">
                    
                    <!-- Step 1: User & Vehicle -->
                    <div class="mb-4">
                        <h6 class="fw-bold border-bottom pb-2">
                            <i class="fas fa-user-car me-2 text-primary"></i>
                            Stap 1: Gebruiker & Voertuig
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <h6 class="mb-2 text-primary">Gebruiker</h6>
                                    <div id="user-overview-info">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-8"></span>
                                            <span class="placeholder col-6"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <h6 class="mb-2 text-primary">Voertuig</h6>
                                    <div id="car-overview-info">
                                        <div class="placeholder-glow">
                                            <span class="placeholder col-7"></span>
                                            <span class="placeholder col-5"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Description -->
                    <div class="mb-4">
                        <h6 class="fw-bold border-bottom pb-2">
                            <i class="fas fa-clipboard-list me-2 text-success"></i>
                            Stap 2: Probleem Beschrijving
                        </h6>
                        <div class="bg-light p-3 rounded">
                            <div id="description-overview">
                                <div class="placeholder-glow">
                                    <span class="placeholder col-12"></span>
                                    <span class="placeholder col-8"></span>
                                    <span class="placeholder col-10"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Media -->
                    <div class="mb-4">
                        <h6 class="fw-bold border-bottom pb-2">
                            <i class="fas fa-images me-2 text-warning"></i>
                            Stap 3: Media Upload
                        </h6>
                        <div id="media-overview">
                            <div class="text-muted">
                                <i class="fas fa-spinner fa-spin me-2"></i>
                                Media informatie laden...
                            </div>
                        </div>
                        
                        <!-- Media Preview Section -->
                        <div id="media-preview" class="mt-3" style="display: none;">
                            <div class="row" id="photos-preview">
                                <!-- Photos will be loaded here -->
                            </div>
                            <div class="row mt-2" id="videos-preview">
                                <!-- Videos will be loaded here -->
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <div class="text-success">
                                <i class="fas fa-check me-2"></i>
                                <strong>Media upload voltooid</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Offer -->
                    <div class="mb-0">
                        <h6 class="fw-bold border-bottom pb-2">
                            <i class="fas fa-file-invoice-dollar me-2 text-info"></i>
                            Stap 4: Offerte
                        </h6>
                        
                        <!-- Offer Items Details -->
                        <div id="offer-items" class="mb-3" style="display: none;">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Beschrijving</th>
                                            <th>Type</th>
                                            <th class="text-end">Prijs</th>
                                        </tr>
                                    </thead>
                                    <tbody id="offer-items-body">
                                        <!-- Items will be loaded here -->
                                    </tbody>
                                    <tfoot class="table-secondary">
                                        <tr id="subtotal-row" style="display: none;">
                                            <td colspan="2"><strong>Subtotaal</strong></td>
                                            <td class="text-end"><strong id="subtotal-amount">€0,00</strong></td>
                                        </tr>
                                        <tr id="vat-row" style="display: none;">
                                            <td colspan="2"><strong>BTW (21%)</strong></td>
                                            <td class="text-end"><strong id="vat-amount">€0,00</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><strong>Totaal</strong></td>
                                            <td class="text-end"><strong id="total-amount">€0,00</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <div id="offer-overview">
                            <div class="text-muted">
                                <i class="fas fa-spinner fa-spin me-2"></i>
                                Offerte informatie laden...
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <div class="text-success">
                                <i class="fas fa-check me-2"></i>
                                <strong>Offerte opgesteld</strong>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Action Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-paper-plane me-2"></i>
                        Case Versturen
                    </h5>
                </div>
                <div class="card-body">
                    
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-info-circle me-2"></i>
                            Klaar om te versturen
                        </h6>
                        <p class="mb-0">
                            Controleer bovenstaande informatie en klik op "Verstuur naar Klant" om de case op te slaan en te versturen.
                            De offerte wordt automatisch als PDF bijgevoegd.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('service.store.step5') }}" id="finalSubmissionForm">
                        @csrf
                        <input type="hidden" name="user_id" id="final_user_id">
                        <input type="hidden" name="car_id" id="final_car_id">
                        
                        <div class="mb-3">
                            <h6 class="mb-1">Let op:</h6>
                            <small class="text-muted">
                                Na het versturen wordt de case opgeslagen in de database en kun je deze terugvinden op de service pagina.
                            </small>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('service.create.step4') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Vorige Stap
                            </a>
                            <button type="submit" class="btn btn-success btn-lg" id="sendToClientBtn">
                                <i class="fas fa-paper-plane me-2"></i>
                                Verstuur naar Klant
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <!-- Add FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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
                <div><strong>Naam:</strong> ${userData.name}</div>
                <div><strong>Email:</strong> ${userData.email}</div>
                ${userData.telephone ? `<div><strong>Telefoon:</strong> ${userData.telephone}</div>` : ''}
                ${userData.vat ? `<div><strong>BTW:</strong> ${userData.vat}</div>` : ''}
            `;
        }

        function displayCarInfo(carData) {
            const carInfo = document.getElementById('car-overview-info');
            carInfo.innerHTML = `
                <div><strong>Merk:</strong> ${carData.brand}</div>
                <div><strong>Model:</strong> ${carData.model}</div>
                <div><strong>Kenteken:</strong> ${carData.numberplate}</div>
                ${carData.year ? `<div><strong>Jaar:</strong> ${carData.year}</div>` : ''}
                ${carData.fuel ? `<div><strong>Brandstof:</strong> ${carData.fuel}</div>` : ''}
            `;
        }

        function displayDescriptionInfo() {
            const descriptionDiv = document.getElementById('description-overview');
            // In a real implementation, you'd get this from server session or another API call
            descriptionDiv.innerHTML = `
                <div class="text-success">
                    <i class="fas fa-check me-2"></i>
                    <strong>Probleem beschrijving opgeslagen</strong>
                </div>
                <small class="text-muted">
                    Mechaniek diagnose en eventuele klant beschrijving zijn opgeslagen voor deze case.
                </small>
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
                        photoDiv.className = 'col-2 mb-2';
                        photoDiv.innerHTML = `
                            <div class="border rounded p-1">
                                <img src="/storage/${photo.path}" class="img-fluid rounded" style="height: 60px; width: 100%; object-fit: cover;" alt="Photo ${index + 1}">
                                <small class="d-block text-center text-muted mt-1">${photo.original_name.substring(0, 10)}${photo.original_name.length > 10 ? '...' : ''}</small>
                            </div>
                        `;
                        photosPreview.appendChild(photoDiv);
                    }
                });
                
                if (mediaFiles.photos.length > 6) {
                    const moreDiv = document.createElement('div');
                    moreDiv.className = 'col-2 mb-2';
                    moreDiv.innerHTML = `
                        <div class="border rounded p-1 d-flex align-items-center justify-content-center bg-light" style="height: 60px;">
                            <small class="text-muted">+${mediaFiles.photos.length - 6} meer</small>
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
                        videoDiv.className = 'col-4 mb-2';
                        videoDiv.innerHTML = `
                            <div class="border rounded p-1">
                                <video class="img-fluid rounded" style="height: 60px; width: 100%; object-fit: cover;" muted>
                                    <source src="/storage/${video.path}" type="video/mp4">
                                    Video ${index + 1}
                                </video>
                                <small class="d-block text-center text-muted">${video.original_name.substring(0, 15)}${video.original_name.length > 15 ? '...' : ''}</small>
                            </div>
                        `;
                        videosPreview.appendChild(videoDiv);
                    }
                });
                
                if (mediaFiles.videos.length > 3) {
                    const moreDiv = document.createElement('div');
                    moreDiv.className = 'col-4 mb-2';
                    moreDiv.innerHTML = `
                        <div class="border rounded p-1 d-flex align-items-center justify-content-center bg-light" style="height: 60px;">
                            <small class="text-muted">+${mediaFiles.videos.length - 3} meer</small>
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
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        ${photoCount} foto's en ${videoCount} video's geüpload
                    </div>
                `;
            } else {
                mediaDiv.innerHTML = `
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
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
            
            if (offerData.type === 'manual' && offerData.items && offerData.items.length > 0) {
                // Display manual offer items
                offerItemsBody.innerHTML = '';
                
                offerData.items.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <strong>${item.description}</strong>
                            <br><small class="text-muted">${item.quantity} x €${parseFloat(item.price).toFixed(2).replace('.', ',')}</small>
                        </td>
                        <td><span class="badge ${item.type === 'part' ? 'bg-primary' : 'bg-success'}">${item.type === 'part' ? 'Onderdeel' : 'Arbeid'}</span></td>
                        <td class="text-end"><strong>€${parseFloat(item.total).toFixed(2).replace('.', ',')}</strong></td>
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
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Handmatig opgemaakte offerte met ${offerData.items.length} item(s)
                        ${offerData.vat_enabled ? ' (inclusief BTW)' : ' (exclusief BTW)'}
                    </div>
                `;
            } else if (offerData.type === 'upload' && offerData.filename) {
                // Display upload offer info
                offerDiv.innerHTML = `
                    <div class="row">
                        <div class="col-md-8">
                            <div class="text-muted">
                                <i class="fas fa-file-pdf me-1 text-danger"></i>
                                <strong>Externe offerte:</strong> ${offerData.filename}
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <strong class="text-success">€${parseFloat(offerData.price || 0).toFixed(2).replace('.', ',')}</strong>
                        </div>
                    </div>
                `;
            } else {
                // Fallback display
                offerDiv.innerHTML = `
                    <div class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Offerte opgesteld en klaar om te versturen
                    </div>
                `;
            }
        }

        function showError(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger alert-dismissible fade show';
            alertDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('.col-lg-10').insertBefore(alertDiv, document.querySelector('.col-lg-10').firstChild);
        }

        // Form submission with loading state
        document.getElementById('finalSubmissionForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('sendToClientBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Versturen...';
        });
    </script>
@endsection 