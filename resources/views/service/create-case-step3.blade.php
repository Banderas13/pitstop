@extends('layouts.app')

@section('title', 'Nieuwe Case - Media Upload')

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
                            <div class="bg-pblue h-2 rounded-full transition-all duration-300" style="width: 60%"></div>
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
                            <span class="text-pblue font-bold">Stap 3: Media Upload</span>
                            <span class="text-gray-400">Stap 4: Offerte Opstellen</span>
                            <span class="text-gray-400">Stap 5: Versturen</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Step 3 Form -->
        <section class="pb-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-9">
                <form method="POST" action="{{ route('service.store.step3') }}" enctype="multipart/form-data" id="step3Form">
                    @csrf
                    
                    <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                        <div class="bg-pblue p-6">
                            <h2 class="text-xl font-bold text-black uppercase tracking-wider flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="m9 16 1.41 1.41L15.83 12 10.41 6.59 9 8l4 4-4 4zm6-4L12 8l-1.41 1.41L15.83 12l-4.24 4.24L12 16l4-4z"/>
                                </svg>
                                Stap 3: Media Upload
                            </h2>
                        </div>
                        <div class="p-8">
                            
                            <!-- Selected Info Summary (from Previous Steps) -->
                            <div class="bg-chiffon/10 border border-chiffon/30 rounded-lg p-6 mb-8">
                                <h3 class="text-lg font-bold text-chiffon mb-4 uppercase tracking-wider flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z"/>
                                    </svg>
                                    Voortgang Overzicht
                                </h3>
                                <div id="progress-summary" class="text-sm text-gray-300">
                                    <div id="selected-user-display"></div>
                                    <div id="selected-car-display"></div>
                                    <div id="description-status" class="mt-1"></div>
                                </div>
                            </div>

                            <!-- Photos Upload Section -->
                            <div class="mb-8">
                                <label for="photos" class="block text-lg font-bold text-white mb-4 uppercase tracking-wider">
                                    <svg class="w-5 h-5 inline mr-2 text-pblue" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M4,4H7L9,2H15L17,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4M12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17A5,5 0 0,0 17,12A5,5 0 0,0 12,7M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9Z"/>
                                    </svg>
                                    Foto's Uploaden
                                    <span class="bg-gray-600 text-gray-200 px-2 py-1 rounded text-xs ml-2">Optioneel</span>
                                </label>
                                
                                <div class="upload-area border-2 border-dashed border-gray-600 rounded-lg p-8 text-center @error('photos') border-red-500 @enderror cursor-pointer transition-all duration-300 hover:border-pblue hover:bg-gray-800/30" 
                                     id="photo-upload-area" 
                                     ondrop="handleDrop(event, 'photos')" 
                                     ondragover="handleDragOver(event)" 
                                     ondragleave="handleDragLeave(event)">
                                    <div class="upload-content">
                                                                                 <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="currentColor" viewBox="0 0 24 24">
                                             <path d="M4,4H7L9,2H15L17,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4M12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17A5,5 0 0,0 17,12A5,5 0 0,0 12,7M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9Z"/>
                                         </svg>
                                        <h3 class="text-white text-lg font-medium mb-2">Sleep foto's hierheen of klik om te selecteren</h3>
                                        <p class="text-gray-400 text-sm mb-4">
                                            Ondersteunde formaten: JPG, JPEG, PNG, GIF<br>
                                            Maximale bestandsgrootte: 5MB per foto<br>
                                            Maximum 10 foto's
                                        </p>
                                        <input type="file" 
                                               class="hidden @error('photos') is-invalid @enderror" 
                                               id="photos" 
                                               name="photos[]" 
                                               multiple 
                                               accept="image/jpeg,image/jpg,image/png,image/gif"
                                               onchange="handleFileSelect(event, 'photos')">
                                        <button type="button" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" onclick="document.getElementById('photos').click()">
                                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M10,2V4.26L12,6.26L14,4.26V2H10M4.5,9A1.5,1.5 0 0,0 3,10.5V12.5A1.5,1.5 0 0,0 4.5,14A1.5,1.5 0 0,0 6,12.5V10.5A1.5,1.5 0 0,0 4.5,9M19.5,9A1.5,1.5 0 0,0 18,10.5V12.5A1.5,1.5 0 0,0 19.5,14A1.5,1.5 0 0,0 21,12.5V10.5A1.5,1.5 0 0,0 19.5,9M9,16V18H15V16H9Z"/>
                                            </svg>
                                            Selecteer Foto's
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Photo Preview -->
                                <div id="photo-preview" class="mt-6" style="display: none;">
                                    <h4 class="text-lg font-bold text-white mb-4">Geselecteerde Foto's:</h4>
                                    <div id="photo-list" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4"></div>
                                    <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm mt-4 transition-colors duration-300" onclick="clearFiles('photos')">
                                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z"/>
                                        </svg>
                                        Alle foto's verwijderen
                                    </button>
                                </div>
                                
                                @error('photos')
                                    <div class="text-red-400 text-sm mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Divider -->
                            <div class="border-t border-gray-700 my-8"></div>

                            <!-- Videos Upload Section -->
                            <div class="mb-8">
                                <label for="videos" class="block text-lg font-bold text-white mb-4 uppercase tracking-wider">
                                    <svg class="w-5 h-5 inline mr-2 text-pblue" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17,10.5V7A1,1 0 0,0 16,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16A1,1 0 0,0 17,17V13.5L21,17.5V6.5L17,10.5Z"/>
                                    </svg>
                                    Video's Uploaden
                                    <span class="bg-gray-600 text-gray-200 px-2 py-1 rounded text-xs ml-2">Optioneel</span>
                                </label>
                                
                                <div class="upload-area border-2 border-dashed border-gray-600 rounded-lg p-8 text-center @error('videos') border-red-500 @enderror cursor-pointer transition-all duration-300 hover:border-pblue hover:bg-gray-800/30" 
                                     id="video-upload-area" 
                                     ondrop="handleDrop(event, 'videos')" 
                                     ondragover="handleDragOver(event)" 
                                     ondragleave="handleDragLeave(event)">
                                                                         <div class="upload-content">
                                         <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="currentColor" viewBox="0 0 24 24">
                                             <path d="M17,10.5V7A1,1 0 0,0 16,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16A1,1 0 0,0 17,17V13.5L21,17.5V6.5L17,10.5M15,8V16H5V8H15Z"/>
                                         </svg>
                                        <h3 class="text-white text-lg font-medium mb-2">Sleep video's hierheen of klik om te selecteren</h3>
                                        <p class="text-gray-400 text-sm mb-4">
                                            Ondersteunde formaten: MP4, AVI, MOV, WMV<br>
                                            Maximale bestandsgrootte: 50MB per video<br>
                                            Maximum 5 video's
                                        </p>
                                        <input type="file" 
                                               class="hidden @error('videos') is-invalid @enderror" 
                                               id="videos" 
                                               name="videos[]" 
                                               multiple 
                                               accept="video/mp4,video/avi,video/mov,video/wmv"
                                               onchange="handleFileSelect(event, 'videos')">
                                        <button type="button" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300" onclick="document.getElementById('videos').click()">
                                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M10,2V4.26L12,6.26L14,4.26V2H10M4.5,9A1.5,1.5 0 0,0 3,10.5V12.5A1.5,1.5 0 0,0 4.5,14A1.5,1.5 0 0,0 6,12.5V10.5A1.5,1.5 0 0,0 4.5,9M19.5,9A1.5,1.5 0 0,0 18,10.5V12.5A1.5,1.5 0 0,0 19.5,14A1.5,1.5 0 0,0 21,12.5V10.5A1.5,1.5 0 0,0 19.5,9M9,16V18H15V16H9Z"/>
                                            </svg>
                                            Selecteer Video's
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Video Preview -->
                                <div id="video-preview" class="mt-6" style="display: none;">
                                    <h4 class="text-lg font-bold text-white mb-4">Geselecteerde Video's:</h4>
                                    <div id="video-list" class="space-y-2"></div>
                                    <button type="button" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm mt-4 transition-colors duration-300" onclick="clearFiles('videos')">
                                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z"/>
                                        </svg>
                                        Alle video's verwijderen
                                    </button>
                                </div>
                                
                                @error('videos')
                                    <div class="text-red-400 text-sm mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Upload Instructions -->
                            <div class="bg-blue-900/20 border border-blue-700 rounded-lg p-6">
                                <h4 class="text-lg font-bold text-blue-300 mb-4 uppercase tracking-wider flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,2A7,7 0 0,1 19,9C19,11.38 17.81,13.47 16,14.74V17A1,1 0 0,1 15,18H9A1,1 0 0,1 8,17V14.74C6.19,13.47 5,11.38 5,9A7,7 0 0,1 12,2M9,21V20H15V21A1,1 0 0,1 14,22H10A1,1 0 0,1 9,21M12,4A5,5 0 0,0 7,9C7,11.05 8.23,12.81 10,13.58V16H14V13.58C15.77,12.81 17,11.05 17,9A5,5 0 0,0 12,4Z"/>
                                    </svg>
                                    Tips voor Media Upload
                                </h4>
                                <ul class="text-gray-300 text-sm space-y-1">
                                    <li>• Voeg foto's toe die het probleem duidelijk tonen</li>
                                    <li>• Video's kunnen helpen om geluiden of bewegende problemen te documenteren</li>
                                    <li>• Zorg voor goede belichting bij foto's</li>
                                    <li>• Neem foto's vanuit verschillende hoeken</li>
                                    <li>• Media upload is optioneel - je kunt deze stap overslaan als je geen media hebt</li>
                                </ul>
                            </div>

                        </div>
                        
                        <!-- Card Footer with Navigation -->
                        <div class="bg-gray-800/50 border-t border-gray-700 p-6">
                            <div class="flex justify-between">
                                <a href="{{ route('service.create.step2') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                                    </svg>
                                    Vorige Stap
                                </a>
                                <button type="submit" id="nextStepBtn" class="bg-pblue hover:bg-white text-black px-6 py-3 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
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

    <style>
        .upload-area.drag-over {
            background-color: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6 !important;
        }
        
        .preview-image {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #374151;
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
            background: #dc2626;
            color: white;
            border: 2px solid white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
        }
        
        .file-size {
            font-size: 0.75rem;
            color: #9ca3af;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load session data and display summary
            const userId = sessionStorage.getItem('case_user_id');
            const carId = sessionStorage.getItem('case_car_id');
            const userName = sessionStorage.getItem('case_user_name');
            const carInfo = sessionStorage.getItem('case_car_info');
            
            if (!userId || !carId) {
                alert('Sessie gegevens ontbreken. Je wordt terug gestuurd naar stap 1.');
                window.location.href = '{{ route("service.create") }}';
                return;
            }

            // Display progress summary with names instead of IDs
            const displayUserName = userName || `Gebruiker ID: ${userId}`;
            const displayCarInfo = carInfo || `Voertuig ID: ${carId}`;
            
            document.getElementById('selected-user-display').innerHTML = `<strong>Gebruiker:</strong> ${displayUserName}`;
            document.getElementById('selected-car-display').innerHTML = `<strong>Voertuig:</strong> ${displayCarInfo}`;
            document.getElementById('description-status').innerHTML = `<span class="text-pblue"><svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Probleem beschrijving opgeslagen</span>`;
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
                    col.className = 'preview-card';
                    
                    const img = document.createElement('img');
                    img.className = 'preview-image';
                    img.src = URL.createObjectURL(file);
                    
                    const removeBtn = document.createElement('div');
                    removeBtn.className = 'remove-file';
                    removeBtn.innerHTML = '×';
                    removeBtn.onclick = () => removePhoto(index);
                    
                    const fileName = document.createElement('div');
                    fileName.className = 'file-size text-center mt-1 text-white';
                    fileName.textContent = `${file.name.substring(0, 15)}${file.name.length > 15 ? '...' : ''}`;
                    
                    const fileSize = document.createElement('div');
                    fileSize.className = 'file-size text-center';
                    fileSize.textContent = formatFileSize(file.size);
                    
                    col.appendChild(img);
                    col.appendChild(removeBtn);
                    col.appendChild(fileName);
                    col.appendChild(fileSize);
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
                    item.className = 'bg-gray-800 border border-gray-700 rounded-lg p-4 flex justify-between items-center';
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.innerHTML = `
                        <div class="text-white font-medium">${file.name}</div>
                        <small class="text-gray-400">${formatFileSize(file.size)}</small>
                    `;
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition-colors duration-300';
                    removeBtn.innerHTML = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z"/></svg>';
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