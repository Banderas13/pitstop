<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Registreren')

@section('content')

@if(session('success'))
    <div class="bg-green-900/50 border border-green-800 text-green-200 px-6 py-4 mx-6 lg:mx-8 mt-8 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="min-h-screen bg-black">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
        <!-- Hero Section -->
        <div class="text-center mb-20">
            <h1 class="text-4xl lg:text-6xl font-black uppercase tracking-widest mb-8">
                REGISTREREN
            </h1>
            <p class="text-xl lg:text-2xl text-gray-300 font-light tracking-wide mb-4">
                Maak een account aan als <strong class="text-pblue">gebruiker</strong> of <strong class="text-pblue">monteur</strong>
            </p>
            <div class="w-32 h-1 bg-white mx-auto"></div>
        </div>

        <!-- Register Form -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg">
                @if ($errors->any())
                    <div class="bg-red-900/50 border border-red-800 text-red-200 px-6 py-4 rounded-lg mb-8">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Role Selection -->
                    <div class="mb-8">
                        <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-4">Ik ben een:</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center p-4 bg-black/50 border border-gray-700 rounded-lg cursor-pointer hover:border-pblue transition-colors duration-300">
                                <input class="text-pblue focus:ring-pblue focus:ring-offset-0 mr-3" type="radio" name="role" value="user" id="user" onclick="showForm('user')" {{ old('role') == 'user' ? 'checked' : '' }}>
                                <span class="text-gray-300 font-medium">Gebruiker</span>
                            </label>
                            <label class="flex items-center p-4 bg-black/50 border border-gray-700 rounded-lg cursor-pointer hover:border-pblue transition-colors duration-300">
                                <input class="text-pblue focus:ring-pblue focus:ring-offset-0 mr-3" type="radio" name="role" value="mechanic" id="mechanic" onclick="showForm('mechanic')" {{ old('role') == 'mechanic' ? 'checked' : '' }}>
                                <span class="text-gray-300 font-medium">Monteur</span>
                            </label>
                        </div>
                    </div>

                    <div class="w-full h-px bg-gray-700 mb-8"></div>

                    <!-- Common Fields -->
                    <div id="common-fields">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Naam</label>
                                <input type="text" 
                                       class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('name') border-red-500 @enderror" 
                                       name="name" 
                                       placeholder="Voer je volledige naam in" 
                                       value="{{ old('name') }}" 
                                       required>
                                @error('name')
                                    <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Email</label>
                                <input type="email" 
                                       class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('email') border-red-500 @enderror" 
                                       name="email" 
                                       placeholder="naam@voorbeeld.com" 
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Wachtwoord</label>
                                <input type="password" 
                                       class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('password') border-red-500 @enderror" 
                                       name="password" 
                                       placeholder="Kies een sterk wachtwoord" 
                                       required>
                                @error('password')
                                    <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Bevestig wachtwoord</label>
                                <input type="password" 
                                       class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300" 
                                       name="password_confirmation" 
                                       placeholder="Herhaal je wachtwoord" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- User Specific Fields -->
                    <div id="user-fields" style="display:none;">
                        <div class="w-full h-px bg-gray-700 mb-8"></div>
                        <div class="text-center mb-6">
                            <h3 class="text-lg font-bold uppercase tracking-wider text-chiffon">Persoonlijke gegevens</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Geboortedatum</label>
                                <input type="date" 
                                       class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('bday') border-red-500 @enderror" 
                                       name="bday" 
                                       value="{{ old('bday') }}"
                                       min="{{ date('Y-m-d', strtotime('-100 years')) }}" 
                                       max="{{ date('Y-m-d', strtotime('-18 years')) }}">
                                <p class="text-gray-400 text-xs mt-2">Je moet minstens 18 jaar oud zijn.</p>
                                @error('bday')
                                    <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">BTW Nummer <span class="text-gray-500">(optioneel)</span></label>
                                <input type="text" 
                                       class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 vat-input @error('vat') border-red-500 @enderror" 
                                       name="vat" 
                                       id="userVatInput"
                                       placeholder="BE 0123.456.789" 
                                       value="{{ old('vat') }}">
                                @error('vat')
                                    <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Mechanic Specific Fields -->
                    <div id="mechanic-fields" style="display:none;">
                        <div class="w-full h-px bg-gray-700 mb-8"></div>
                        <div class="text-center mb-6">
                            <h3 class="text-lg font-bold uppercase tracking-wider text-chiffon">Professionele gegevens</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Bedrijfsnaam</label>
                                <input type="text" 
                                       class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('company_name') border-red-500 @enderror" 
                                       name="company_name" 
                                       placeholder="Garage De Smet" 
                                       value="{{ old('company_name') }}" 
                                       data-required="true">
                                @error('company_name')
                                    <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">BTW Nummer</label>
                                <input type="text" 
                                       class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 vat-input @error('vat') border-red-500 @enderror" 
                                       name="vat" 
                                       id="mechanicVatInput"
                                       placeholder="BE 0123.456.789" 
                                       value="{{ old('vat') }}"
                                       data-required="true">
                                @error('vat')
                                    <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Adres</label>
                            <textarea class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('adress') border-red-500 @enderror" 
                                      name="adress" 
                                      rows="3" 
                                      placeholder="Straat 123&#10;2000 Antwerpen" 
                                      data-required="true">{{ old('adress') }}</textarea>
                            @error('adress')
                                <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Telefoon <span class="text-red-400">*</span></label>
                            <input type="tel" 
                                   class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('telephone') border-red-500 @enderror" 
                                   name="telephone" 
                                   id="phoneInput"
                                   placeholder="+32 123 45 67 89" 
                                   value="{{ old('telephone') }}"
                                   oninput="formatPhoneNumber(this)">
                            @error('telephone')
                                <div class="text-red-400 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" class="w-full bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded-lg">
                            Registreren
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center py-8">
            <p class="text-gray-300">
                Heb je al een account? <a href="{{ route('login') }}" class="text-pblue hover:text-white transition-colors duration-300 font-medium">Log hier in</a>
            </p>
        </div>
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