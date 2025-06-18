@extends('layouts.app')

@section('title', 'Mijn Service Cases')

@section('content')
    <div class="min-h-screen bg-black">
        <!-- Page Header -->
        <section class="pt-32 pb-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h1 class="text-6xl lg:text-8xl font-black uppercase tracking-widest mb-8">
                        MIJN CASES
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-300 font-light tracking-wide">
                        Overzicht van je service aanvragen en reparaties
                    </p>
                    <div class="w-32 h-1 bg-white mx-auto mt-8"></div>
                </div>
            </div>
        </section>

        <!-- Statistics Cards -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h6 class="text-sm uppercase tracking-widest text-gray-400 mb-2">Openstaande Cases</h6>
                                <h3 class="text-3xl font-bold text-white">{{ $openCases->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-green-400 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h6 class="text-sm uppercase tracking-widest text-gray-400 mb-2">Afgehandelde Cases</h6>
                                <h3 class="text-3xl font-bold text-white">{{ $closedCases->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-black" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16,6L18.29,8.29L13.41,13.17L9.41,9.17L2,16.59L3.41,18L9.41,12L13.41,16L19.71,9.71L22,12V6H16Z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h6 class="text-sm uppercase tracking-widest text-gray-400 mb-2">Totaal Cases</h6>
                                <h3 class="text-3xl font-bold text-white">{{ $openCases->count() + $closedCases->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tabs -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-center mb-8">
                    <div class="bg-gray-900/30 border border-gray-800 rounded-lg p-2">
                        <button class="tab-button active px-6 py-3 text-sm uppercase tracking-wider font-medium rounded transition-all duration-300" data-tab="open-cases">
                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                            </svg>
                            Openstaande Cases ({{ $openCases->count() }})
                        </button>
                        <button class="tab-button px-6 py-3 text-sm uppercase tracking-wider font-medium rounded transition-all duration-300" data-tab="closed-cases">
                            <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.5,4A1.5,1.5 0 0,0 12,5.5A1.5,1.5 0 0,0 13.5,7A1.5,1.5 0 0,0 15,5.5A1.5,1.5 0 0,0 13.5,4M13.14,8.77C11.95,8.87 8.7,11.46 8.7,11.46C8.5,11.61 8.56,11.6 8.72,11.88C8.88,12.15 8.86,12.17 9.06,12.04C9.26,11.91 9.25,11.93 9.25,11.93L11.36,10.29L12.84,12.77C12.98,13.01 13.34,13.05 13.64,13.05C13.94,13.05 14.02,13.00 14.02,13.00L17.69,11.46C17.89,11.33 17.89,11.33 17.89,11.05C17.89,10.77 17.89,10.75 17.69,10.88L14.93,12.05L13.14,8.77M9.29,13.67L8.96,15.13L8.7,15.42L8.7,15.67L9.06,15.92L9.29,15.67L9.29,13.67M14.97,13.67L14.97,15.42L15.23,15.67L15.59,15.42L15.59,15.13L15.26,13.67L14.97,13.67Z"/>
                            </svg>
                            Afgehandelde Cases ({{ $closedCases->count() }})
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Open Cases Tab -->
                    <div class="tab-pane active" id="open-cases">
                        @if($openCases->count() > 0)
                            <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                                @foreach($openCases as $case)
                                    <div class="flex items-center p-8 border-b border-gray-800 last:border-b-0 hover:bg-gray-800/30 transition-colors duration-300">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-yellow-400/25 rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ml-6">
                                            <div class="flex items-center mb-2">
                                                <h6 class="text-lg font-semibold text-white mr-4">Case #{{ $case->id }}</h6>
                                                <span class="bg-yellow-400 text-black px-3 py-1 rounded-full text-xs font-medium uppercase tracking-wider">Openstaand</span>
                                            </div>
                                            <p class="text-gray-300 mb-2">
                                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                                </svg>
                                                {{ $case->car->type->brand->name }} {{ $case->car->type->name }} ({{ $case->car->year }}) - {{ $case->car->numberplate }}
                                            </p>
                                            @if($case->mechanic)
                                                <p class="text-gray-300 mb-2">
                                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M16,4C16.88,4 17.67,4.67 17.67,5.5C17.67,6.33 16.88,7 16,7C15.12,7 14.33,6.33 14.33,5.5C14.33,4.67 15.12,4 16,4M16,17V19H8V17C8,16 8,16 9,16H15C16,16 16,16 16,17M12.5,11.5C12.5,12.5 13.5,12.85 13.5,12.85C13.5,12.85 15,12.5 15,11.5V10.5H17V11.5C17,14.5 13.5,15 13.5,15C13.5,15 10,14.5 10,11.5V10.5H12.5V11.5Z"/>
                                                    </svg>
                                                    Mechaniek: {{ $case->mechanic->name }}
                                                </p>
                                            @endif
                                            <p class="text-gray-400 text-sm">{{ Str::limit($case->description, 100) }}</p>
                                        </div>
                                        <div class="text-right mr-6">
                                            <small class="text-gray-400 block text-sm">{{ $case->created_at->format('d-m-Y H:i') }}</small>
                                            @if($case->offer)
                                                <div class="text-lg font-bold text-green-400 mt-1">€{{ number_format($case->offer->price, 2) }}</div>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('service.show', $case->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
                                                Bekijk
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-20">
                                <div class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-6 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19,3H5C3.9,3 3,3.9 3,5V19C3,20.1 3.9,21 5,21H19C20.1,21 21,20.1 21,19V5C21,3.9 20.1,3 19,3M19,19H5V5H19V19Z"/>
                                    </svg>
                                </div>
                                <h4 class="text-2xl font-bold text-gray-300 mb-4 uppercase tracking-wide">Geen openstaande cases</h4>
                                <p class="text-gray-400 text-lg">Je hebt momenteel geen openstaande service cases.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Closed Cases Tab -->
                    <div class="tab-pane" id="closed-cases">
                        @if($closedCases->count() > 0)
                            <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                                @foreach($closedCases as $case)
                                    <div class="flex items-center p-8 border-b border-gray-800 last:border-b-0 hover:bg-gray-800/30 transition-colors duration-300">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-green-400/25 rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ml-6">
                                            <div class="flex items-center mb-2">
                                                <h6 class="text-lg font-semibold text-white mr-4">Case #{{ $case->id }}</h6>
                                                <span class="bg-green-400 text-black px-3 py-1 rounded-full text-xs font-medium uppercase tracking-wider">Afgehandeld</span>
                                            </div>
                                            <p class="text-gray-300 mb-2">
                                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                                </svg>
                                                {{ $case->car->type->brand->name }} {{ $case->car->type->name }} ({{ $case->car->year }}) - {{ $case->car->numberplate }}
                                            </p>
                                            @if($case->mechanic)
                                                <p class="text-gray-300 mb-2">
                                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M16,4C16.88,4 17.67,4.67 17.67,5.5C17.67,6.33 16.88,7 16,7C15.12,7 14.33,6.33 14.33,5.5C14.33,4.67 15.12,4 16,4M16,17V19H8V17C8,16 8,16 9,16H15C16,16 16,16 16,17M12.5,11.5C12.5,12.5 13.5,12.85 13.5,12.85C13.5,12.85 15,12.5 15,11.5V10.5H17V11.5C17,14.5 13.5,15 13.5,15C13.5,15 10,14.5 10,11.5V10.5H12.5V11.5Z"/>
                                                    </svg>
                                                    Mechaniek: {{ $case->mechanic->name }}
                                                </p>
                                            @endif
                                            <p class="text-gray-400 text-sm">{{ Str::limit($case->description, 100) }}</p>
                                        </div>
                                        <div class="text-right mr-6">
                                            <small class="text-gray-400 block text-sm">Afgehandeld: {{ $case->updated_at->format('d-m-Y H:i') }}</small>
                                            @if($case->offer)
                                                <div class="text-lg font-bold text-green-400 mt-1">€{{ number_format($case->offer->price, 2) }}</div>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('service.show', $case->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-medium uppercase tracking-wider text-sm transition-colors duration-300">
                                                Bekijk
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-20">
                                <div class="w-24 h-24 bg-gray-800 rounded-full mx-auto mb-6 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.5,4A1.5,1.5 0 0,0 12,5.5A1.5,1.5 0 0,0 13.5,7A1.5,1.5 0 0,0 15,5.5A1.5,1.5 0 0,0 13.5,4M13.14,8.77C11.95,8.87 8.7,11.46 8.7,11.46C8.5,11.61 8.56,11.6 8.72,11.88C8.88,12.15 8.86,12.17 9.06,12.04C9.26,11.91 9.25,11.93 9.25,11.93L11.36,10.29L12.84,12.77C12.98,13.01 13.34,13.05 13.64,13.05C13.94,13.05 14.02,13.00 14.02,13.00L17.69,11.46C17.89,11.33 17.89,11.33 17.89,11.05C17.89,10.77 17.89,10.75 17.69,10.88L14.93,12.05L13.14,8.77M9.29,13.67L8.96,15.13L8.7,15.42L8.7,15.67L9.06,15.92L9.29,15.67L9.29,13.67M14.97,13.67L14.97,15.42L15.23,15.67L15.59,15.42L15.59,15.13L15.26,13.67L14.97,13.67Z"/>
                                    </svg>
                                </div>
                                <h4 class="text-2xl font-bold text-gray-300 mb-4 uppercase tracking-wide">Geen afgehandelde cases</h4>
                                <p class="text-gray-400 text-lg">Je hebt nog geen afgehandelde service cases.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Custom Tab JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;

                    // Remove active class from all buttons and panes
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-white', 'text-black');
                        btn.classList.add('text-gray-400', 'hover:text-white');
                    });
                    tabPanes.forEach(pane => {
                        pane.classList.remove('active');
                    });

                    // Add active class to clicked button and corresponding pane
                    this.classList.add('active', 'bg-white', 'text-black');
                    this.classList.remove('text-gray-400', 'hover:text-white');
                    document.getElementById(targetTab).classList.add('active');
                });
            });

            // Set initial active state
            const activeButton = document.querySelector('.tab-button.active');
            if (activeButton) {
                activeButton.classList.add('bg-white', 'text-black');
                activeButton.classList.remove('text-gray-400');
            }

            // Set initial inactive state for other buttons
            tabButtons.forEach(button => {
                if (!button.classList.contains('active')) {
                    button.classList.add('text-gray-400', 'hover:text-white');
                }
            });
        });
    </script>

    <style>
        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
    </style>
@endsection 