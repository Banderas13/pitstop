@extends('layouts.app')

@section('title', 'Nieuwe Wagen Toevoegen')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Nieuwe Wagen Toevoegen</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('cars.store') }}" method="POST" id="carForm">
                        @csrf
                        
                        <!-- Merk zoeken -->
                        <div class="mb-3">
                            <label for="brand_search" class="form-label">Merk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('brand_name') is-invalid @enderror" 
                                   id="brand_search" placeholder="Zoek naar een automerk...">
                            <input type="hidden" name="brand_name" id="brand_name" value="{{ old('brand_name') }}">
                            <div id="brand_results" class="list-group mt-1" style="display: none;"></div>
                            <div id="search_info" class="form-text text-muted mt-1"></div>
                            @error('brand_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Begin te typen om merken te zoeken.</div>
                        </div>

                        <!-- Model selecteren -->
                        <div class="mb-3">
                            <label for="type_select" class="form-label">Model <span class="text-danger">*</span></label>
                            <select class="form-select @error('type_name') is-invalid @enderror" 
                                    id="type_select" name="type_name" disabled>
                                <option value="">Selecteer eerst een merk...</option>
                            </select>
                            @error('type_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text" id="model_info" style="display: none;">
                                <small class="text-muted"><i class="fas fa-spinner fa-spin"></i> Modellen laden...</small>
                            </div>
                        </div>

                        <!-- Jaar -->
                        <div class="mb-3">
                            <label for="year" class="form-label">Bouwjaar <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                   id="year" name="year" value="{{ old('year') }}" 
                                   min="1900" max="{{ date('Y') + 1 }}" required>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nummerplaat -->
                        <div class="mb-3">
                            <label for="numberplate" class="form-label">Nummerplaat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('numberplate') is-invalid @enderror" 
                                   id="numberplate" name="numberplate" value="{{ old('numberplate') }}" 
                                   placeholder="1-ABC-123" required>
                            @error('numberplate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Brandstof -->
                        <div class="mb-3">
                            <label for="fuel" class="form-label">Brandstoftype <span class="text-danger">*</span></label>
                            <select class="form-select @error('fuel') is-invalid @enderror" id="fuel" name="fuel" required>
                                <option value="">Selecteer brandstoftype</option>
                                @foreach($fuels as $fuel)
                                    <option value="{{ $fuel }}" {{ old('fuel') == $fuel ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', '/', $fuel)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fuel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Chassisnummer (optioneel) -->
                        <div class="mb-3">
                            <label for="chasis_number" class="form-label">Chassisnummer (optioneel)</label>
                            <input type="text" class="form-control @error('chasis_number') is-invalid @enderror" 
                                   id="chasis_number" name="chasis_number" value="{{ old('chasis_number') }}" 
                                   placeholder="VIN nummer">
                            @error('chasis_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Het Vehicle Identification Number (VIN) van je voertuig</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cars.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Terug
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                <i class="fas fa-save"></i> Wagen Toevoegen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const brandSearch = document.getElementById('brand_search');
    const brandName = document.getElementById('brand_name');
    const brandResults = document.getElementById('brand_results');
    const typeSelect = document.getElementById('type_select');
    const modelInfo = document.getElementById('model_info');
    const submitBtn = document.getElementById('submitBtn');
    const searchInfo = document.getElementById('search_info');

    let searchTimeout;

    // Check form validity
    function checkFormValidity() {
        const isValid = brandName.value && typeSelect.value && 
                       document.getElementById('year').value &&
                       document.getElementById('numberplate').value &&
                       document.getElementById('fuel').value;
        submitBtn.disabled = !isValid;
    }

    // Function to search brands
    function searchBrands(forceApi = false) {
        const query = brandSearch.value.trim();
        
        if (query.length < 2) {
            brandResults.style.display = 'none';
            searchInfo.textContent = '';
            return;
        }

        // Show loading state
        searchInfo.textContent = forceApi ? 'Zoeken via API...' : 'Zoeken...';

        const url = `/search-brands?q=${encodeURIComponent(query)}${forceApi ? '&force_api=true' : ''}`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                brandResults.innerHTML = '';
                
                // Show search info - simplified
                let infoText = `Gevonden: ${data.total_count}`;
                
                if (data.api_error) {
                    infoText += ` - API fout: ${data.api_error}`;
                }
                
                searchInfo.textContent = infoText;
                
                if (data.brands && data.brands.length > 0) {
                    data.brands.forEach(brand => {
                        const item = document.createElement('a');
                        item.className = 'list-group-item list-group-item-action';
                        item.textContent = brand;
                        item.href = '#';
                        item.addEventListener('click', function(e) {
                            e.preventDefault();
                            selectBrand(brand);
                        });
                        brandResults.appendChild(item);
                    });
                    brandResults.style.display = 'block';
                } else {
                    brandResults.style.display = 'none';
                    if (data.total_count === 0) {
                        searchInfo.textContent = 'Geen merken gevonden. Probeer een andere zoekterm.';
                    }
                }
            })
            .catch(error => {
                console.error('Error searching brands:', error);
                brandResults.style.display = 'none';
                searchInfo.textContent = 'Fout bij zoeken. Probeer opnieuw.';
            });
    }

    // Function to select a brand
    function selectBrand(brand) {
        brandSearch.value = brand;
        brandName.value = brand;
        brandResults.style.display = 'none';
        
        // Load models for selected brand
        loadModels(brand);
        
        checkFormValidity();
    }

    // Brand search input event
    brandSearch.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            brandResults.style.display = 'none';
            searchInfo.textContent = '';
            return;
        }

        searchTimeout = setTimeout(() => {
            searchBrands(false);
        }, 500);
    });

    // Enter key for brand search
    brandSearch.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(searchTimeout);
            searchBrands(true); // Force API search on Enter
        }
    });

    // Model selection
    typeSelect.addEventListener('change', function() {
        checkFormValidity();
    });

    // Load models for selected brand
    function loadModels(brand) {
        // Show loading state
        typeSelect.disabled = true;
        typeSelect.innerHTML = '<option value="">Modellen laden...</option>';
        modelInfo.style.display = 'block';
        
        fetch(`/search-models?brand=${encodeURIComponent(brand)}`)
            .then(response => response.json())
            .then(models => {
                // Clear and populate dropdown
                typeSelect.innerHTML = '<option value="">Selecteer een model...</option>';
                
                if (models.length > 0) {
                    models.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model;
                        option.textContent = model;
                        typeSelect.appendChild(option);
                    });
                    typeSelect.disabled = false;
                    modelInfo.innerHTML = `<small class="text-success"><i class="fas fa-check"></i> ${models.length} modellen geladen</small>`;
                } else {
                    typeSelect.innerHTML = '<option value="">Geen modellen gevonden</option>';
                    modelInfo.innerHTML = '<small class="text-warning"><i class="fas fa-exclamation-triangle"></i> Geen modellen beschikbaar voor dit merk</small>';
                }
                
                checkFormValidity();
            })
            .catch(error => {
                console.error('Error loading models:', error);
                typeSelect.innerHTML = '<option value="">Fout bij laden modellen</option>';
                modelInfo.innerHTML = '<small class="text-danger"><i class="fas fa-times"></i> Fout bij laden van modellen</small>';
            });
    }

    // Hide dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!brandSearch.contains(e.target) && !brandResults.contains(e.target)) {
            brandResults.style.display = 'none';
        }
    });

    // Check form validity on other input changes
    document.querySelectorAll('#year, #numberplate, #fuel').forEach(input => {
        input.addEventListener('change', checkFormValidity);
        input.addEventListener('input', checkFormValidity);
    });

    // Set initial values if form was submitted with errors
    if (brandName.value) {
        brandSearch.value = brandName.value;
        loadModels(brandName.value);
    }
    
    // Set selected model if form had errors
    const oldTypeName = '{{ old("type_name") }}';
    if (oldTypeName) {
        // Wait a bit for models to load, then select the old value
        setTimeout(() => {
            typeSelect.value = oldTypeName;
            checkFormValidity();
        }, 1000);
    }
    
    checkFormValidity();
});
</script>
@endsection 