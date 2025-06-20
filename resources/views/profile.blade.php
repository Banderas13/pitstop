@extends('layouts.app')

@section('title', 'Instellingen')

@section('content')
    <div class="min-h-screen bg-black">
        <!-- Hero Section -->
        <section class="pt-32">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20">
                    <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(01)</p>
                    <h1 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                        ACCOUNT<br>INSTELLINGEN
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-300 font-light tracking-wide mb-8">
                        Beheer je account instellingen en persoonlijke gegevens
                    </p>
                    <div class="w-32 h-1 bg-white mx-auto"></div>
                </div>
            </div>
        </section>

        <!-- Profile Forms Section -->
        <section class="pb-32">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-900/50 border border-green-800 text-green-200 px-6 py-4 mb-8 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-900/50 border border-red-800 text-red-200 px-6 py-4 mb-8 rounded-lg">
                        <ul class="mb-0 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Auth::guard('mechanic')->check())
                    <!-- Mechanic Profile Forms -->
                    <div class="space-y-8">
                        <!-- Personal Information Form -->
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <form method="POST" action="{{ route('profile.update.name') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="text-center mb-8">
                                    <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">PERSOONLIJKE GEGEVENS</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Naam</label>
                                        <input type="text" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('name') border-red-500 @enderror" 
                                               name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Telefoonnummer</label>
                                        <input type="tel" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('telephone') border-red-500 @enderror" 
                                               name="telephone" value="{{ old('telephone', $user->telephone) }}" required>
                                        @error('telephone')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Bedrijfsnaam</label>
                                        <input type="text" class="w-full bg-gray-800/50 border border-gray-700 text-gray-400 px-4 py-3 rounded-lg cursor-not-allowed" 
                                               value="{{ $user->company_name }}" readonly>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">BTW nummer</label>
                                        <input type="text" class="w-full bg-gray-800/50 border border-gray-700 text-gray-400 px-4 py-3 rounded-lg cursor-not-allowed" 
                                               value="{{ $user->vat }}" readonly>
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Adres</label>
                                        <input type="text" class="w-full bg-gray-800/50 border border-gray-700 text-gray-400 px-4 py-3 rounded-lg cursor-not-allowed" 
                                               value="{{ $user->adress }}" readonly>
                                    </div>
                                </div>

                                <div class="text-center mt-8">
                                    <button type="submit" class="inline-block bg-pblue text-black px-8 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded">
                                        Gegevens bijwerken
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Email Update Form -->
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <form method="POST" action="{{ route('profile.update.email') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="text-center mb-8">
                                    <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">E-MAILADRES WIJZIGEN</h2>
                                </div>

                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Nieuw e-mailadres</label>
                                        <input type="email" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('email') border-red-500 @enderror" 
                                               name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Huidig wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('current_password') border-red-500 @enderror" 
                                               name="current_password" required>
                                        @error('current_password')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center mt-8">
                                    <button type="submit" class="inline-block bg-pblue text-black px-8 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded">
                                        E-mailadres bijwerken
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Password Update Form -->
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <form method="POST" action="{{ route('profile.update.password') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="text-center mb-8">
                                    <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">WACHTWOORD WIJZIGEN</h2>
                                </div>

                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Huidig wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('current_password') border-red-500 @enderror" 
                                               name="current_password" required>
                                        @error('current_password')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Nieuw wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('password') border-red-500 @enderror" 
                                               name="password" required>
                                        @error('password')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Bevestig nieuw wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300" 
                                               name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="text-center mt-8">
                                    <button type="submit" class="inline-block bg-pblue text-black px-8 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded">
                                        Wachtwoord bijwerken
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Regular User Profile Forms -->
                    <div class="space-y-8">
                        <!-- Name Update Form -->
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <form method="POST" action="{{ route('profile.update.name') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="text-center mb-8">
                                    <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">NAAM WIJZIGEN</h2>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Nieuwe naam</label>
                                    <input type="text" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('name') border-red-500 @enderror" 
                                           name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="text-center mt-8">
                                    <button type="submit" class="inline-block bg-pblue text-black px-8 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded">
                                        Naam bijwerken
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Email Update Form -->
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <form method="POST" action="{{ route('profile.update.email') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="text-center mb-8">
                                    <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">E-MAILADRES WIJZIGEN</h2>
                                </div>

                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Nieuw e-mailadres</label>
                                        <input type="email" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('email') border-red-500 @enderror" 
                                               name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Huidig wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('current_password') border-red-500 @enderror" 
                                               name="current_password" required>
                                        @error('current_password')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center mt-8">
                                    <button type="submit" class="inline-block bg-pblue text-black px-8 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded">
                                        E-mailadres bijwerken
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Password Update Form -->
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <form method="POST" action="{{ route('profile.update.password') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="text-center mb-8">
                                    <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">WACHTWOORD WIJZIGEN</h2>
                                </div>

                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Huidig wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('current_password') border-red-500 @enderror" 
                                               name="current_password" required>
                                        @error('current_password')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Nieuw wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('password') border-red-500 @enderror" 
                                               name="password" required>
                                        @error('password')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Bevestig nieuw wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300" 
                                               name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="text-center mt-8">
                                    <button type="submit" class="inline-block bg-pblue text-black px-8 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded">
                                        Wachtwoord bijwerken
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                        <!-- Delete Account Section -->
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg mt-8">
                            <div class="text-center mb-8">
                                <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">ACCOUNT VERWIJDEREN</h2>
                            </div>
                            
                            <div class="text-center mb-8">
                                <p class="text-red-600 text-lg">Let op: Het verwijderen van je account is permanent en kan niet ongedaan worden gemaakt.</p>
                            </div>
                            
                            <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('Weet je zeker dat je je account wilt verwijderen? Dit kan niet ongedaan worden gemaakt.');">
                                @csrf
                                @method('DELETE')
                                
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Bevestig je wachtwoord</label>
                                        <input type="password" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('current_password') border-red-500 @enderror" 
                                               name="current_password" required>
                                        @error('current_password')
                                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center mt-8">
                                    <button type="submit" class="inline-block bg-pblue text-black px-8 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded">
                                        Account Verwijderen
                                    </button>
                                </div>
                            </form>
                        </div>
            </div>
        </section>
    </div>
@endsection
