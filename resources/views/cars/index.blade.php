@extends('layouts.app')

@section('title', 'Mijn Wagens')

@section('content')
<div class="min-h-screen bg-black">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
        <!-- Hero Section -->
        <div class="text-center mb-20">
            <h1 class="text-6xl lg:text-8xl font-black uppercase tracking-widest mb-8">
                MIJN WAGENS
            </h1>
            <p class="text-gray-400 text-xl lg:text-2xl mb-8 max-w-2xl mx-auto">
                Beheer al je voertuigen op één plek. Voeg nieuwe wagens toe, bekijk details en houd de status van je voertuigen bij.
            </p>
            <div class="w-32 h-1 bg-white mx-auto mt-8"></div>
        </div>

        @if(session('success'))
            <div class="bg-green-900/50 border border-green-800 text-green-200 px-6 py-4 mb-8 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New Car Button -->
        <div class="text-center mb-12">
            <a href="{{ route('cars.create') }}" class="inline-block bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                <i class="fas fa-plus mr-2"></i> Nieuwe Wagen Toevoegen
            </a>
        </div>

        @if($cars->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cars as $car)
                    <div class="p-8 h-full flex flex-col">
                        <!-- Car Header -->
                        <div class="border-b border-gray-700 pb-4 mb-6">
                            <h3 class="text-xl font-bold uppercase tracking-wider text-white mb-2">
                                {{ $car->type->brand->name }} {{ $car->type->name }}
                            </h3>
                        </div>
                        
                        <!-- Car Details -->
                        <div class="flex-grow space-y-4 mb-6">
                            <div class="border-l-2 border-chiffon pl-4">
                                <p class="text-gray-300 mb-1">
                                    <span class="text-sm text-gray-400 uppercase tracking-wide">Jaar:</span>
                                    <span class="text-pblue font-semibold ml-2">{{ $car->year }}</span>
                                </p>
                            </div>
                            
                            <div class="border-l-2 border-chiffon pl-4">
                                <p class="text-gray-300 mb-1">
                                    <span class="text-sm text-gray-400 uppercase tracking-wide">Nummerplaat:</span>
                                    <span class="text-white font-semibold ml-2">{{ $car->numberplate }}</span>
                                </p>
                            </div>
                            
                            <div class="border-l-2 border-chiffon pl-4">
                                <p class="text-gray-300 mb-1">
                                    <span class="text-sm text-gray-400 uppercase tracking-wide">Brandstof:</span>
                                    <span class="inline-block bg-gray-700 text-gray-200 px-3 py-1 text-xs uppercase tracking-wide rounded ml-2">{{ ucfirst($car->fuel) }}</span>
                                </p>
                            </div>
                            
                            @if($car->chasis_number)
                                <div class="border-l-2 border-chiffon pl-4">
                                    <p class="text-gray-300 mb-1">
                                        <span class="text-sm text-gray-400 uppercase tracking-wide">Chassisnummer:</span>
                                        <span class="text-white font-semibold ml-2">{{ $car->chasis_number }}</span>
                                    </p>
                                </div>
                            @endif
                            
                            <div class="border-l-2 border-chiffon pl-4">
                                <p class="text-gray-300 mb-1">
                                    <span class="text-sm text-gray-400 uppercase tracking-wide">Status:</span>
                                    @if($car->cases()->where('approval', false)->exists())
                                        <span class="inline-block bg-yellow-600 text-black px-3 py-1 text-xs uppercase tracking-wide rounded ml-2">In Service</span>
                                    @else
                                        <span class="inline-block bg-green-600 text-white px-3 py-1 text-xs uppercase tracking-wide rounded ml-2">Beschikbaar</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="border-t border-gray-700 pt-4 flex justify-between items-center">
                            <small class="text-gray-400 text-sm">
                                Toegevoegd: {{ $car->created_at->format('d/m/Y') }}
                            </small>
                            <form action="{{ route('cars.destroy', $car) }}" method="POST" 
                                  onsubmit="return confirm('Weet je zeker dat je deze wagen wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-900/50 hover:bg-red-900 border border-red-800 text-red-200 px-4 py-2 text-sm uppercase tracking-wide rounded transition-colors duration-300">
                                    <i class="fas fa-trash mr-1"></i> Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="max-w-2xl mx-auto text-center py-20">
                <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg">
                    <div class="mb-8">
                        <i class="fas fa-car text-6xl text-gray-600"></i>
                    </div>
                    <h3 class="text-3xl font-bold uppercase tracking-wider text-white mb-4">Geen wagens gevonden</h3>
                    <p class="text-gray-400 mb-8 text-lg">Je hebt nog geen wagens toegevoegd aan je account.</p>
                    <a href="{{ route('cars.create') }}" class="inline-block bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                        <i class="fas fa-plus mr-2"></i> Voeg je eerste wagen toe
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection 