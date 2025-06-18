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
                    <div class="border-l-3 border-chiffon p-8">
                        <div class="flex items-center">
                            <div class="ml-6">
                                <h6 class="text-sm uppercase tracking-widest text-gray-400 mb-2"><span class="text-chiffon">Openstaande </span>Cases</h6>
                                <h3 class="text-3xl font-bold text-chiffon">{{ $openCases->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="border-l-3 border-caribbean p-8">
                        <div class="flex items-center">
                            <div class="ml-6">
                                <h6 class="text-sm uppercase tracking-widest text-gray-400 mb-2"><span class="text-caribbean">Afgehandelde </span>Cases</h6>
                                <h3 class="text-3xl font-bold text-caribbean">{{ $closedCases->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="border-l-3 border-pblue p-8">
                        <div class="flex items-center">
                            <div class="ml-6">
                                <h6 class="text-sm uppercase tracking-widest text-gray-400 mb-2"><span class="text-pblue">Totaal </span>Cases</h6>
                                <h3 class="text-3xl font-bold text-pblue">{{ $openCases->count() + $closedCases->count() }}</h3>
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
                    <div class="bg-gray-900/30 border border-gray-800 rounded-lg p-2 w-full max-w-2xl mx-4 md:mx-0 md:w-auto">
                        <div class="flex flex-col md:flex-row gap-2 md:gap-0">
                            <button class="tab-button active px-4 md:px-6 py-3 text-xs md:text-sm uppercase tracking-wider font-medium rounded transition-all duration-300 flex-1 md:flex-none" data-tab="open-cases">
                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                                </svg>
                                <span class="hidden md:inline">Openstaande Cases ({{ $openCases->count() }})</span>
                                <span class="md:hidden">Openstaand ({{ $openCases->count() }})</span>
                            </button>
                            <button class="tab-button px-4 md:px-6 py-3 text-xs md:text-sm uppercase tracking-wider font-medium rounded transition-all duration-300 flex-1 md:flex-none" data-tab="closed-cases">
                                <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13.5,4A1.5,1.5 0 0,0 12,5.5A1.5,1.5 0 0,0 13.5,7A1.5,1.5 0 0,0 15,5.5A1.5,1.5 0 0,0 13.5,4M13.14,8.77C11.95,8.87 8.7,11.46 8.7,11.46C8.5,11.61 8.56,11.6 8.72,11.88C8.88,12.15 8.86,12.17 9.06,12.04C9.26,11.91 9.25,11.93 9.25,11.93L11.36,10.29L12.84,12.77C12.98,13.01 13.34,13.05 13.64,13.05C13.94,13.05 14.02,13.00 14.02,13.00L17.69,11.46C17.89,11.33 17.89,11.33 17.89,11.05C17.89,10.77 17.89,10.75 17.69,10.88L14.93,12.05L13.14,8.77M9.29,13.67L8.96,15.13L8.7,15.42L8.7,15.67L9.06,15.92L9.29,15.67L9.29,13.67M14.97,13.67L14.97,15.42L15.23,15.67L15.59,15.42L15.59,15.13L15.26,13.67L14.97,13.67Z"/>
                                </svg>
                                <span class="hidden md:inline">Afgehandelde Cases ({{ $closedCases->count() }})</span>
                                <span class="md:hidden">Afgehandeld ({{ $closedCases->count() }})</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Open Cases Tab -->
                    <div class="tab-pane active" id="open-cases">
                        @if($openCases->count() > 0)
                            <div class="bg-gray-900/30 border border-gray-800 rounded-lg overflow-hidden">
                                @foreach($openCases as $case)
                                    <div class="flex flex-col md:flex-row md:items-center p-4 md:p-8 border-b border-gray-800 last:border-b-0 hover:bg-gray-800/30 transition-colors duration-300 gap-4">
                                        <div class="flex-grow-1 md:ml-6">
                                            <div class="flex flex-col md:flex-row md:items-center mb-3 gap-2">
                                                <h6 class="text-lg font-semibold text-white">Case #{{ $case->id }}</h6>
                                                <span class="bg-chiffon text-black px-3 py-1 rounded-full text-xs font-medium uppercase tracking-wider w-fit">Openstaand</span>
                                            </div>
                                            <p class="text-gray-300 mb-3 text-sm md:text-base">
                                                <svg class="w-4 h-4 inline mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                                </svg>
                                                <span class="break-words">{{ $case->car->type->brand->name }} {{ $case->car->type->name }} ({{ $case->car->year }}) - {{ $case->car->numberplate }}</span>
                                            </p>
                                            @if($case->mechanic)
                                                <p class="text-gray-300 mb-3 text-sm md:text-base">
                                                    <svg class="w-4 h-4 inline mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M16,4C16.88,4 17.67,4.67 17.67,5.5C17.67,6.33 16.88,7 16,7C15.12,7 14.33,6.33 14.33,5.5C14.33,4.67 15.12,4 16,4M16,17V19H8V17C8,16 8,16 9,16H15C16,16 16,16 16,17M12.5,11.5C12.5,12.5 13.5,12.85 13.5,12.85C13.5,12.85 15,12.5 15,11.5V10.5H17V11.5C17,14.5 13.5,15 13.5,15C13.5,15 10,14.5 10,11.5V10.5H12.5V11.5Z"/>
                                                    </svg>
                                                    <span class="break-words">Mechaniek: {{ $case->mechanic->company_name }}</span>
                                                </p>
                                            @endif
                                            <p class="text-gray-400 text-sm pl-0 md:pl-7">
                                                <span class="font-medium">Diagnose:</span> 
                                                @php
                                                    $parts = explode('MECHANIEK DIAGNOSE ===', $case->description);
                                                    $diagnosis = count($parts) > 1 ? trim($parts[1]) : $case->description;
                                                @endphp
                                                <span class="break-words">{{ Str::limit($diagnosis, 80) }}</span>
                                            </p>
                                        </div>
                                        <div class="flex flex-row md:flex-col justify-between md:justify-start items-center md:items-end md:text-right md:mr-6 gap-4">
                                            <div class="md:mb-4">
                                                <small class="text-gray-400 block text-xs md:text-sm">{{ $case->created_at->format('d-m-Y H:i') }}</small>
                                                @if($case->offer)
                                                    <div class="text-base md:text-lg font-bold text-emerald-500 mt-1">€{{ number_format($case->offer->price, 2) }}</div>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{ route('service.show', $case->id) }}" class="bg-pblue hover:bg-white text-black px-4 md:px-4 py-2 rounded font-medium uppercase tracking-wider text-xs md:text-sm transition-colors duration-300 whitespace-nowrap">
                                                    Bekijk
                                                </a>
                                            </div>
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
                                    <div class="flex flex-col md:flex-row md:items-center p-4 md:p-8 border-b border-gray-800 last:border-b-0 hover:bg-gray-800/30 transition-colors duration-300 gap-4">
                                        <div class="flex-grow-1 md:ml-6">
                                            <div class="flex flex-col md:flex-row md:items-center mb-3 gap-2">
                                                <h6 class="text-lg font-semibold text-white">Case #{{ $case->id }}</h6>
                                                <span class="bg-caribbean text-white px-3 py-1 rounded-full text-xs font-medium uppercase tracking-wider w-fit">Afgehandeld</span>
                                            </div>
                                            <p class="text-gray-300 mb-3 text-sm md:text-base">
                                                <svg class="w-4 h-4 inline mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.22.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                                </svg>
                                                <span class="break-words">{{ $case->car->type->brand->name }} {{ $case->car->type->name }} ({{ $case->car->year }}) - {{ $case->car->numberplate }}</span>
                                            </p>
                                            @if($case->mechanic)
                                                <p class="text-gray-300 mb-3 text-sm md:text-base">
                                                    <svg class="w-4 h-4 inline mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M16,4C16.88,4 17.67,4.67 17.67,5.5C17.67,6.33 16.88,7 16,7C15.12,7 14.33,6.33 14.33,5.5C14.33,4.67 15.12,4 16,4M16,17V19H8V17C8,16 8,16 9,16H15C16,16 16,16 16,17M12.5,11.5C12.5,12.5 13.5,12.85 13.5,12.85C13.5,12.85 15,12.5 15,11.5V10.5H17V11.5C17,14.5 13.5,15 13.5,15C13.5,15 10,14.5 10,11.5V10.5H12.5V11.5Z"/>
                                                    </svg>
                                                    <span class="break-words">Mechaniek: {{ $case->mechanic->company_name }}</span>
                                                </p>
                                            @endif
                                            <p class="text-gray-400 text-sm pl-0 md:pl-7">
                                                <span class="font-medium">Diagnose:</span> 
                                                @php
                                                    $parts = explode('MECHANIEK DIAGNOSE ===', $case->description);
                                                    $diagnosis = count($parts) > 1 ? trim($parts[1]) : $case->description;
                                                @endphp
                                                <span class="break-words">{{ Str::limit($diagnosis, 80) }}</span>
                                            </p>
                                        </div>
                                        <div class="flex flex-row md:flex-col justify-between md:justify-start items-center md:items-end md:text-right md:mr-6 gap-4">
                                            <div class="md:mb-4">
                                                <small class="text-gray-400 block text-xs md:text-sm">Afgehandeld: {{ $case->updated_at->format('d-m-Y H:i') }}</small>
                                                @if($case->offer)
                                                    <div class="text-base md:text-lg font-bold text-emerald-500 mt-1">€{{ number_format($case->offer->price, 2) }}</div>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{ route('service.show', $case->id) }}" class="bg-pblue hover:bg-white text-black px-4 md:px-4 py-2 rounded font-medium uppercase tracking-wider text-xs md:text-sm transition-colors duration-300 whitespace-nowrap">
                                                    Bekijk
                                                </a>
                                            </div>
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