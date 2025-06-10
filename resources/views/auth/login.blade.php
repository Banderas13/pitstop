<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container">
    <div class="text-center py-3">
        <h1 class="h2 fw-bold mb-2">Welkom terug bij Pitstop</h1>
        <p class="mb-3">
            Log in om je account te gebruiken als <strong>gebruiker</strong> of <strong>monteur</strong>
        </p>
        <hr class="w-25 mx-auto my-3">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   placeholder="naam@voorbeeld.com" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Wachtwoord</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" placeholder="wachtwoord" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" 
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Onthoud mij
                            </label>
                        </div>

                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary" href="{{ route('login') }}" class="text-decoration-none">
                                Inloggen
                            </button> 
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center py-3">
        <p>
            Nog geen account? <a href="{{ route('register') }}" class="text-decoration-none">Registreer hier</a>
        </p>
        <hr class="w-25 mx-auto my-3">
    </div>

   
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card h-100 border-0">
                <div class="card-body text-center p-3">
                    <h6 class="mb-2">Voor Gebruikers</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-1">✓ Vind gekwalificeerde monteurs</li>
                        <li class="mb-1">✓ Ontvang foto updates</li>
                        <li class="mb-1">✓ Digitale facturen</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-0">
                <div class="card-body text-center p-3">
                    <h6 class="mb-2">Voor Monteurs</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-1">✓ Professioneel contact met klanten</li>
                        <li class="mb-1">✓ Deel reparatievoortgang</li>
                        <li class="mb-1">✓ Verstuur PDF facturen</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection