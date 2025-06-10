<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Registreren')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
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
                                max="{{ date('Y-m-d', strtotime('-18 years')) }}">
                                <small class="form-text text-muted">Je moet minstens 18 jaar oud zijn.</small>
                                @error('bday')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">BTW Nummer (optioneel)</label>
                                <input type="text" 
                                    class="form-control vat-input @error('vat') is-invalid @enderror" 
                                    name="vat" 
                                    id="userVatInput"
                                    placeholder="BE 0123.456.789" 
                                    value="{{ old('vat') }}">
                                @error('vat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Mechanic Specific Fields -->
                        <div id="mechanic-fields" style="display:none;">
                            <hr class="my-4">
                            <h5 class="mb-3">Professionele gegevens</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Bedrijfsnaam</label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" placeholder="Garage De Smet" value="{{ old('company_name') }}" data-required="true">
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">BTW Nummer</label>
                                <input type="text" 
                                    class="form-control vat-input @error('vat') is-invalid @enderror" 
                                    name="vat" 
                                    id="mechanicVatInput"
                                    placeholder="BE 0123.456.789" 
                                    value="{{ old('vat') }}"
                                    data-required="true">
                                @error('vat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adres</label>
                                <textarea class="form-control @error('adress') is-invalid @enderror" name="adress" rows="3" placeholder="Straat 123&#10;2000 Antwerpen" data-required="true">{{ old('adress') }}</textarea>
                                @error('adress')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telefoon <span class="text-danger">*</span></label>
                                <input type="tel" 
                                    class="form-control @error('telephone') is-invalid @enderror" 
                                    name="telephone" 
                                    id="phoneInput"
                                    placeholder="+32 123 45 67 89" 
                                    value="{{ old('telephone') }}"
                                    oninput="formatPhoneNumber(this)">
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
function showForm(role) {
    document.getElementById('user-fields').style.display = 'none';
    document.getElementById('mechanic-fields').style.display = 'none';

    if (role === 'user') {
        document.getElementById('user-fields').style.display = 'block';
        setFieldsRequired('user-fields', true);
        setFieldsRequired('mechanic-fields', false);
    } else if (role === 'mechanic') {
        document.getElementById('mechanic-fields').style.display = 'block';
        setFieldsRequired('mechanic-fields', true);
        setFieldsRequired('user-fields', false);
    }
}

function setFieldsRequired(containerId, required) {
    const container = document.getElementById(containerId);
    const fields = container.querySelectorAll('[data-required="true"]');
    fields.forEach(input => {
        if (required) {
            input.setAttribute('required', 'required');
        } else {
            input.removeAttribute('required');
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const selectedRole = document.querySelector('input[name="role"]:checked');
    if (selectedRole) {
        showForm(selectedRole.value);
    }
});

// BTW formatting for alle vat inputs
document.querySelectorAll('.vat-input').forEach(function(input) {
    input.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^\dBE]/gi, '').toUpperCase();
        
        // Zorg dat "BE" aanwezig is (voeg toe als het ontbreekt)
        if (!value.startsWith('BE')) {
            value = 'BE' + value.replace(/BE/gi, '');
        }
        
        // Neem alleen de cijfers na "BE"
        const numbers = value.substring(2).replace(/\D/g, '');
        
        let formatted = numbers;

        if (numbers.length > 3) {
            formatted = numbers.substring(0, 4) + 
                       (numbers.length > 4 ? '.' + numbers.substring(4, 7) : '') + 
                       (numbers.length > 7 ? '.' + numbers.substring(7, 10) : '');
        }
        
        e.target.value = 'BE ' + formatted;
    });
});


function formatPhoneNumber(input) {
    // Verwijder alles behalve cijfers en +
    let value = input.value.replace(/[^\d+]/g, '');
    
    // Zorg dat +32 aanwezig is (voeg toe als het ontbreekt)
    if (!value.startsWith('+32')) {
        value = '+32' + value.replace(/^\+32/, '');
    }
    
    // Neem alleen de cijfers na +32
    const numbers = value.substring(3).replace(/\D/g, '');
    
    // Formatteer als +32 XXX XX XX XX
    let formatted = '+32';
    if (numbers.length > 0) {
        formatted += ' ' + numbers.substring(0, 3);
    }
    if (numbers.length > 3) {
        formatted += ' ' + numbers.substring(3, 5);
    }
    if (numbers.length > 5) {
        formatted += ' ' + numbers.substring(5, 7);
    }
    if (numbers.length > 7) {
        formatted += ' ' + numbers.substring(7, 9);
    }
    
    // Update input value
    input.value = formatted;
    
    // Sla op in hidden field zonder spaties
    document.getElementById('phoneHidden').value = '+32' + numbers;
}

</script>
@endsection