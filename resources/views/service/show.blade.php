@extends('layouts.app')

@section('title', 'Case #' . $case->id . ' - Detailoverzicht')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <h2 class="display-6 fw-bold text-dark">Case #{{ $case->id }}</h2>
            <p class="text-muted mb-0">Detailoverzicht van de service case</p>
        </div>
        <div>
            <!-- Approval button for users only when case is not approved -->
            @if(Auth::guard('web')->check() && !$case->approval)
                <form action="{{ route('service.approve', $case->id) }}" method="POST" class="d-inline me-2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success" onclick="return confirm('Weet je zeker dat je deze case wilt goedkeuren?')">
                        <i class="fas fa-check me-2"></i>
                        Goedkeuren
                    </button>
                </form>
            @endif
            <a href="{{ route('service.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Terug naar overzicht
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Case Status Alert -->
    <div class="alert {{ $case->approval ? 'alert-success' : 'alert-warning' }} mb-4">
        <div class="d-flex align-items-center">
            <i class="fas {{ $case->approval ? 'fa-check-circle' : 'fa-clock' }} me-2"></i>
            <strong>Status: {{ $case->approval ? 'Afgehandeld' : 'Openstaand' }}</strong>
            <span class="ms-3 text-muted">
                {{ $case->approval ? 'Afgehandeld op' : 'Aangemaakt op' }} {{ $case->updated_at->format('d-m-Y H:i') }}
            </span>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Case Description -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-clipboard-list me-2"></i>
                        Case Beschrijving
                    </h5>
                </div>
                <div class="card-body">
                    <div class="case-description">
                        {!! nl2br(e($case->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Media Files -->
            @if($case->media->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-images me-2"></i>
                            Bijgevoegde Media ({{ $case->media->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($case->media as $media)
                                <div class="col-md-4 col-sm-6">
                                    @php
                                        $extension = pathinfo($media->path, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                        $isVideo = in_array(strtolower($extension), ['mp4', 'avi', 'mov', 'wmv']);
                                    @endphp
                                    
                                    @if($isImage)
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $media->path) }}" 
                                                 class="img-thumbnail mb-2" 
                                                 style="max-height: 150px; cursor: pointer;"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#mediaModal{{ $media->id }}">
                                            <div class="small text-muted">Foto</div>
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
                                            <div class="border rounded p-3 mb-2" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                                                <div>
                                                    <i class="fas fa-play-circle text-primary" style="font-size: 3rem;"></i>
                                                    <div class="mt-2">
                                                        <a href="{{ asset('storage/' . $media->path) }}" target="_blank" class="btn btn-sm btn-primary">
                                                            Bekijk Video
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="small text-muted">Video</div>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <div class="border rounded p-3 mb-2" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                                                <div>
                                                    <i class="fas fa-file text-secondary" style="font-size: 3rem;"></i>
                                                    <div class="mt-2">
                                                        <a href="{{ asset('storage/' . $media->path) }}" target="_blank" class="btn btn-sm btn-secondary">
                                                            Download
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="small text-muted">Bestand</div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Offer Information -->
            @if($case->offer)
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-file-invoice-dollar me-2"></i>
                            Offerte
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="text-success mb-1">€{{ number_format($case->offer->price, 2) }}</h4>
                                <small class="text-muted">Totaal bedrag inclusief BTW</small>
                            </div>
                            <div>
                                <a href="{{ asset('storage/' . $case->offer->path) }}" 
                                   target="_blank" 
                                   class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>
                                    Download Offerte
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>
                        Klantgegevens
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Naam:</strong><br>
                        {{ $case->user->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong><br>
                        <a href="mailto:{{ $case->user->email }}">{{ $case->user->email }}</a>
                    </div>
                    @if($case->user->telephone)
                        <div class="mb-3">
                            <strong>Telefoon:</strong><br>
                            <a href="tel:{{ $case->user->telephone }}">{{ $case->user->telephone }}</a>
                        </div>
                    @endif
                    @if($case->user->vat)
                        <div class="mb-3">
                            <strong>BTW Nummer:</strong><br>
                            {{ $case->user->vat }}
                        </div>
                    @endif
                    @if($case->user->bday)
                        <div class="mb-0">
                            <strong>Geboortedatum:</strong><br>
                            {{ \Carbon\Carbon::parse($case->user->bday)->format('d-m-Y') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Vehicle Information -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-car me-2"></i>
                        Voertuiggegevens
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Merk & Model:</strong><br>
                        {{ $case->car->type->brand->name }} {{ $case->car->type->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Bouwjaar:</strong><br>
                        {{ $case->car->year }}
                    </div>
                    <div class="mb-3">
                        <strong>Nummerplaat:</strong><br>
                        <span class="badge bg-primary">{{ $case->car->numberplate }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>Brandstof:</strong><br>
                        <span class="badge bg-secondary">{{ ucfirst($case->car->fuel) }}</span>
                    </div>
                    @if($case->car->chasis_number)
                        <div class="mb-0">
                            <strong>Chassisnummer:</strong><br>
                            {{ $case->car->chasis_number }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Case Timeline -->
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Tijdlijn
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Case Aangemaakt</h6>
                                <small class="text-muted">{{ $case->created_at->format('d-m-Y H:i') }}</small>
                            </div>
                        </div>
                        @if($case->offer)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Offerte Opgesteld</h6>
                                    <small class="text-muted">€{{ number_format($case->offer->price, 2) }}</small>
                                </div>
                            </div>
                        @endif
                        @if($case->approval)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-success"></div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Case Afgehandeld</h6>
                                    <small class="text-muted">{{ $case->updated_at->format('d-m-Y H:i') }}</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .case-description {
            white-space: pre-wrap;
            line-height: 1.6;
        }
        
        .timeline {
            position: relative;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 30px;
            padding-bottom: 20px;
        }
        
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 20px;
            bottom: -10px;
            width: 2px;
            background-color: #e9ecef;
        }
        
        .timeline-item:last-child::before {
            display: none;
        }
        
        .timeline-marker {
            position: absolute;
            left: 0;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 3px #e9ecef;
        }
        
        .timeline-content {
            margin-left: 0;
        }
    </style>

    <!-- Add FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endsection 