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

                    <!-- Naam wijzigen -->
                    <form method="POST" action="{{ route('profile.update.name') }}" class="mb-4">
                        @csrf
                        @method('PUT')
                        
                        <h5 class="mb-3">Naam wijzigen</h5>
                        <div class="mb-3">
                            <label class="form-label">Nieuwe naam</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name', auth()->user()->name) }}" required>
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
                                   name="email" value="{{ old('email', auth()->user()->email) }}" required>
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
                                <i class="fas fa-key">Wachtwoord bijwerken </i> 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
