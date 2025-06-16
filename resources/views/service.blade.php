@extends('layouts.app')

@section('title', 'Service Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <h2 class="display-6 fw-bold text-dark">Service Dashboard</h2>
            <p class="text-muted mb-0">Beheer je cases en maak nieuwe service aanvragen aan</p>
        </div>
        <div>
            <a href="{{ route('service.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>
                Maak nieuwe case
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock text-warning fs-2"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-subtitle mb-2 text-muted">Openstaande Cases</h6>
                            <h3 class="card-title mb-0">{{ $openCases->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-success fs-2"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-subtitle mb-2 text-muted">Afgehandelde Cases</h6>
                            <h3 class="card-title mb-0">{{ $closedCases->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-chart-line text-primary fs-2"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-subtitle mb-2 text-muted">Totaal Cases</h6>
                            <h3 class="card-title mb-0">{{ $openCases->count() + $closedCases->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" id="casesTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="open-cases-tab" data-bs-toggle="tab" data-bs-target="#open-cases" type="button" role="tab">
                <i class="fas fa-clock me-2"></i>
                Openstaande Cases ({{ $openCases->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="closed-cases-tab" data-bs-toggle="tab" data-bs-target="#closed-cases" type="button" role="tab">
                <i class="fas fa-history me-2"></i>
                Afgehandelde Cases ({{ $closedCases->count() }})
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="casesTabContent">
        <!-- Open Cases Tab -->
        <div class="tab-pane fade show active" id="open-cases" role="tabpanel">
            @if($openCases->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        @foreach($openCases as $case)
                            <div class="d-flex align-items-center p-4 border-bottom">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning bg-opacity-25 rounded-circle p-2">
                                        <i class="fas fa-wrench text-warning"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0 me-2">Case #{{ $case->id }} - {{ $case->user->name }}</h6>
                                        <span class="badge bg-warning text-dark">Openstaand</span>
                                    </div>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-car me-1"></i>
                                        {{ $case->car->type->brand->name }} {{ $case->car->type->name }} ({{ $case->car->year }}) - {{ $case->car->numberplate }}
                                    </p>
                                    <p class="text-muted mb-0">{{ Str::limit($case->description, 100) }}</p>
                                </div>
                                <div class="text-end me-3">
                                    <small class="text-muted">{{ $case->created_at->format('d-m-Y H:i') }}</small>
                                    @if($case->offer)
                                        <div class="fw-bold text-success">€{{ number_format($case->offer->price, 2) }}</div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('service.show', $case->id) }}" class="btn btn-outline-primary btn-sm">Bekijk</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list text-muted display-1 mb-3"></i>
                    <h4 class="text-muted mb-2">Geen openstaande cases</h4>
                    <p class="text-muted mb-4">Je hebt momenteel geen openstaande cases.</p>
                    <a href="{{ route('service.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Maak je eerste case
                    </a>
                </div>
            @endif
        </div>

        <!-- Closed Cases Tab -->
        <div class="tab-pane fade" id="closed-cases" role="tabpanel">
            @if($closedCases->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        @foreach($closedCases as $case)
                            <div class="d-flex align-items-center p-4 border-bottom">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-25 rounded-circle p-2">
                                        <i class="fas fa-check text-success"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0 me-2">Case #{{ $case->id }} - {{ $case->user->name }}</h6>
                                        <span class="badge bg-success">Afgehandeld</span>
                                    </div>
                                    <p class="text-muted mb-1">
                                        <i class="fas fa-car me-1"></i>
                                        {{ $case->car->type->brand->name }} {{ $case->car->type->name }} ({{ $case->car->year }}) - {{ $case->car->numberplate }}
                                    </p>
                                    <p class="text-muted mb-0">{{ Str::limit($case->description, 100) }}</p>
                                </div>
                                <div class="text-end me-3">
                                    <small class="text-muted">Afgehandeld: {{ $case->updated_at->format('d-m-Y H:i') }}</small>
                                    @if($case->offer)
                                        <div class="fw-bold text-success">€{{ number_format($case->offer->price, 2) }}</div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('service.show', $case->id) }}" class="btn btn-outline-primary btn-sm">Bekijk</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-history text-muted display-1 mb-3"></i>
                    <h4 class="text-muted mb-2">Geen afgehandelde cases</h4>
                    <p class="text-muted">Je hebt nog geen cases afgehandeld.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Add FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endsection
