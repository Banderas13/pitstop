<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Inloggen')

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
                WELKOM TERUG
            </h1>
            <p class="text-xl lg:text-2xl text-gray-300 font-light tracking-wide mb-4">
                Log in om je account te gebruiken als <strong class="text-pblue">gebruiker</strong> of <strong class="text-pblue">monteur</strong>
            </p>
            <div class="w-32 h-1 bg-white mx-auto"></div>
        </div>

        <!-- Login Form -->
        <div class="max-w-lg mx-auto">
            <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Email</label>
                        <input type="email" 
                               class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('email') border-red-500 @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="naam@voorbeeld.com" 
                               required 
                               autofocus>
                        @error('email')
                            <div class="text-red-400 text-sm mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label class="block text-gray-300 text-sm font-medium uppercase tracking-wider mb-3">Wachtwoord</label>
                        <input type="password" 
                               class="w-full bg-black/50 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300 @error('password') border-red-500 @enderror" 
                               name="password" 
                               placeholder="wachtwoord" 
                               required>
                        @error('password')
                            <div class="text-red-400 text-sm mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-8">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   class="rounded bg-black/50 border border-gray-700 text-pblue focus:ring-pblue focus:ring-offset-0" 
                                   name="remember" 
                                   {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-3 text-gray-300 text-sm">Onthoud mij</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-6">
                        <button type="submit" class="w-full bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded-lg">
                            Inloggen
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center py-8">
            <p class="text-gray-300 mb-6">
                Nog geen account? <a href="{{ route('register') }}" class="text-pblue hover:text-white transition-colors duration-300 font-medium">Registreer hier</a>
            </p>
            <div class="w-24 h-px bg-gray-700 mx-auto"></div>
        </div>

        <!-- Features Section -->
        <div class="max-w-4xl mx-auto mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                    <div class="text-center">
                        <h3 class="text-xl font-bold uppercase tracking-wider text-chiffon mb-4">Voor Gebruikers</h3>
                        <div class="space-y-3">
                            <div class="border-l-2 border-pblue pl-4 text-left">
                                <p class="text-gray-300 text-sm">✓ Vind gekwalificeerde monteurs</p>
                            </div>
                            <div class="border-l-2 border-pblue pl-4 text-left">
                                <p class="text-gray-300 text-sm">✓ Ontvang foto updates</p>
                            </div>
                            <div class="border-l-2 border-pblue pl-4 text-left">
                                <p class="text-gray-300 text-sm">✓ Digitale facturen</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                    <div class="text-center">
                        <h3 class="text-xl font-bold uppercase tracking-wider text-chiffon mb-4">Voor Monteurs</h3>
                        <div class="space-y-3">
                            <div class="border-l-2 border-pblue pl-4 text-left">
                                <p class="text-gray-300 text-sm">✓ Professioneel contact met klanten</p>
                            </div>
                            <div class="border-l-2 border-pblue pl-4 text-left">
                                <p class="text-gray-300 text-sm">✓ Deel reparatievoortgang</p>
                            </div>
                            <div class="border-l-2 border-pblue pl-4 text-left">
                                <p class="text-gray-300 text-sm">✓ Verstuur PDF facturen</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection