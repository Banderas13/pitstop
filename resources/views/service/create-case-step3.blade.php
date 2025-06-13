@extends('layouts.app')

@section('title', 'Nieuwe Case - Media Upload')

@section('content')
    <!-- Progress Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Nieuwe Case Maken</h4>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5"></div>
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
                        <small class="text-primary fw-bold">Stap 3: Media Upload</small>
                        <small class="text-muted">Stap 4: Offerte Opstellen</small>
                        <small class="text-muted">Stap 5: Versturen</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 3 Form -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <form method="POST" action="{{ route('service.store.step3') }}" enctype="multipart/form-data" id="step3Form">
                @csrf
                
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-images me-2"></i>
                            Stap 3: Media Upload
                        </h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Selected Info Summary (from Previous Steps) -->
                        <div class="alert alert-light border mb-4">
                            <h6 class="mb-2">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Voortgang Overzicht
                            </h6>
                            <div id="progress-summary" class="small text-muted">
                                <div id="selected-user-display"></div>
                                <div id="selected-car-display"></div>
                                <div id="description-status" class="mt-1"></div>
                            </div>
                        </div>

                        <!-- Photos Upload Section -->
                        <div class="mb-4">
                            <label for="photos" class="form-label fw-bold">
                                <i class="fas fa-camera me-2 text-warning"></i>
                                Foto's Uploaden
                                <span class="badge bg-secondary ms-2">Optioneel</span>
                            </label>
                            
                            <div class="upload-area border-2 border-dashed rounded p-4 text-center @error('photos') border-danger @enderror" 
                                 id="photo-upload-area" 
                                 ondrop="handleDrop(event, 'photos')" 
                                 ondragover="handleDragOver(event)" 
                                 ondragleave="handleDragLeave(event)">
                                <div class="upload-content">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">Sleep foto's hierheen of klik om te selecteren</h6>
                                    <p class="text-muted small mb-3">
                                        Ondersteunde formaten: JPG, JPEG, PNG, GIF<br>
                                        Maximale bestandsgrootte: 5MB per foto<br>
                                        Maximum 10 foto's
                                    </p>
                                    <input type="file" 
                                           class="form-control d-none @error('photos') is-invalid @enderror" 
                                           id="photos" 
                                           name="photos[]" 
                                           multiple 
                                           accept="image/jpeg,image/jpg,image/png,image/gif"
                                           onchange="handleFileSelect(event, 'photos')">
                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('photos').click()">
                                        <i class="fas fa-folder-open me-2"></i>
                                        Selecteer Foto's
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Photo Preview -->
                            <div id="photo-preview" class="mt-3" style="display: none;">
                                <h6 class="fw-bold">Geselecteerde Foto's:</h6>
                                <div id="photo-list" class="row g-2"></div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="clearFiles('photos')">
                                    <i class="fas fa-trash me-1"></i>
                                    Alle foto's verwijderen
                                </button>
                            </div>
                            
                            @error('photos')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Videos Upload Section -->
                        <div class="mb-4">
                            <label for="videos" class="form-label fw-bold">
                                <i class="fas fa-video me-2 text-info"></i>
                                Video's Uploaden
                                <span class="badge bg-secondary ms-2">Optioneel</span>
                            </label>
                            
                            <div class="upload-area border-2 border-dashed rounded p-4 text-center @error('videos') border-danger @enderror" 
                                 id="video-upload-area" 
                                 ondrop="handleDrop(event, 'videos')" 
                                 ondragover="handleDragOver(event)" 
                                 ondragleave="handleDragLeave(event)">
                                <div class="upload-content">
                                    <i class="fas fa-film fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">Sleep video's hierheen of klik om te selecteren</h6>
                                    <p class="text-muted small mb-3">
                                        Ondersteunde formaten: MP4, AVI, MOV, WMV<br>
                                        Maximale bestandsgrootte: 50MB per video<br>
                                        Maximum 5 video's
                                    </p>
                                    <input type="file" 
                                           class="form-control d-none @error('videos') is-invalid @enderror" 
                                           id="videos" 
                                           name="videos[]" 
                                           multiple 
                                           accept="video/mp4,video/avi,video/mov,video/wmv"
                                           onchange="handleFileSelect(event, 'videos')">
                                    <button type="button" class="btn btn-outline-info" onclick="document.getElementById('videos').click()">
                                        <i class="fas fa-folder-open me-2"></i>
                                        Selecteer Video's
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Video Preview -->
                            <div id="video-preview" class="mt-3" style="display: none;">
                                <h6 class="fw-bold">Geselecteerde Video's:</h6>
                                <div id="video-list" class="list-group"></div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="clearFiles('videos')">
                                    <i class="fas fa-trash me-1"></i>
                                    Alle video's verwijderen
                                </button>
                            </div>
                            
                            @error('videos')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Upload Instructions -->
                        <div class="alert alert-info">
                            <h6 class="alert-heading">
                                <i class="fas fa-lightbulb me-2"></i>
                                Tips voor Media Upload
                            </h6>
                            <ul class="mb-0">
                                <li>Voeg foto's toe die het probleem duidelijk tonen</li>
                                <li>Video's kunnen helpen om geluiden of bewegende problemen te documenteren</li>
                                <li>Zorg voor goede belichting bij foto's</li>
                                <li>Neem foto's vanuit verschillende hoeken</li>
                                <li>Media upload is optioneel - je kunt deze stap overslaan als je geen media hebt</li>
                            </ul>
                        </div>

                    </div>
                    
                    <!-- Card Footer with Navigation -->
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('service.create.step2') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Vorige Stap
                            </a>
                            <button type="submit" id="nextStepBtn" class="btn btn-primary">
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

    <style>
        .upload-area {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .upload-area:hover {
            background-color: #f8f9fa;
            border-color: #007bff !important;
        }
        
        .upload-area.drag-over {
            background-color: #e3f2fd;
            border-color: #2196f3 !important;
        }
        
        .preview-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #dee2e6;
        }
        
        .preview-card {
            position: relative;
        }
        
        .remove-file {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #dc3545;
            color: white;
            border: 2px solid white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .file-size {
            font-size: 0.75rem;
            color: #6c757d;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load session data and display summary
            const userId = sessionStorage.getItem('case_user_id');
            const carId = sessionStorage.getItem('case_car_id');
            
            if (!userId || !carId) {
                alert('Sessie gegevens ontbreken. Je wordt terug gestuurd naar stap 1.');
                window.location.href = '{{ route("service.create") }}';
                return;
            }

            // Display progress summary
            document.getElementById('selected-user-display').innerHTML = `<strong>Gebruiker ID:</strong> ${userId}`;
            document.getElementById('selected-car-display').innerHTML = `<strong>Voertuig ID:</strong> ${carId}`;
            document.getElementById('description-status').innerHTML = `<span class="text-success"><i class="fas fa-check me-1"></i>Probleem beschrijving opgeslagen</span>`;
        });

        // File handling variables
        let selectedPhotos = [];
        let selectedVideos = [];

        // Drag and drop handlers
        function handleDragOver(e) {
            e.preventDefault();
            e.currentTarget.classList.add('drag-over');
        }

        function handleDragLeave(e) {
            e.preventDefault();
            e.currentTarget.classList.remove('drag-over');
        }

        function handleDrop(e, type) {
            e.preventDefault();
            e.currentTarget.classList.remove('drag-over');
            
            const files = Array.from(e.dataTransfer.files);
            processFiles(files, type);
        }

        // File selection handler
        function handleFileSelect(e, type) {
            const files = Array.from(e.target.files);
            processFiles(files, type);
        }

        // Process selected files
        function processFiles(files, type) {
            if (type === 'photos') {
                // Validate photo files
                const validPhotos = files.filter(file => {
                    const isValidType = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'].includes(file.type);
                    const isValidSize = file.size <= 5 * 1024 * 1024; // 5MB
                    
                    if (!isValidType) {
                        alert(`${file.name} is geen geldig beeldformaat.`);
                        return false;
                    }
                    if (!isValidSize) {
                        alert(`${file.name} is te groot (max 5MB).`);
                        return false;
                    }
                    return true;
                });

                if (selectedPhotos.length + validPhotos.length > 10) {
                    alert('Maximum 10 foto\'s toegestaan.');
                    return;
                }

                selectedPhotos = [...selectedPhotos, ...validPhotos];
                updatePhotoPreview();
                
            } else if (type === 'videos') {
                // Validate video files
                const validVideos = files.filter(file => {
                    const isValidType = ['video/mp4', 'video/avi', 'video/mov', 'video/wmv'].includes(file.type);
                    const isValidSize = file.size <= 50 * 1024 * 1024; // 50MB
                    
                    if (!isValidType) {
                        alert(`${file.name} is geen geldig videoformaat.`);
                        return false;
                    }
                    if (!isValidSize) {
                        alert(`${file.name} is te groot (max 50MB).`);
                        return false;
                    }
                    return true;
                });

                if (selectedVideos.length + validVideos.length > 5) {
                    alert('Maximum 5 video\'s toegestaan.');
                    return;
                }

                selectedVideos = [...selectedVideos, ...validVideos];
                updateVideoPreview();
            }
        }

        // Update photo preview
        function updatePhotoPreview() {
            const photoPreview = document.getElementById('photo-preview');
            const photoList = document.getElementById('photo-list');
            
            if (selectedPhotos.length > 0) {
                photoPreview.style.display = 'block';
                photoList.innerHTML = '';
                
                selectedPhotos.forEach((file, index) => {
                    const col = document.createElement('div');
                    col.className = 'col-md-2 col-sm-3 col-4';
                    
                    const card = document.createElement('div');
                    card.className = 'preview-card';
                    
                    const img = document.createElement('img');
                    img.className = 'preview-image w-100';
                    img.src = URL.createObjectURL(file);
                    
                    const removeBtn = document.createElement('div');
                    removeBtn.className = 'remove-file';
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = () => removePhoto(index);
                    
                    const fileName = document.createElement('div');
                    fileName.className = 'file-size text-center mt-1';
                    fileName.textContent = `${file.name.substring(0, 15)}${file.name.length > 15 ? '...' : ''}`;
                    
                    const fileSize = document.createElement('div');
                    fileSize.className = 'file-size text-center';
                    fileSize.textContent = formatFileSize(file.size);
                    
                    card.appendChild(img);
                    card.appendChild(removeBtn);
                    card.appendChild(fileName);
                    card.appendChild(fileSize);
                    col.appendChild(card);
                    photoList.appendChild(col);
                });
            } else {
                photoPreview.style.display = 'none';
            }
        }

        // Update video preview
        function updateVideoPreview() {
            const videoPreview = document.getElementById('video-preview');
            const videoList = document.getElementById('video-list');
            
            if (selectedVideos.length > 0) {
                videoPreview.style.display = 'block';
                videoList.innerHTML = '';
                
                selectedVideos.forEach((file, index) => {
                    const item = document.createElement('div');
                    item.className = 'list-group-item d-flex justify-content-between align-items-center';
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.innerHTML = `
                        <div class="fw-bold">${file.name}</div>
                        <small class="text-muted">${formatFileSize(file.size)}</small>
                    `;
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'btn btn-sm btn-outline-danger';
                    removeBtn.innerHTML = '<i class="fas fa-trash"></i>';
                    removeBtn.onclick = () => removeVideo(index);
                    
                    item.appendChild(fileInfo);
                    item.appendChild(removeBtn);
                    videoList.appendChild(item);
                });
            } else {
                videoPreview.style.display = 'none';
            }
        }

        // Remove photo
        function removePhoto(index) {
            selectedPhotos.splice(index, 1);
            updatePhotoPreview();
        }

        // Remove video
        function removeVideo(index) {
            selectedVideos.splice(index, 1);
            updateVideoPreview();
        }

        // Clear all files
        function clearFiles(type) {
            if (type === 'photos') {
                selectedPhotos = [];
                document.getElementById('photos').value = '';
                updatePhotoPreview();
            } else if (type === 'videos') {
                selectedVideos = [];
                document.getElementById('videos').value = '';
                updateVideoPreview();
            }
        }

        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Form submission - update file inputs with selected files
        document.getElementById('step3Form').addEventListener('submit', function(e) {
            // Create new DataTransfer objects to set file inputs
            const photoInput = document.getElementById('photos');
            const videoInput = document.getElementById('videos');
            
            // Clear existing files and set selected files
            if (selectedPhotos.length > 0) {
                const photoDataTransfer = new DataTransfer();
                selectedPhotos.forEach(file => photoDataTransfer.items.add(file));
                photoInput.files = photoDataTransfer.files;
            }
            
            if (selectedVideos.length > 0) {
                const videoDataTransfer = new DataTransfer();
                selectedVideos.forEach(file => videoDataTransfer.items.add(file));
                videoInput.files = videoDataTransfer.files;
            }

            // Store basic media info for step 5 preview
            const mediaInfo = {
                photoCount: selectedPhotos.length,
                videoCount: selectedVideos.length,
                photos: selectedPhotos.map(file => ({
                    name: file.name,
                    size: file.size,
                    type: file.type
                })),
                videos: selectedVideos.map(file => ({
                    name: file.name,
                    size: file.size,
                    type: file.type
                }))
            };
            sessionStorage.setItem('case_media_info', JSON.stringify(mediaInfo));
        });
    </script>
@endsection 