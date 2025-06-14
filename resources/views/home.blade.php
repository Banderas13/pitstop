@extends('layouts.app')

@section('title', 'Startpagina')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @auth
        <div class="text-center py-5">
            <h1>Welkom, {{ Auth::user()->name }}</h1>
            <hr class="w-25 mx-auto my-5">
            <div>
                <h2>Jouw cases</h2>
                <div class="w-25 mx-auto my-5">
                    <ul>
                        @if ($cases->isEmpty())
                            <li>Geen cases gevonden!</li>
                        @else
                            @foreach($cases as $case)
                                <li>{{ $case->description }} - {{ $case->approved }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <a href="{{ route('cases.index') }}" class="btn btn-primary">
                    Naar Cases
                </a>
            </div>
            <hr class="w-25 mx-auto my-5">
            <div>
                <h2>Jouw wagens</h2>
                <div class="w-25 mx-auto my-5">
                    <ul>
                        @if ($cars->isEmpty())
                            <li>Geen wagens gevonden!</li>
                        @else
                            @foreach($cars as $car)
                                <li>{{ $car->car_name }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <a href="{{ route('cars.index') }}" class="btn btn-primary">
                    Naar Wagens
                </a>
            </div>
            <hr class="w-25 mx-auto my-5">
            <div>
                <h2>Jouw Mechaniekers</h2>
                <div class="w-25 mx-auto my-5">
                    <ul>
                        @if(isset($mechanics) && !$mechanics->isEmpty())
                            @foreach($mechanics as $mechanic)
                                <li>{{ $mechanic->name }} - {{ $mechanic->company_name }}</li>
                            @endforeach
                        @else
                            <li>Geen Mechaniekers gevonden!</li>
                        @endif
                    </ul>
                </div>
                <a href="{{ route('mechanics.index') }}" class="btn btn-primary">
                    Naar Mechaniekers
                </a>
            </div>
        </div>
    @elseif(auth('mechanic')->check())
        <div class="text-center py-5">
            <h1>Welkom, {{ auth('mechanic')->user()->name }}</h1>
            <hr class="w-25 mx-auto my-5">
            <div>
                <h2>Open Cases</h2>
                <div class="w-25 mx-auto my-5">
                    <ul>
                        @if(isset($mechanicCases) && !$mechanicCases->isEmpty())
                            @foreach($mechanicCases as $case)
                                @if($case->approval)
                                    <li>{{ $case->description }}</li>
                                @endif
                            @endforeach
                        @else
                            <li>Geen open Cases</li>
                        @endif
                    </ul>
                </div>
                <a href="{{ route('cases.create') }}" class="btn btn-primary">
                    Nieuwe case
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <h1 class="display-3 fw-bold mb-4">Welkom bij Pitstop</h1>
            <p class="lead fs-4 mb-5">
                Een platform waar <strong>gebruikers</strong> en <strong>monteurs</strong> met elkaar kunnen communiceren en samenwerken.
            </p>
            <hr class="w-25 mx-auto my-5">
        </div>

        <div class="text-center py-6">
            <div>
                <div class="w-50 mx-auto my-10">
                    <h2 class="mb-4">Hoe werkt Pitstop?</h2>
                    <p class="fs-5">Pitstop biedt een veilige en gemakkelijke manier om het volgende uit te wisselen:</p>
                    <ul class="fs-5">
                        <li>Directe berichten tussen gebruikers en monteurs</li>
                        <li>Monteurs kunnen foto's delen van voertuigproblemen en oplossingen</li>
                        <li>Facturen en betalingsbewijzen in PDF-formaat</li>
                    </ul>
                </div>
            </div>
            <br>
            <br>
            <div>
                <div class="w-50 mx-auto my-10">
                    <h2 class="mb-4">Voor Gebruikers</h2>
                    <ul class="fs-5">
                        <li>Vind snel gekwalificeerde monteurs en stel vragen via berichten</li>
                        <li>Ontvang foto's en updates rechtstreeks van de monteur</li>
                        <li>Bewaar een digitaal overzicht van facturen en communicatie</li>
                    </ul>
                </div>
            </div>
            <br>
            <br>
            <div>
                <div class="w-50 mx-auto my-10">
                    <h2 class="mb-4">Voor Monteurs</h2>
                    <ul class="fs-5">
                        <li>Neem professioneel contact op met klanten</li>
                        <li>Stuur foto's van schade, onderdelen en reparatievoortgang</li>
                        <li>Verstuur PDF-facturen en houd overzicht van je opdrachten</li>
                    </ul>
                </div>
            </div>
            <br>
            <br>
            <div>
                <div class="w-50 mx-auto my-10">
                    <h2 class="mb-4">Voorbeelden uit de praktijk</h2>
                    <ul class="fs-5">
                        <li>Een gebruiker stuurt een bericht over een raar geluid bij het remmen</li>
                        <li>De monteur reageert met uitleg en stuurt foto's van mogelijke oorzaken</li>
                        <li>Na de reparatie stuurt de monteur een factuur in PDF-formaat</li>
                    </ul>
                </div>
            </div>
        </div>
    @endauth
@endsection
