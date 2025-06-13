@extends('layouts.app')

@section('title', 'Nieuwe Case - Offerte Opstellen')

@section('content')
    <!-- Progress Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Nieuwe Case Maken</h4>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5"></div>
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
                        <small class="text-primary fw-bold">Stap 4: Offerte Opstellen</small>
                        <small class="text-muted">Stap 5: Versturen</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 4 Form -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- VAT Toggle Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">
                                <i class="fas fa-percent me-2 text-warning"></i>
                                BTW Berekening
                            </h6>
                            <small class="text-muted">BTW tarief: 21%</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="vatToggle" checked>
                            <label class="form-check-label fw-bold" for="vatToggle" id="vatLabel">
                                Prijzen Exclusief BTW
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Option Selection -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-file-invoice-dollar me-2"></i>
                        Kies Offerte Methode
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card h-100 option-card" id="manualOption">
                                <div class="card-body text-center">
                                    <i class="fas fa-edit fa-3x text-primary mb-3"></i>
                                    <h6>Handmatige Offerte</h6>
                                    <p class="text-muted small">Voer onderdelen en arbeid handmatig in</p>
                                    <button type="button" class="btn btn-primary" onclick="selectOption('manual')">
                                        Selecteren
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 option-card" id="uploadOption">
                                <div class="card-body text-center">
                                    <i class="fas fa-upload fa-3x text-info mb-3"></i>
                                    <h6>Upload Externe Offerte</h6>
                                    <p class="text-muted small">Upload een bestaand offerte bestand</p>
                                    <button type="button" class="btn btn-info" onclick="selectOption('upload')">
                                        Selecteren
                                    </button>
                                </div>
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
                    
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-cogs me-2"></i>
                                Onderdelen en Arbeid
                            </h5>
                        </div>
                        <div class="card-body">
                            
                            <!-- Progress Summary -->
                            <div class="alert alert-light border mb-4">
                                <h6 class="mb-2">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    Case Overzicht
                                </h6>
                                <div id="progress-summary" class="small text-muted">
                                    <div id="selected-user-display"></div>
                                    <div id="selected-car-display"></div>
                                    <div id="description-status" class="mt-1"></div>
                                    <div id="media-status" class="mt-1"></div>
                                </div>
                            </div>

                            <!-- Parts Section -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-puzzle-piece me-2 text-warning"></i>
                                        Onderdelen
                                    </h6>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addItem('parts')">
                                        <i class="fas fa-plus me-1"></i>
                                        Onderdeel Toevoegen
                                    </button>
                                </div>
                                <div id="parts-container"></div>
                            </div>

                            <!-- Labour Section -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-bold">
                                        <i class="fas fa-tools me-2 text-info"></i>
                                        Arbeid
                                    </h6>
                                    <button type="button" class="btn btn-sm btn-outline-info" onclick="addItem('labour')">
                                        <i class="fas fa-plus me-1"></i>
                                        Arbeid Toevoegen
                                    </button>
                                </div>
                                <div id="labour-container"></div>
                            </div>

                            <!-- Total Section -->
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-2">Subtotaal:</h6>
                                            <h6 class="mb-2" id="vatSection" style="display: none;">BTW (21%):</h6>
                                            <h5 class="fw-bold text-primary">Totaal:</h5>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <h6 class="mb-2">€<span id="subtotal">0.00</span></h6>
                                            <h6 class="mb-2" id="vatAmount" style="display: none;">€<span id="vatValue">0.00</span></h6>
                                            <h5 class="fw-bold text-primary">€<span id="total">0.00</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <!-- Manual Form Footer -->
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('service.create.step3') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Vorige Stap
                                </a>
                                <div>
                                    <button type="button" class="btn btn-outline-danger me-2" onclick="resetForm()">
                                        <i class="fas fa-redo me-2"></i>
                                        Reset
                                    </button>
                                    <button type="submit" id="nextStepBtn" class="btn btn-primary" disabled>
                                        Offerte Genereren
                                        <i class="fas fa-arrow-right ms-2"></i>
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
                    
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-upload me-2"></i>
                                Upload Externe Offerte
                            </h5>
                        </div>
                        <div class="card-body">
                            
                            <!-- Upload Area -->
                            <div class="upload-area border-2 border-dashed rounded p-4 text-center @error('offer_file') border-danger @enderror" 
                                 id="offer-upload-area" 
                                 ondrop="handleOfferDrop(event)" 
                                 ondragover="handleDragOver(event)" 
                                 ondragleave="handleDragLeave(event)">
                                <div class="upload-content">
                                    <i class="fas fa-file-pdf fa-3x text-muted mb-3"></i>
                                    <h6 class="text-muted">Sleep offerte bestand hierheen of klik om te selecteren</h6>
                                    <p class="text-muted small mb-3">
                                        Ondersteunde formaten: PDF, DOC, DOCX<br>
                                        Maximale bestandsgrootte: 10MB
                                    </p>
                                    <input type="file" 
                                           class="form-control d-none @error('offer_file') is-invalid @enderror" 
                                           id="offer_file" 
                                           name="offer_file" 
                                           accept=".pdf,.doc,.docx"
                                           onchange="handleOfferFileSelect(event)">
                                    <button type="button" class="btn btn-outline-info" onclick="document.getElementById('offer_file').click()">
                                        <i class="fas fa-folder-open me-2"></i>
                                        Selecteer Offerte Bestand
                                    </button>
                                </div>
                            </div>
                            
                            <!-- File Preview -->
                            <div id="offer-preview" class="mt-3" style="display: none;">
                                <div class="alert alert-success">
                                    <h6 class="alert-heading">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Bestand Geselecteerd
                                    </h6>
                                    <p class="mb-2" id="selected-file-info"></p>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearOfferFile()">
                                        <i class="fas fa-trash me-1"></i>
                                        Verwijderen
                                    </button>
                                </div>
                            </div>

                            <!-- Price Input for Upload -->
                            <div class="mt-4">
                                <label for="upload_price" class="form-label fw-bold">
                                    <i class="fas fa-euro-sign me-2 text-success"></i>
                                    Offerte Prijs
                                    <span class="badge bg-danger ms-2">Verplicht</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">€</span>
                                    <input type="number" 
                                           class="form-control @error('upload_price') is-invalid @enderror" 
                                           id="upload_price" 
                                           name="upload_price" 
                                           step="0.01" 
                                           min="0" 
                                           placeholder="0.00"
                                           onchange="validateUploadForm()">
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Voer de totaalprijs van de geüploade offerte in
                                </div>
                                @error('upload_price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            @error('offer_file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Upload Form Footer -->
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('service.create.step3') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Vorige Stap
                                </a>
                                <button type="submit" id="uploadNextStepBtn" class="btn btn-primary" disabled>
                                    Volgende Stap
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Add FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .option-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .option-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .option-card.selected {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }
        
        .item-row {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
        }
        
        .remove-item {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        
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
    </style>

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

            // Display progress summary
            document.getElementById('selected-user-display').innerHTML = `<strong>Gebruiker ID:</strong> ${userId}`;
            document.getElementById('selected-car-display').innerHTML = `<strong>Voertuig ID:</strong> ${carId}`;
            document.getElementById('description-status').innerHTML = `<span class="text-success"><i class="fas fa-check me-1"></i>Probleem beschrijving opgeslagen</span>`;
            document.getElementById('media-status').innerHTML = `<span class="text-success"><i class="fas fa-check me-1"></i>Media upload voltooid</span>`;
            
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
            document.querySelectorAll('.option-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Hide all forms
            document.getElementById('manualForm').style.display = 'none';
            document.getElementById('uploadForm').style.display = 'none';
            
            if (option === 'manual') {
                document.getElementById('manualOption').classList.add('selected');
                document.getElementById('manualForm').style.display = 'block';
                addItem('parts'); // Add initial part row
                addItem('labour'); // Add initial labour row
            } else if (option === 'upload') {
                document.getElementById('uploadOption').classList.add('selected');
                document.getElementById('uploadForm').style.display = 'block';
            }
        }

        // VAT Toggle
        document.getElementById('vatToggle').addEventListener('change', function() {
            vatEnabled = this.checked;
            const label = document.getElementById('vatLabel');
            const vatSection = document.getElementById('vatSection');
            const vatAmount = document.getElementById('vatAmount');
            
            if (vatEnabled) {
                label.textContent = 'Prijzen Exclusief BTW';
                vatSection.style.display = 'block';
                vatAmount.style.display = 'block';
            } else {
                label.textContent = 'Prijzen Inclusief BTW';
                vatSection.style.display = 'none';
                vatAmount.style.display = 'none';
            }
            
            // Update hidden input
            document.getElementById('manual_vat_enabled').value = vatEnabled ? '1' : '0';
            
            calculateTotal();
        });

        // Add item (parts or labour)
        function addItem(type) {
            itemCounter++;
            const container = document.getElementById(type + '-container');
            const icon = type === 'parts' ? 'puzzle-piece' : 'tools';
            const color = type === 'parts' ? 'warning' : 'info';
            const placeholder = type === 'parts' ? 'Onderdeel naam...' : 'Arbeid beschrijving...';
            
            const itemHtml = `
                <div class="item-row" id="${type}-${itemCounter}">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="fas fa-${icon} me-1 text-${color}"></i>
                                ${type === 'parts' ? 'Onderdeel' : 'Arbeid'}
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   name="${type}[${itemCounter}][name]" 
                                   placeholder="${placeholder}" 
                                   required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Aantal</label>
                            <input type="number" 
                                   class="form-control quantity-input" 
                                   name="${type}[${itemCounter}][quantity]" 
                                   value="1" 
                                   min="1" 
                                   step="1"
                                   onchange="calculateTotal()" 
                                   required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Prijs per eenheid</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" 
                                       class="form-control price-input" 
                                       name="${type}[${itemCounter}][price]" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="0.00"
                                       onchange="calculateTotal()" 
                                       required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Totaal</label>
                            <div class="fw-bold text-success" id="item-total-${itemCounter}">€0.00</div>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">&nbsp;</label>
                            <button type="button" class="remove-item d-block" onclick="removeItem('${type}-${itemCounter}')">
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
            document.querySelectorAll('.item-row').forEach(row => {
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
            const itemRows = document.querySelectorAll('.item-row');
            const hasValidItems = Array.from(itemRows).some(row => {
                const nameInput = row.querySelector('input[name*="[name]"]');
                const quantityInput = row.querySelector('.quantity-input');
                const priceInput = row.querySelector('.price-input');
                
                return nameInput && nameInput.value.trim() && 
                       quantityInput && quantityInput.value && 
                       priceInput && priceInput.value;
            });
            
            document.getElementById('nextStepBtn').disabled = !hasValidItems;
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
            e.currentTarget.classList.add('drag-over');
        }

        function handleDragLeave(e) {
            e.preventDefault();
            e.currentTarget.classList.remove('drag-over');
        }

        function handleOfferDrop(e) {
            e.preventDefault();
            e.currentTarget.classList.remove('drag-over');
            
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
            if (document.querySelectorAll('.item-row').length === 0) {
                e.preventDefault();
                alert('Voeg minimaal één onderdeel of arbeid toe.');
                return;
            }

            // Store offer items data for step 5 preview
            const offerItems = [];
            let subtotal = 0;

            document.querySelectorAll('.item-row').forEach(row => {
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