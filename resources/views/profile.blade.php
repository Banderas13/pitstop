@extends('layouts.app')

@section('title', 'Instellingen')

@section('content')
<div class="container">
    <div class="text-center py-3">
        <h1 class="h2 fw-bold mb-2">Instellingen</h1>
        <p class="mb-3">
            Beheer je account instellingen
        </p>
        <hr class="w-25 mx-auto my-3">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(Auth::guard('mechanic')->check())
                        <!-- Mechanic Profile Form -->
                        <form method="POST" action="{{ route('profile.update.name') }}" class="mb-4">
                            @csrf
                            @method('PUT')
                            
                            <h5 class="mb-3">Persoonlijke Gegevens</h5>
                            <div class="mb-3">
                                <label class="form-label">Naam</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bedrijfsnaam</label>
                                <input type="text" class="form-control" 
                                       value="{{ $user->company_name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">BTW nummer</label>
                                <input type="text" class="form-control" 
                                       value="{{ $user->vat }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adres</label>
                                <input type="text" class="form-control" 
                                       value="{{ $user->adress }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telefoonnummer</label>
                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                       name="telephone" value="{{ old('telephone', $user->telephone) }}" required>
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Gegevens bijwerken
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- Email wijzigen voor Mechanic -->
                        <form method="POST" action="{{ route('profile.update.email') }}" class="mb-4">
                            @csrf
                            @method('PUT')
                            
                            <h5 class="mb-3">E-mailadres wijzigen</h5>
                            <div class="mb-3">
                                <label class="form-label">Nieuw e-mailadres</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Huidig wachtwoord</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-envelope"></i> E-mailadres bijwerken
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- Wachtwoord wijzigen voor Mechanic -->
                        <form method="POST" action="{{ route('profile.update.password') }}">
                            @csrf
                            @method('PUT')
                            
                            <h5 class="mb-3">Wachtwoord wijzigen</h5>
                            <div class="mb-3">
                                <label class="form-label">Huidig wachtwoord</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nieuw wachtwoord</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bevestig nieuw wachtwoord</label>
                                <input type="password" class="form-control" 
                                       name="password_confirmation" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-key"></i> Wachtwoord bijwerken
                                </button>
                            </div>
                        </form>
                    @else
                        <!-- Existing User Profile Form -->
                        <!-- Naam wijzigen -->
                        <form method="POST" action="{{ route('profile.update.name') }}" class="mb-4">
                            @csrf
                            @method('PUT')
                            
                            <h5 class="mb-3">Naam wijzigen</h5>
                            <div class="mb-3">
                                <label class="form-label">Nieuwe naam</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Naam bijwerken
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- Email wijzigen -->
                        <form method="POST" action="{{ route('profile.update.email') }}" class="mb-4">
                            @csrf
                            @method('PUT')
                            
                            <h5 class="mb-3">E-mailadres wijzigen</h5>
                            <div class="mb-3">
                                <label class="form-label">Nieuw e-mailadres</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Huidig wachtwoord</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-envelope"></i> E-mailadres bijwerken
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- Wachtwoord wijzigen -->
                        <form method="POST" action="{{ route('profile.update.password') }}">
                            @csrf
                            @method('PUT')
                            
                            <h5 class="mb-3">Wachtwoord wijzigen</h5>
                            <div class="mb-3">
                                <label class="form-label">Huidig wachtwoord</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nieuw wachtwoord</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bevestig nieuw wachtwoord</label>
                                <input type="password" class="form-control" 
                                       name="password_confirmation" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-key"></i> Wachtwoord bijwerken
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Delete Account Section -->
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="text-danger mb-3">Account Verwijderen</h5>
                        <p class="text-muted mb-3">Let op: Het verwijderen van je account is permanent en kan niet ongedaan worden gemaakt.</p>
                        
                        <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('Weet je zeker dat je je account wilt verwijderen? Dit kan niet ongedaan worden gemaakt.');">
                            @csrf
                            @method('DELETE')
                            
                            <div class="mb-3">
                                <label class="form-label">Bevestig je wachtwoord</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-danger">Account Verwijderen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
