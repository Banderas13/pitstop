@extends('layouts.app')

@section('title', 'Startpagina')

@section('content')
    @if(session('success'))
        <div class="bg-green-900/50 border border-green-800 text-green-200 px-6 py-4 mx-6 lg:mx-8 mt-8 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @auth
        <!-- Authenticated User Dashboard -->
        <div class="min-h-screen bg-black">
            <!-- Hero Section -->
            <section class="pt-32">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="text-center mb-20">
                        <h1 class="text-6xl lg:text-8xl font-black uppercase tracking-widest mb-8">
                            WELKOM
                        </h1>
                        <p class="text-xl lg:text-2xl text-gray-300 font-light tracking-wide">
                            {{ Auth::user()->name }}
                        </p>
                        <div class="w-32 h-1 bg-white mx-auto mt-8"></div>
                    </div>
                </div>
            </section>

            <!-- Cases and Cars Section -->
            <section>
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Cases Section -->
                        <div>
                            <div class="text-center mb-8">
                                <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(01)</p>
                                <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">JOUW CASES</h2>
                            </div>
                            <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                                <div class="space-y-4 mb-8">
                                    @if ($cases->isEmpty())
                                        <p class="text-gray-400 text-center">Geen cases gevonden</p>
                                    @else
                                        @foreach($cases as $case)
                                            <div class="border-l-2 border-chiffon pl-4">
                                                <p class="text-gray-300 mb-2 text-xl">
                                                    Service bij <span class="text-pblue font-semibold">{{ $case->mechanic ? $case->mechanic->company_name : 'Onbekende monteur' }}</span> 
                                                    voor uw <span class="text-chiffon">{{ $case->car && $case->car->type ? $case->car->type->brand->name . ' ' . $case->car->type->name : 'voertuig' }}</span>
                                                </p>
                                                <p class="text-gray-400 text-sm mb-2">
                                                    @php
                                                        $parts = explode('MECHANIEK DIAGNOSE ===', $case->description);
                                                        $diagnosis = count($parts) > 1 ? trim($parts[1]) : $case->description;
                                                    @endphp
                                                    {{ $diagnosis }}
                                                </p>
                                                <span class="text-xs text-pblue uppercase font-semibold">
                                                    @if($case->approval)
                                                        Goedgekeurd
                                                    @else
                                                        In behandeling
                                                    @endif
                                                </span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('cases.index') }}" class="inline-block bg-pblue text-black px-6 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                                        NAAR CASES
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Cars Section -->
                        <div>
                            <div class="text-center mb-8">
                                <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(02)</p>
                                <h2 class="text-2xl lg:text-3xl font-bold uppercase tracking-wider text-white">JOUW WAGENS</h2>
                            </div>
                            <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                                <div class="mb-8">
                                    @if ($cars->isEmpty())
                                        <p class="text-gray-400 text-center">Geen wagens gevonden</p>
                                    @else
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            @foreach($cars as $car)
                                                <div class="border-l-2 border-chiffon pl-4">
                                                    <p class="text-gray-300">{{ $car->type->brand->name }} {{ $car->type->name }}</p>
                                                    <p class="text-sm text-gray-500 mb-2">{{ $car->numberplate }} ({{ $car->year }})</p>
                                                    @if($car->cases()->where('approval', false)->exists())
                                                        <span class="inline-block bg-yellow-600 text-black px-2 py-1 text-xs uppercase tracking-wide rounded">In Service</span>
                                                    @else
                                                        <span class="inline-block bg-green-600 text-white px-2 py-1 text-xs uppercase tracking-wide rounded">Beschikbaar</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('cars.index') }}" class="inline-block bg-pblue text-black px-6 py-3 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                                        NAAR WAGENS
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mechanics Section -->
            <section class="py-32 ">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="text-center mb-20">
                        <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(03)</p>
                        <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                            JOUW<br>MECHANIEKERS
                        </h2>
                    </div>
                    
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg">
                            <div class="space-y-6 mb-12">
                                @if(isset($mechanics) && !$mechanics->isEmpty())
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        @foreach($mechanics as $mechanic)
                                            <div class="border-l-2 border-chiffon pl-6">
                                                <p class="text-gray-300 text-lg">{{ $mechanic->name }}</p>
                                                <span class="text-sm text-pblue font-semibold">{{ $mechanic->company_name }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-400 text-center text-lg">Geen mechaniekers gevonden</p>
                                @endif
                            </div>
                            <div class="text-center">
                                <a href="{{ route('mechanics.index') }}" class="inline-block bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                                    NAAR MECHANIEKERS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @elseif(auth('mechanic')->check())
        <!-- Mechanic Dashboard -->
        <div class="min-h-screen bg-black">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
                <!-- Hero Section -->
                <div class="text-center mb-20">
                    <h1 class="text-6xl lg:text-8xl font-black uppercase tracking-widest mb-8">
                        WELKOM
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-300 font-light tracking-wide">
                        {{ auth('mechanic')->user()->name }}
                    </p>
                    <div class="w-32 h-1 bg-white mx-auto mt-8"></div>
                </div>

                <!-- Cases Section -->
                <div class="max-w-4xl mx-auto">
                    <div class="bg-gray-900/80 backdrop-blur-sm border border-gray-800 p-12 rounded-lg">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold uppercase tracking-wider text-white">OPEN CASES</h2>
                        </div>
                        <div class="space-y-6 mb-12">
                            @if(isset($mechanicCases) && !$mechanicCases->isEmpty())
                                @foreach($mechanicCases as $case)
                                    <div class="border-l-2 border-chiffon pl-4">
                                        <p class="text-gray-300 mb-2 text-xl">
                                            Service voor <span class="text-pblue font-semibold">{{ $case->user ? $case->user->name : 'Onbekende gebruiker' }}</span> 
                                            en zijn <span class="text-chiffon">{{ $case->car && $case->car->type ? $case->car->type->brand->name . ' ' . $case->car->type->name . ' (' . $case->car->numberplate . ')' : 'voertuig' }}</span>
                                        </p>
                                        <p class="text-gray-400 text-sm mb-2">
                                            @php
                                                $description = $case->description;
                                                $startMarker = 'KLANT BESCHRIJVING ===';
                                                $endMarker = '=== MECHANIEK DIAGNOSE';
                                                
                                                $startPos = strpos($description, $startMarker);
                                                $endPos = strpos($description, $endMarker);
                                                
                                                if ($startPos !== false && $endPos !== false && $startPos < $endPos) {
                                                    $startPos += strlen($startMarker);
                                                    $clientDescription = trim(substr($description, $startPos, $endPos - $startPos));
                                                } else {
                                                    $clientDescription = $description;
                                                }
                                            @endphp
                                            {{ $clientDescription }}
                                        </p>
                                        <span class="text-xs text-pblue uppercase font-semibold">Goedgekeurd</span>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-chiffon text-lg text-center">Geen open cases</p>
                            @endif
                        </div>
                        <div class="text-center">
                            <a href="/service/create" class="inline-block bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                                NIEUWE CASE
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Landing Page -->
        <div class="min-h-screen bg-black">
            <!-- Hero Section -->
            <section id="hero-section" class="fixed top-0 left-0 w-full h-screen z-40">
                <!-- Top Half: Title and Line -->
                <div id="hero-top" class="absolute top-0 left-0 w-full h-1/2 bg-midnight flex items-end justify-center pb-8 overflow-hidden">
                    <div class="text-center">
                        <h1 class="text-7xl lg:text-9xl font-black uppercase tracking-widest mb-8">
                            PITSTOP
                        </h1>
                        <div class="w-32 h-1 bg-white mx-auto"></div>
                    </div>
                </div>
                
                <!-- Bottom Half: Description and Buttons -->
                <div id="hero-bottom" class="absolute bottom-0 left-0 w-full h-1/2 bg-midnight flex items-start justify-center pt-8 overflow-hidden">
                    <div class="text-center">
                        <p class="text-xl lg:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed font-light mb-16">
                            Een platform waar <strong class="font-semibold text-pblue">gebruikers</strong> en <strong class="font-semibold text-pblue">monteurs</strong> met elkaar kunnen communiceren en samenwerken.
                        </p>
                        <div class="space-x-6">
                            <a href="{{ route('register') }}" class="inline-block bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                                START NU
                            </a>
                            <a href="{{ route('login') }}" class="inline-block border-2 border-pblue text-pblue px-8 py-4 font-medium uppercase tracking-wider hover:bg-white hover:text-black transition-colors duration-300">
                                LOGIN
                            </a>
                        </div>
                        <div class="mt-16 animate-bounce">
                            <p class="text-sm text-gray-400 uppercase tracking-widest mb-2">
                                scroll voor meer info
                            </p>
                            <div class="flex justify-center">
                                <svg class="w-6 h-6 text-gray-400 hover:text-pblue transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Spacer for scroll -->
            <div class="h-screen"></div>

            <!-- How It Works Section -->
            <section class="py-32 border-t border-gray-800">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="text-center mb-20">
                    <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(01)</p>
                        <h2 class="text-5xl lg:text-7xl font-black uppercase tracking-widest mb-8">
                            HOE WERKT
                        </h2>
                        <h2 class="text-5xl lg:text-7xl font-black uppercase tracking-widest text-pblue">
                            PITSTOP?
                        </h2>
                    </div>
                    
                    <div class="max-w-4xl mx-auto text-center">
                        <p class="text-xl text-gray-300 mb-12 leading-relaxed">
                            Pitstop biedt een veilige en gemakkelijke manier om het volgende uit te wisselen:
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                                <h3 class="text-xl font-bold uppercase tracking-wider text-chiffon mb-4">COMMUNICATIE</h3>
                                <p class="text-gray-400">Directe berichten tussen gebruikers en monteurs</p>
                            </div>
                            <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                                <h3 class="text-xl font-bold uppercase tracking-wider text-chiffon mb-4">VISUEEL</h3>
                                <p class="text-gray-400">Foto's delen van voertuigproblemen en oplossingen</p>
                            </div>
                            <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                                <h3 class="text-xl font-bold uppercase tracking-wider text-chiffon mb-4">ADMINISTRATIE</h3>
                                <p class="text-gray-400">Facturen en betalingsbewijzen in PDF-formaat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- For Users Section -->
            <section class="py-32 border-t border-gray-800">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(02)</p>
                            <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                                VOOR<br>GEBRUIKERS
                            </h2>
                            <div class="space-y-6">
                                <div class="border-l-2 border-chiffon pl-6">
                                    <h3 class="text-lg font-semibold text-pblue mb-2">SNEL CONTACT</h3>
                                    <p class="text-gray-400">Vind gekwalificeerde monteurs en stel vragen via berichten</p>
                                </div>
                                <div class="border-l-2 border-chiffon pl-6">
                                    <h3 class="text-lg font-semibold text-pblue mb-2">LIVE UPDATES</h3>
                                    <p class="text-gray-400">Ontvang foto's en updates rechtstreeks van de monteur</p>
                                </div>
                                <div class="border-l-2 border-chiffon pl-6">
                                    <h3 class="text-lg font-semibold text-pblue mb-2">DIGITAAL OVERZICHT</h3>
                                    <p class="text-gray-400">Bewaar facturen en communicatie op één plek</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-white rounded-full mx-auto mb-6"></div>
                                <h3 class="text-2xl font-bold uppercase tracking-wider text-white mb-4">USER EXPERIENCE</h3>
                                <p class="text-gray-400">Ontworpen voor gemak en efficiëntie</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- For Mechanics Section -->
            <section class="py-32 border-t border-gray-800">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg lg:order-first">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-white rounded-full mx-auto mb-6"></div>
                                <h3 class="text-2xl font-bold uppercase tracking-wider text-white mb-4">PROFESSIONAL</h3>
                                <p class="text-gray-400">Tools voor professionele dienstverlening</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(03)</p>
                            <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                                VOOR<br>MONTEURS
                            </h2>
                            <div class="space-y-6">
                                <div class="border-l-2 border-chiffon pl-6">
                                    <h3 class="text-lg font-semibold text-pblue mb-2">PROFESSIONEEL CONTACT</h3>
                                    <p class="text-gray-400">Neem direct contact op met klanten</p>
                                </div>
                                <div class="border-l-2 border-chiffon pl-6">
                                    <h3 class="text-lg font-semibold text-pblue mb-2">VISUELE RAPPORTAGE</h3>
                                    <p class="text-gray-400">Deel foto's van schade en reparatievoortgang</p>
                                </div>
                                <div class="border-l-2 border-chiffon pl-6">
                                    <h3 class="text-lg font-semibold text-pblue mb-2">ADMINISTRATIE</h3>
                                    <p class="text-gray-400">Verstuur PDF-facturen en beheer opdrachten</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Examples Section -->
            <section class="py-32 border-t border-gray-800">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                    <div class="mb-20">
                        <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(04)</p>
                        <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                            PRAKTIJK<br>VOORBEELDEN
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <div class="text-3xl font-bold text-white mb-4">01</div>
                            <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">PROBLEEM</h3>
                            <p class="text-gray-400">Een gebruiker stuurt een bericht over een raar geluid bij het remmen</p>
                        </div>
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <div class="text-3xl font-bold text-white mb-4">02</div>
                            <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">DIAGNOSE</h3>
                            <p class="text-gray-400">De monteur reageert met uitleg en stuurt foto's van mogelijke oorzaken</p>
                        </div>
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <div class="text-3xl font-bold text-white mb-4">03</div>
                            <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">AFRONDING</h3>
                            <p class="text-gray-400">Na de reparatie stuurt de monteur een factuur in PDF-formaat</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-32 border-t border-gray-800">
                <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
                    <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                        KLAAR OM<br>TE BEGINNEN?
                    </h2>
                    <p class="text-xl text-gray-300 mb-12">
                        Sluit je aan bij het platform dat gebruikers en monteurs samenbrengt
                    </p>
                    <div class="space-x-6">
                        <a href="{{ route('register') }}" class="inline-block bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                            REGISTREER NU
                        </a>
                        <a href="{{ route('login') }}" class="inline-block border-2 border-pblue text-pblue px-8 py-4 font-medium uppercase tracking-wider hover:bg-white hover:text-black transition-colors duration-300">
                            LOGIN
                        </a>
                    </div>
                </div>
            </section>
        </div>
    @endauth
@endsection
