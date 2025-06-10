<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Registreren')

@section('content')
<div class="container">
    <div class="text-center py-3">
        <h1 class="h2 fw-bold mb-2">Registreren bij Pitstop</h1>
        <p class="mb-3">
            Maak een account aan als <strong>gebruiker</strong> of <strong>monteur</strong>
        </p>
        <hr class="w-25 mx-auto my-3">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ik ben een:</label>
                            <div class="d-flex gap-4 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" value="user" id="user" onclick="showForm('user')" {{ old('role') == 'user' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="user">
                                        Gebruiker
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" value="mechanic" id="mechanic" onclick="showForm('mechanic')" {{ old('role') == 'mechanic' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="mechanic">
                                        Monteur
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Common Fields -->
                        <div id="common-fields">
                            <div class="mb-3">
                                <label class="form-label">Naam</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Voer je volledige naam in" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="naam@voorbeeld.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Wachtwoord</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kies een sterk wachtwoord" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bevestig wachtwoord</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Herhaal je wachtwoord" required>
                            </div>
                        </div>

                        <!-- User Specific Fields -->
                        <div id="user-fields" style="display:none;">
                            <hr class="my-3">
                            <h6 class="mb-2">Persoonlijke gegevens</h6>
                            
                            <div class="mb-2">
                                <label class="form-label">Geboortedatum</label>
                                <input type="date" class="form-control @error('bday') is-invalid @enderror" name="bday" value="{{ old('bday') }}"
                                min="{{ date('Y-m-d', strtotime('-100 years')) }}" 
                                max="{{ date('Y-m-d') }}">
                                @error('bday')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">BTW Nummer (optioneel)</label>
                                <input type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" placeholder="BE0123456789" value="{{ old('vat') }}">
                                @error('vat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6 class="mb-2">Jouw voertuigen</h6>
                            <div id="cars">
                                <div class="car mb-2">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">Merk</label>
                                            <select class="form-select form-select-sm @error('cars.0.brand_id') is-invalid @enderror" name="cars[0][brand_id]" onchange="loadTypes(this, 0)">
                                                <option value="">Selecteer merk</option>
                                                @if(isset($brands))
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ old('cars.0.brand_id') == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('cars.0.brand_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Type</label>
                                            <select class="form-select form-select-sm @error('cars.0.type_id') is-invalid @enderror" name="cars[0][type_id]">
                                                <option value="">Selecteer eerst een merk</option>
                                            </select>
                                            @error('cars.0.type_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-2 mt-1">
                                        <div class="col-4">
                                            <label class="form-label">Jaar</label> 
                                            <input type="number" class="form-control form-control-sm @error('cars.0.year') is-invalid @enderror" name="cars[0][year]" placeholder="2020" min="1900" max="{{ date('Y') }}" value="{{ old('cars.0.year') }}">
                                            @error('cars.0.year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Chassis (optioneel)</label>
                                            <input type="text" class="form-control form-control-sm @error('cars.0.chasis_number') is-invalid @enderror" name="cars[0][chasis_number]" placeholder="WBA12345..." maxlength="17" value="{{ old('cars.0.chasis_number') }}">
                                            @error('cars.0.chasis_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Nummerplaat</label>
                                            <input type="text" class="form-control form-control-sm @error('cars.0.numberplate') is-invalid @enderror" name="cars[0][numberplate]" placeholder="1-ABC-123" value="{{ old('cars.0.numberplate') }}">
                                            @error('cars.0.numberplate')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-2 mt-1">
                                        <div class="col-12">
                                            <label class="form-label">Brandstof</label>
                                            <select class="form-select form-select-sm @error('cars.0.fuel') is-invalid @enderror" name="cars[0][fuel]">
                                                <option value="">Selecteer brandstof</option>
                                                <option value="gasoline" {{ old('cars.0.fuel') == 'gasoline' ? 'selected' : '' }}>Benzine</option>
                                                <option value="diesel" {{ old('cars.0.fuel') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                                <option value="electric" {{ old('cars.0.fuel') == 'electric' ? 'selected' : '' }}>Elektrisch</option>
                                                <option value="hybrid/diesel" {{ old('cars.0.fuel') == 'hybrid/diesel' ? 'selected' : '' }}>Hybrid/Diesel</option>
                                                <option value="hybrid/gasoline" {{ old('cars.0.fuel') == 'hybrid/gasoline' ? 'selected' : '' }}>Hybrid/Benzine</option>
                                                <option value="lpg" {{ old('cars.0.fuel') == 'lpg' ? 'selected' : '' }}>LPG</option>
                                                <option value="hydrogen" {{ old('cars.0.fuel') == 'hydrogen' ? 'selected' : '' }}>Waterstof</option>
                                            </select>
                                            @error('cars.0.fuel')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mb-3" onclick="addCar()">
                                + Voeg nog een auto toe
                            </button>
                        </div>

                        <!-- Mechanic Specific Fields -->
                        <div id="mechanic-fields" style="display:none;">
                            <hr class="my-4">
                            <h5 class="mb-3">Professionele gegevens</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Bedrijfsnaam</label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" placeholder="Garage De Smet" value="{{ old('company_name') }}">
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">BTW Nummer</label>
                                <input type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" placeholder="BE0123456789" value="{{ old('vat') }}" required>
                                @error('vat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adres</label>
                                <textarea class="form-control @error('adress') is-invalid @enderror" name="adress" rows="3" placeholder="Straat 123&#10;2000 Antwerpen" required>{{ old('adress') }}</textarea>
                                @error('adress')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telefoon</label>
                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" placeholder="+32 123 45 67 89" value="{{ old('telephone') }}" required>
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Registreren
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center py-3">
        <p>
            Heb je al een account? <a href="{{ route('login') }}" class="text-decoration-none">Log hier in</a>
        </p>
    </div>
</div>

<script>
// Store types data for dynamic loading
let typesData = @json($types ?? []);

function showForm(role) {
    // Verberg beide secties eerst
    document.getElementById('user-fields').style.display = 'none';
    document.getElementById('mechanic-fields').style.display = 'none';
    
    // Toon de juiste sectie
    if (role === 'user') {
        document.getElementById('user-fields').style.display = 'block';
        // Maak user velden required
        setFieldsRequired('user-fields', true);
        setFieldsRequired('mechanic-fields', false);
    } else if (role === 'mechanic') {
        document.getElementById('mechanic-fields').style.display = 'block';
        // Maak mechanic velden required
        setFieldsRequired('mechanic-fields', true);
        setFieldsRequired('user-fields', false);
    }
}

function setFieldsRequired(containerId, required) {
    const container = document.getElementById(containerId);
    const requiredInputs = container.querySelectorAll('input[data-required="true"], select[data-required="true"], textarea[data-required="true"]');
    requiredInputs.forEach(input => {
        if (required) {
            input.setAttribute('required', 'required');
        } else {
            input.removeAttribute('required');
        }
    });
}

function loadTypes(brandSelect, index) {
    const brandId = brandSelect.value;
    const typeSelect = document.querySelector(`select[name="cars[${index}][type_id]"]`);
    
    // Clear existing options
    typeSelect.innerHTML = '<option value="">Selecteer type</option>';
    
    if (brandId && typesData) {
        const filteredTypes = typesData.filter(type => type.brand_id == brandId);
        filteredTypes.forEach(type => {
            const option = document.createElement('option');
            option.value = type.id;
            option.textContent = type.name;
            typeSelect.appendChild(option);
        });
    }
}

function addCar() {
    const cars = document.getElementById('cars');
    const index = cars.children.length;
    const div = document.createElement('div');
    div.classList.add('car', 'mb-2');
    
    const brandsOptions = @json(isset($brands) ? $brands->map(fn($brand) => ['id' => $brand->id, 'name' => $brand->name]) : []);
    let brandsHtml = '<option value="">Selecteer merk</option>';
    brandsOptions.forEach(brand => {
        brandsHtml += `<option value="${brand.id}">${brand.name}</option>`;
    });
    
    div.innerHTML = `
        <hr class="my-2">
        <div class="row g-2">
            <div class="col-6">
                <label class="form-label">Merk</label>
                <select class="form-select form-select-sm" name="cars[${index}][brand_id]" onchange="loadTypes(this, ${index})">
                    ${brandsHtml}
                </select>
            </div>
            <div class="col-6">
                <label class="form-label">Type</label>
                <select class="form-select form-select-sm" name="cars[${index}][type_id]">
                    <option value="">Selecteer eerst een merk</option>
                </select>
            </div>
        </div>
        <div class="row g-2 mt-1">
            <div class="col-4">
                <label class="form-label">Jaar</label>
                <input type="number" class="form-control form-control-sm" name="cars[${index}][year]" placeholder="2020" min="1900" max="{{ date('Y') }}">
            </div>
            <div class="col-4">
                <label class="form-label">Chassis (optioneel)</label>
                <input type="text" class="form-control form-control-sm" name="cars[${index}][chasis_number]" placeholder="WBA12345..." maxlength="17">
            </div>
            <div class="col-4">
                <label class="form-label">Nummerplaat</label>
                <input type="text" class="form-control form-control-sm" name="cars[${index}][numberplate]" placeholder="1-ABC-123">
            </div>
        </div>
        <div class="row g-2 mt-1">
            <div class="col-8">
                <label class="form-label">Brandstof</label>
                <select class="form-select form-select-sm" name="cars[${index}][fuel]">
                    <option value="">Selecteer brandstof</option>
                    <option value="gasoline">Benzine</option>
                    <option value="diesel">Diesel</option>
                    <option value="electric">Elektrisch</option>
                    <option value="hybrid/diesel">Hybrid/Diesel</option>
                    <option value="hybrid/gasoline">Hybrid/Benzine</option>
                    <option value="lpg">LPG</option>
                    <option value="hydrogen">Waterstof</option>
                </select>
            </div>
            <div class="col-4 d-flex align-items-end">
                <button type="button" class="btn btn-outline-danger btn-sm w-100" onclick="removeCar(this)">
                    Verwijder
                </button>
            </div>
        </div>
    `;
    cars.appendChild(div);
}

function removeCar(button) {
    button.closest('.car').remove();
    // Herindex de overgebleven auto's
    reindexCars();
}

function reindexCars() {
    const cars = document.querySelectorAll('#cars .car');
    cars.forEach((car, index) => {
        // Update alle name attributes
        const inputs = car.querySelectorAll('input, select');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name && name.includes('cars[')) {
                const newName = name.replace(/cars\[\d+\]/, `cars[${index}]`);
                input.setAttribute('name', newName);
            }
        });
        
        // Update onchange handler for brand select
        const brandSelect = car.querySelector('select[name*="brand_id"]');
        if (brandSelect) {
            brandSelect.setAttribute('onchange', `loadTypes(this, ${index})`);
        }
    });
}

// Initialiseer de form op basis van geselecteerde role bij page load
document.addEventListener('DOMContentLoaded', function() {
    const selectedRole = document.querySelector('input[name="role"]:checked');
    if (selectedRole) {
        showForm(selectedRole.value);
    }
});
</script>
@endsection