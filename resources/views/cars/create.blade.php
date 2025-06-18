@extends('layouts.app')

@section('title', 'Nieuwe Wagen Toevoegen')

@section('content')
<div class="min-h-screen bg-black">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 py-20">
        <!-- Hero Section -->
        <div class="text-center mb-20">
            <h1 class="text-5xl lg:text-7xl font-black uppercase tracking-widest mb-8">
                NIEUWE WAGEN
            </h1>
            <p class="text-xl text-gray-300 font-light tracking-wide">TOEVOEGEN</p>
            <div class="w-32 h-1 bg-white mx-auto mt-8"></div>
        </div>

        <!-- Form Card -->
        <div class="bg-gray-900/30 border border-gray-800 p-8 lg:p-12 rounded-lg">
            <form action="{{ route('cars.store') }}" method="POST" id="carForm">
                @csrf
                
                <!-- Merk zoeken -->
                <div class="mb-8">
                    <label for="brand_search" class="block text-sm text-gray-400 uppercase tracking-wide mb-3">
                        Merk <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" class="w-full bg-gray-800/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('brand_name') border-red-500 @enderror" 
                               id="brand_search" placeholder="Zoek naar een automerk...">
                        <input type="hidden" name="brand_name" id="brand_name" value="{{ old('brand_name') }}">
                        <div id="brand_results" class="absolute top-full left-0 w-full mt-1 bg-gray-800 border border-gray-700 rounded-lg shadow-xl z-10" style="display: none;"></div>
                    </div>
                    <div id="search_info" class="text-sm text-gray-400 mt-2"></div>
                    @error('brand_name')
                        <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                    @enderror
                    <div class="text-sm text-gray-500 mt-2">Begin te typen om merken te zoeken.</div>
                </div>

                <!-- Model selecteren -->
                <div class="mb-8">
                    <label for="type_select" class="block text-sm text-gray-400 uppercase tracking-wide mb-3">
                        Model <span class="text-red-400">*</span>
                    </label>
                    <select class="w-full bg-gray-800/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('type_name') border-red-500 @enderror" 
                            id="type_select" name="type_name" disabled>
                        <option value="">Selecteer eerst een merk...</option>
                    </select>
                    @error('type_name')
                        <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                    @enderror
                    <div class="text-sm mt-2" id="model_info" style="display: none;">
                        <span class="text-gray-400"><i class="fas fa-spinner fa-spin mr-2"></i>Modellen laden...</span>
                    </div>
                </div>

                <!-- Jaar -->
                <div class="mb-8">
                    <label for="year" class="block text-sm text-gray-400 uppercase tracking-wide mb-3">
                        Bouwjaar <span class="text-red-400">*</span>
                    </label>
                    <input type="number" class="w-full bg-gray-800/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('year') border-red-500 @enderror" 
                           id="year" name="year" value="{{ old('year') }}" 
                           min="1900" max="{{ date('Y') + 1 }}" required>
                    @error('year')
                        <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nummerplaat -->
                <div class="mb-8">
                    <label for="numberplate" class="block text-sm text-gray-400 uppercase tracking-wide mb-3">
                        Nummerplaat <span class="text-red-400">*</span>
                    </label>
                    <input type="text" class="w-full bg-gray-800/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('numberplate') border-red-500 @enderror" 
                           id="numberplate" name="numberplate" value="{{ old('numberplate') }}" 
                           placeholder="1-ABC-123" required>
                    @error('numberplate')
                        <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Brandstof -->
                <div class="mb-8">
                    <label for="fuel" class="block text-sm text-gray-400 uppercase tracking-wide mb-3">
                        Brandstoftype <span class="text-red-400">*</span>
                    </label>
                    <select class="w-full bg-gray-800/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('fuel') border-red-500 @enderror" id="fuel" name="fuel" required>
                        <option value="">Selecteer brandstoftype</option>
                        @foreach($fuels as $fuel)
                            <option value="{{ $fuel }}" {{ old('fuel') == $fuel ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', '/', $fuel)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('fuel')
                        <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Chassisnummer (optioneel) -->
                <div class="mb-12">
                    <label for="chasis_number" class="block text-sm text-gray-400 uppercase tracking-wide mb-3">
                        Chassisnummer (optioneel)
                    </label>
                    <input type="text" class="w-full bg-gray-800/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('chasis_number') border-red-500 @enderror" 
                           id="chasis_number" name="chasis_number" value="{{ old('chasis_number') }}" 
                           placeholder="VIN nummer">
                    @error('chasis_number')
                        <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                    @enderror
                    <div class="text-sm text-gray-500 mt-2">Het Vehicle Identification Number (VIN) van je voertuig</div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-between gap-4">
                    <a href="{{ route('cars.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-8 py-3 font-medium uppercase tracking-wider transition-colors duration-300 rounded-lg text-center">
                        <i class="fas fa-arrow-left mr-2"></i>Terug
                    </a>
                    <button type="submit" class="bg-pblue hover:bg-gray-200 text-black px-8 py-3 font-medium uppercase tracking-wider transition-colors duration-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn" disabled>
                        <i class="fas fa-save mr-2"></i>Wagen Toevoegen
                    </button>
                </div>
            </form>
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
                        item.className = 'block px-4 py-3 text-white hover:bg-gray-700 transition-colors duration-200 border-b border-gray-700 last:border-b-0';
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
                    modelInfo.innerHTML = `<span class="text-green-400"><i class="fas fa-check mr-2"></i>${models.length} modellen geladen</span>`;
                } else {
                    typeSelect.innerHTML = '<option value="">Geen modellen gevonden</option>';
                    modelInfo.innerHTML = '<span class="text-yellow-400"><i class="fas fa-exclamation-triangle mr-2"></i>Geen modellen beschikbaar voor dit merk</span>';
                }
                
                checkFormValidity();
            })
            .catch(error => {
                console.error('Error loading models:', error);
                typeSelect.innerHTML = '<option value="">Fout bij laden modellen</option>';
                modelInfo.innerHTML = '<span class="text-red-400"><i class="fas fa-times mr-2"></i>Fout bij laden van modellen</span>';
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