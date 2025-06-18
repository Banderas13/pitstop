@extends('layouts.app')

@section('title', 'Over Ons')

@section('content')
    <div class="min-h-screen bg-black">
        <!-- Hero Section -->
        <section class="pt-32 pb-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h1 class="text-6xl lg:text-8xl font-black uppercase tracking-widest mb-8">
                        OVER
                    </h1>
                    <h1 class="text-6xl lg:text-8xl font-black uppercase tracking-widest text-pblue mb-8">
                        PITSTOP
                    </h1>
                    <div class="w-32 h-1 bg-white mx-auto mt-8"></div>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="py-32 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(01)</p>
                        <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                            ONZE<br>MISSIE
                        </h2>
                        <div class="space-y-6">
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">TRANSPARANTIE</h3>
                                <p class="text-gray-400">Eerlijke en transparante communicatie tussen gebruikers en monteurs</p>
                            </div>
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">VERTROUWEN</h3>
                                <p class="text-gray-400">Een veilige omgeving waar beide partijen met vertrouwen kunnen samenwerken</p>
                            </div>
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">EFFICIËNTIE</h3>
                                <p class="text-gray-400">Snelle en effectieve oplossingen voor voertuigproblemen</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white rounded-full mx-auto mb-6"></div>
                            <h3 class="text-2xl font-bold uppercase tracking-wider text-white mb-4">PLATFORM VISIE</h3>
                            <p class="text-gray-400">Een brug tussen expertise en behoefte in de automotive industrie</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Story Section -->
        <section class="py-32 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg lg:order-first">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white rounded-full mx-auto mb-6"></div>
                            <h3 class="text-2xl font-bold uppercase tracking-wider text-white mb-4">INNOVATIE</h3>
                            <p class="text-gray-400">Modernisering van traditionele garage-klant relaties</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(02)</p>
                        <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                            ONS<br>VERHAAL
                        </h2>
                        <div class="space-y-6">
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">PROBLEEM HERKENNING</h3>
                                <p class="text-gray-400">We zagen de frustratie van eigenaren die niet wisten wat er met hun voertuig gebeurde</p>
                            </div>
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">TECHNOLOGIE OPLOSSING</h3>
                                <p class="text-gray-400">Door digitale communicatie een brug bouwen tussen expertise en vraag</p>
                            </div>
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">TOEKOMST PERSPECTIEF</h3>
                                <p class="text-gray-400">Een ecosysteem waar kwaliteit en transparantie centraal staan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-32 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <div class="mb-20">
                    <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(03)</p>
                    <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                        ONZE<br>WAARDEN
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                        <div class="text-3xl font-bold text-white mb-4">01</div>
                        <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">KWALITEIT</h3>
                        <p class="text-gray-400">Alleen gekwalificeerde monteurs en betrouwbare dienstverlening</p>
                    </div>
                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                        <div class="text-3xl font-bold text-white mb-4">02</div>
                        <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">TRANSPARANTIE</h3>
                        <p class="text-gray-400">Eerlijke prijzen en duidelijke communicatie over alle werkzaamheden</p>
                    </div>
                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                        <div class="text-3xl font-bold text-white mb-4">03</div>
                        <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">VERTROUWEN</h3>
                        <p class="text-gray-400">Een veilige omgeving waar beide partijen beschermd zijn</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Philosophy Section -->
        <section class="py-32 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(04)</p>
                        <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                            TEAM<br>FILOSOFIE
                        </h2>
                        <div class="space-y-6">
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">GEBRUIKER CENTRAAL</h3>
                                <p class="text-gray-400">Elk besluit wordt genomen met de eindgebruiker in gedachten</p>
                            </div>
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">CONTINUE VERBETERING</h3>
                                <p class="text-gray-400">We leren van feedback en verbeteren constant ons platform</p>
                            </div>
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">COMMUNITY BUILDING</h3>
                                <p class="text-gray-400">Samen bouwen we een sterke gemeenschap van professionals</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-900/30 border border-gray-800 p-12 rounded-lg">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white rounded-full mx-auto mb-6"></div>
                            <h3 class="text-2xl font-bold uppercase tracking-wider text-white mb-4">SAMEN STERK</h3>
                            <p class="text-gray-400">Door samenwerking bereiken we meer dan alleen</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact CTA Section -->
        <section class="py-32 border-t border-gray-800">
            <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
                <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                    VRAGEN OVER<br>PITSTOP?
                </h2>
                <p class="text-xl text-gray-300 mb-12">
                    Neem contact met ons op voor meer informatie of feedback
                </p>
                <div>
                    <a href="{{ route('contact') }}" class="inline-block bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                        CONTACT
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection