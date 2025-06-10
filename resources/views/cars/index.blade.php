@extends('layouts.app')

@section('title', 'Mijn Wagens')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Mijn Wagens</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nieuwe Wagen Toevoegen
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($cars->count() > 0)
        <div class="row">
            @foreach($cars as $car)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                {{ $car->type->brand->name }} {{ $car->type->name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <strong>Jaar:</strong> {{ $car->year }}<br>
                                <strong>Nummerplaat:</strong> {{ $car->numberplate }}<br>
                                <strong>Brandstof:</strong> 
                                <span class="badge bg-secondary">{{ ucfirst($car->fuel) }}</span><br>
                                @if($car->chasis_number)
                                    <strong>Chassisnummer:</strong> {{ $car->chasis_number }}<br>
                                @endif
                                <strong>Status:</strong> 
                                @if($car->cases()->where('approval', false)->exists())
                                    <span class="badge bg-warning">In Service</span>
                                @else
                                    <span class="badge bg-success">Beschikbaar</span>
                                @endif
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">
                                    Toegevoegd: {{ $car->created_at->format('d/m/Y') }}
                                </small>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" 
                                      onsubmit="return confirm('Weet je zeker dat je deze wagen wilt verwijderen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i> Verwijderen
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="fas fa-car" style="font-size: 4rem; color: #6c757d;"></i>
            </div>
            <h3 class="text-muted">Geen wagens gevonden</h3>
            <p class="text-muted mb-4">Je hebt nog geen wagens toegevoegd aan je account.</p>
            <a href="{{ route('cars.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Voeg je eerste wagen toe
            </a>
        </div>
    @endif
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection 