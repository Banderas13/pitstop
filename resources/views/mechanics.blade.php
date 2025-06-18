@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-black">
        <!-- Hero Section -->
        <section class="pt-32">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20">
                    <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(01)</p>
                    <h1 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                        JOUW<br>MECHANIEKERS
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-300 font-light tracking-wide mb-8">
                        Beheer je vertrouwde mechaniekers en vind nieuwe professionals voor je voertuig
                    </p>
                    <div class="w-32 h-1 bg-white mx-auto"></div>
                </div>
            </div>
        </section>

        <!-- Your Mechanics Section -->
        <section class="pb-16">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">JOUW MECHANIEKERS</h2>
                    </div>
                    <div class="space-y-6 mb-8">
                        @if ($mechanics->isEmpty())
                            <p class="text-gray-400 text-center text-lg">Geen Mechaniekers gevonden!</p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($mechanics as $mechanic)
                                    <div class="border-l-2 border-chiffon pl-6">
                                        <span class="text-lg text-pblue font-semibold">{{ $mechanic->company_name }}</span>
                                        <p class="text-gray-300 text-sm">{{ $mechanic->name }}</p>
                                        
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
            </div>
        </section>

        <!-- Search Section -->
        <section class="pb-32">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg">
                    <div class="text-center mb-8">
                        <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(02)</p>
                        <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">ZOEK MECHANIEKERS</h2>
                    </div>
                    
                    <!-- Search Form -->
                    <div class="mb-12">
                        <form method="GET" action="{{ route('mechanics.search') }}" class="text-center">
                            <div class="max-w-md mx-auto mb-6">
                                <input type="text" name="search" class="w-full bg-gray-800 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-pblue focus:ring-1 focus:ring-pblue transition-colors duration-300" placeholder="Zoek een mechanieker..." value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="inline-block bg-pblue text-black px-8 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded">
                                ZOEKEN
                            </button>
                        </form>
                    </div>

                    <!-- Search Results -->
                    <div class="space-y-6">
                        @if ($searchedMechanics->isEmpty())
                            <p class="text-gray-400 text-center text-lg">Geen zoekresultaten gevonden.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($searchedMechanics as $mechanic)
                                    <div class="bg-gray-800/50 border border-gray-700 p-6 rounded-lg">
                                        <div class="flex items-center justify-between">
                                            <div class="border-l-2 border-chiffon pl-4">
                                            <span class="text-lg text-pblue font-semibold">{{ $mechanic->company_name }}</span>
                                            <p class="text-gray-300 text-sm">{{ $mechanic->name }}</p>
                                            </div>
                                            <div>
                                                @if (!$mechanics->contains($mechanic->id))
                                                    <form method="POST" action="{{ route('mechanics.add', $mechanic->id) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 text-sm font-medium uppercase tracking-wider hover:bg-green-700 transition-colors duration-300 rounded">
                                                            TOEVOEGEN
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400 text-sm uppercase tracking-wider">(al toegevoegd)</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection