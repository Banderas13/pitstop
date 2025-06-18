@extends('layouts.app')

@section('title', 'Case #' . $case->id . ' - Detailoverzicht')

@section('content')
    <div class="min-h-screen bg-black">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
            <!-- Page Header -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center border-b border-gray-800 pb-12 mb-16">
                <div class="mb-8 lg:mb-0">
                    <h1 class="text-5xl lg:text-7xl font-black uppercase tracking-widest text-white mb-6">
                        Case #{{ $case->id }}
                    </h1>
                    <p class="text-gray-400 text-xl font-light tracking-wide">Detailoverzicht van de service case</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Approval button for users only when case is not approved -->
                    @if(Auth::guard('web')->check() && !$case->approval)
                        <form action="{{ route('service.approve', $case->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-10 py-4 font-semibold uppercase tracking-wider transition-all duration-300 transform hover:scale-105 rounded-lg" onclick="return confirm('Weet je zeker dat je deze case wilt goedkeuren?')">
                                Goedkeuren
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('service.index') }}" class="border border-gray-600 text-gray-300 hover:bg-white hover:text-black px-10 py-4 font-semibold uppercase tracking-wider transition-all duration-300 rounded-lg">
                        Terug naar overzicht
                    </a>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="border-l-4 border-green-400 bg-green-900/20 px-8 py-6 mb-12 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-4"></div>
                        <span class="text-green-300 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="border-l-4 border-red-400 bg-red-900/20 px-8 py-6 mb-12 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-red-400 rounded-full mr-4"></div>
                        <span class="text-red-300 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="border-l-4 border-blue-400 bg-blue-900/20 px-8 py-6 mb-12 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-400 rounded-full mr-4"></div>
                        <span class="text-blue-300 font-medium">{{ session('info') }}</span>
                    </div>
                </div>
            @endif

            <!-- Case Status Alert -->
            <div class="px-8 py-6 mb-12">
                <div class="flex items-center">
                    <div>
                        <strong class="text-2xl {{ $case->approval ? 'text-green-400' : 'text-yellow-400' }} uppercase tracking-wider font-black">
                            Status: {{ $case->approval ? 'Afgehandeld' : 'Openstaand' }}
                        </strong>
                        <p class="text-gray-400 mt-3 text-lg">
                            {{ $case->approval ? 'Afgehandeld op' : 'Aangemaakt op' }} {{ $case->updated_at->format('d-m-Y H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- Case Description -->
                    <div class="group">
                        <div class="bg-gray-900/40 backdrop-blur-sm border border-gray-800 hover:border-gray-700 transition-all duration-300 rounded-lg">
                            <div class="border-l-4 border-pblue px-10 py-8">
                                <h2 class="text-2xl font-bold uppercase tracking-wider text-white">
                                    Case Beschrijving
                                </h2>
                            </div>
                            <div class="px-10 py-8">
                                <div class="case-description text-gray-300 text-lg leading-relaxed">
                                    @php
                                        $parts = explode('MECHANIEK DIAGNOSE ===', $case->description);
                                        $diagnosis = count($parts) > 1 ? trim($parts[1]) : $case->description;
                                    @endphp
                                    {!! nl2br(e($diagnosis)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media Files -->
                    @if($case->media->count() > 0)
                        <div class="group">
                            <div class="bg-gray-900/40 backdrop-blur-sm border border-gray-800 hover:border-gray-700 transition-all duration-300 rounded-lg">
                                <div class="border-l-4 border-caribbean px-10 py-8">
                                    <h2 class="text-2xl font-bold uppercase tracking-wider text-white">
                                        Bijgevoegde Media
                                        <span class="text-caribbean font-light ml-4">({{ $case->media->count() }})</span>
                                    </h2>
                                </div>
                                <div class="px-10 py-8">
                                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                                        @foreach($case->media as $media)
                                            <div class="group/media">
                                                @php
                                                    $extension = pathinfo($media->path, PATHINFO_EXTENSION);
                                                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                                    $isVideo = in_array(strtolower($extension), ['mp4', 'avi', 'mov', 'wmv']);
                                                @endphp
                                                
                                                @if($isImage)
                                                    <div class="text-center">
                                                        <div class="overflow-hidden bg-gray-800 border border-gray-700 group-hover/media:border-pblue transition-all duration-300 rounded-lg">
                                                            <img src="{{ asset('storage/' . $media->path) }}" 
                                                                 class="w-full h-48 object-cover cursor-pointer transform group-hover/media:scale-105 transition-transform duration-300"
                                                                 data-bs-toggle="modal"
                                                                 data-bs-target="#mediaModal{{ $media->id }}">
                                                        </div>
                                                        <p class="text-sm text-gray-400 mt-4 uppercase tracking-wider font-medium">Foto</p>
                                                    </div>
                                                    
                                                    <!-- Modal for image preview -->
                                                    <div class="modal fade" id="mediaModal{{ $media->id }}" tabindex="-1">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Foto Preview</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset('storage/' . $media->path) }}" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($isVideo)
                                                    <div class="text-center">
                                                        <div class="bg-gray-800 border border-gray-700 group-hover/media:border-pblue h-48 flex flex-col items-center justify-center transition-all duration-300 rounded-lg">
                                                            <div class="w-16 h-16 bg-pblue/20 rounded-full flex items-center justify-center mb-6">
                                                                <div class="w-0 h-0 border-l-8 border-l-pblue border-t-4 border-b-4 border-t-transparent border-b-transparent ml-1"></div>
                                                            </div>
                                                            <a href="{{ asset('storage/' . $media->path) }}" target="_blank" class="bg-pblue text-black px-6 py-3 font-medium uppercase tracking-wider hover:bg-white transition-colors duration-300">
                                                                Bekijk Video
                                                            </a>
                                                        </div>
                                                        <p class="text-sm text-gray-400 mt-4 uppercase tracking-wider font-medium">Video</p>
                                                    </div>
                                                @else
                                                    <div class="text-center">
                                                        <div class="bg-gray-800 border border-gray-700 group-hover/media:border-pblue h-48 flex flex-col items-center justify-center transition-all duration-300 rounded-lg">
                                                            <div class="w-16 h-16 bg-gray-600/20 rounded-full flex items-center justify-center mb-6">
                                                                <div class="w-8 h-10 bg-gray-500 relative">
                                                                    <div class="absolute top-0 right-0 w-3 h-3 bg-gray-800 transform rotate-45 origin-bottom-left"></div>
                                                                </div>
                                                            </div>
                                                            <a href="{{ asset('storage/' . $media->path) }}" target="_blank" class="bg-gray-600 text-white px-6 py-3 font-medium uppercase tracking-wider hover:bg-gray-500 transition-colors duration-300">
                                                                Download
                                                            </a>
                                                        </div>
                                                        <p class="text-sm text-gray-400 mt-4 uppercase tracking-wider font-medium">Bestand</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Offer Information -->
                    @if($case->offer)
                        <div class="group">
                            <div class="bg-gray-900/40 backdrop-blur-sm border border-gray-800 hover:border-gray-700 transition-all duration-300 rounded-lg">
                                <div class="border-l-4 border-green-500 px-10 py-8">
                                    <h2 class="text-2xl font-bold uppercase tracking-wider text-white">
                                        Offerte
                                    </h2>
                                </div>
                                <div class="px-10 py-8">
                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-8">
                                        <div>
                                            <div class="text-4xl font-black text-green-400 mb-3">€{{ number_format($case->offer->price, 2) }}</div>
                                            <p class="text-gray-400 text-sm uppercase tracking-wider font-medium">Totaal bedrag inclusief BTW</p>
                                        </div>
                                        <div class="flex gap-4">
                                            <button id="togglePdfView" class="bg-caribbean text-white px-8 py-4 font-semibold uppercase tracking-wider hover:bg-white hover:text-black transition-all duration-300 transform hover:scale-105 rounded-lg">
                                                Bekijk PDF
                                            </button>
                                            <a href="{{ asset('storage/' . $case->offer->path) }}" 
                                               target="_blank" 
                                               class="bg-pblue text-black px-10 py-4 font-semibold uppercase tracking-wider hover:bg-white transition-all duration-300 transform hover:scale-105 rounded-lg">
                                                Download Offerte
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div class="space-y-12">
                    <!-- Customer Information -->
                    <div class="group">
                        <div class="bg-gray-900/40 backdrop-blur-sm border border-gray-800 hover:border-gray-700 transition-all duration-300 rounded-lg">
                            <div class="border-l-4 border-chiffon px-10 py-8">
                                <h2 class="text-2xl font-bold uppercase tracking-wider text-white">
                                    Klantgegevens
                                </h2>
                            </div>
                            <div class="px-10 py-8 space-y-8">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Naam</p>
                                    <p class="text-white text-xl font-medium">{{ $case->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Email</p>
                                    <a href="mailto:{{ $case->user->email }}" class="text-pblue hover:text-white transition-colors duration-300 text-lg">{{ $case->user->email }}</a>
                                </div>
                                @if($case->user->telephone)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Telefoon</p>
                                        <a href="tel:{{ $case->user->telephone }}" class="text-pblue hover:text-white transition-colors duration-300 text-lg">{{ $case->user->telephone }}</a>
                                    </div>
                                @endif
                                @if($case->user->vat)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">BTW Nummer</p>
                                        <p class="text-white text-lg">{{ $case->user->vat }}</p>
                                    </div>
                                @endif
                                @if($case->user->bday)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Geboortedatum</p>
                                        <p class="text-white text-lg">{{ $case->user->bday->format('d-m-Y') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Information -->
                    <div class="group">
                        <div class="bg-gray-900/40 backdrop-blur-sm border border-gray-800 hover:border-gray-700 transition-all duration-300 rounded-lg">
                            <div class="border-l-4 border-midnight px-10 py-8">
                                <h2 class="text-2xl font-bold uppercase tracking-wider text-white">
                                    Voertuiggegevens
                                </h2>
                            </div>
                            <div class="px-10 py-8 space-y-8">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Merk & Model</p>
                                    <p class="text-white text-xl font-medium">{{ $case->car->type->brand->name }} {{ $case->car->type->name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Bouwjaar</p>
                                    <p class="text-white text-lg">{{ $case->car->year }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Nummerplaat</p>
                                    <span class="bg-pblue text-black px-4 py-2 font-bold uppercase tracking-wider text-lg rounded">{{ $case->car->numberplate }}</span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Brandstof</p>
                                    <span class="bg-gray-600 text-white px-4 py-2 font-medium uppercase tracking-wider rounded">{{ ucfirst($case->car->fuel) }}</span>
                                </div>
                                @if($case->car->chasis_number)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-widest mb-3 font-medium">Chassisnummer</p>
                                        <p class="text-white text-lg font-mono">{{ $case->car->chasis_number }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Case Timeline -->
                    <div class="group">
                        <div class="bg-gray-900/40 backdrop-blur-sm border border-gray-800 hover:border-gray-700 transition-all duration-300 rounded-lg">
                            <div class="border-l-4 border-gray-600 px-10 py-8">
                                <h2 class="text-2xl font-bold uppercase tracking-wider text-white">
                                    Tijdlijn
                                </h2>
                            </div>
                            <div class="px-10 py-8">
                                <div class="space-y-8">
                                    <div class="flex items-start group/timeline">
                                        <div class="w-4 h-4 bg-pblue rounded-full mr-6 mt-2 flex-shrink-0 group-hover/timeline:scale-125 transition-transform duration-300"></div>
                                        <div>
                                            <h3 class="text-white font-bold mb-2 uppercase tracking-wider">Case Aangemaakt</h3>
                                            <p class="text-gray-400">{{ $case->created_at->format('d-m-Y H:i') }}</p>
                                        </div>
                                    </div>
                                    @if($case->offer)
                                        <div class="flex items-start group/timeline">
                                            <div class="w-4 h-4 bg-green-500 rounded-full mr-6 mt-2 flex-shrink-0 group-hover/timeline:scale-125 transition-transform duration-300"></div>
                                            <div>
                                                <h3 class="text-white font-bold mb-2 uppercase tracking-wider">Offerte Opgesteld</h3>
                                                <p class="text-green-400 font-bold text-lg">€{{ number_format($case->offer->price, 2) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if($case->approval)
                                        <div class="flex items-start group/timeline">
                                            <div class="w-4 h-4 bg-green-500 rounded-full mr-6 mt-2 flex-shrink-0 group-hover/timeline:scale-125 transition-transform duration-300"></div>
                                            <div>
                                                <h3 class="text-white font-bold mb-2 uppercase tracking-wider">Case Afgehandeld</h3>
                                                <p class="text-gray-400">{{ $case->updated_at->format('d-m-Y H:i') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PDF Viewer Container (Full Width - Underneath Both Columns) -->
            @if($case->offer)
                <div id="pdfContainer" class="hidden group mt-16">
                    <div class="bg-gray-900/40 backdrop-blur-sm border border-gray-800 hover:border-gray-700 transition-all duration-300 rounded-lg">
                        <div class="border-l-4 border-caribbean px-10 py-8">
                            <div class="flex justify-between items-center">
                                <h2 class="text-2xl font-bold uppercase tracking-wider text-white">PDF Voorvertoning</h2>
                                <button id="closePdf" class="text-gray-400 hover:text-white transition-colors duration-300 p-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="px-10 py-8">
                            <iframe id="pdfFrame" 
                                    src="" 
                                    class="w-full border-0 rounded-lg bg-white shadow-2xl"
                                    style="min-height: 800px;">
                                <p class="text-white text-center py-8">
                                    Je browser ondersteunt geen PDF weergave. 
                                    <a href="{{ asset('storage/' . $case->offer->path) }}" target="_blank" class="text-pblue hover:text-white">
                                        Klik hier om de PDF te downloaden
                                    </a>
                                </p>
                            </iframe>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .case-description {
            white-space: pre-wrap;
            line-height: 1.8;
        }
    </style>

    @if($case->offer)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('togglePdfView');
            const closeButton = document.getElementById('closePdf');
            const pdfContainer = document.getElementById('pdfContainer');
            const pdfFrame = document.getElementById('pdfFrame');
            const pdfPath = '{{ asset("storage/" . $case->offer->path) }}';

            if (toggleButton && pdfContainer && pdfFrame) {
                toggleButton.addEventListener('click', function() {
                    if (pdfContainer.classList.contains('hidden')) {
                        // Show PDF
                        pdfFrame.src = pdfPath;
                        pdfContainer.classList.remove('hidden');
                        pdfContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        toggleButton.textContent = 'Verberg PDF';
                        toggleButton.classList.remove('bg-caribbean');
                        toggleButton.classList.add('bg-red-600');
                    } else {
                        // Hide PDF
                        pdfFrame.src = '';
                        pdfContainer.classList.add('hidden');
                        toggleButton.textContent = 'Bekijk PDF';
                        toggleButton.classList.remove('bg-red-600');
                        toggleButton.classList.add('bg-caribbean');
                    }
                });

                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        pdfFrame.src = '';
                        pdfContainer.classList.add('hidden');
                        toggleButton.textContent = 'Bekijk PDF';
                        toggleButton.classList.remove('bg-red-600');
                        toggleButton.classList.add('bg-caribbean');
                    });
                }
            }
        });
    </script>
    @endif
@endsection 