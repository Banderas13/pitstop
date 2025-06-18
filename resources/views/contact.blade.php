@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div class="min-h-screen bg-black">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-900/50 border border-green-800 text-green-200 px-6 py-4 mx-6 lg:mx-8 mt-8 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Hero Section -->
        <section class="pt-32 pb-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h1 class="text-6xl lg:text-8xl font-black uppercase tracking-widest mb-8">
                        CONTACT
                    </h1>
                    <p class="text-xl lg:text-2xl text-gray-300 font-light tracking-wide max-w-3xl mx-auto">
                        Heeft u vragen over het platform of wilt u feedback geven? 
                        We horen graag van u!
                    </p>
                    <div class="w-32 h-1 bg-white mx-auto mt-8"></div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="py-16 border-t border-gray-800">
            <div class="max-w-6xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
                    <!-- Form -->
                    <div class="lg:col-span-2">
                        <div class="mb-8">
                            <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(01)</p>
                            <h2 class="text-3xl lg:text-4xl font-bold uppercase tracking-wider text-white mb-6">
                                STUUR ONS<br>EEN BERICHT
                            </h2>
                        </div>
                        
                        <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg">
                            <form method="POST" action="{{ route('vraag.verstuur') }}" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-wide">
                                        Email Adres
                                    </label>
                                    <input 
                                        type="email" 
                                        class="w-full px-4 py-3 bg-black border border-gray-600 text-white rounded-lg focus:border-pblue focus:outline-none focus:ring-1 focus:ring-pblue transition-colors duration-300" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        placeholder="naam@voorbeeld.com" 
                                        required 
                                        autofocus
                                    >
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-2 uppercase tracking-wide">
                                        Vraag / Opmerking
                                    </label>
                                    <textarea 
                                        class="w-full px-4 py-3 bg-black border border-gray-600 text-white rounded-lg focus:border-pblue focus:outline-none focus:ring-1 focus:ring-pblue transition-colors duration-300 resize-none" 
                                        name="vraag" 
                                        rows="8" 
                                        placeholder="Beschrijf uw vraag of opmerking..." 
                                        required
                                    >{{ old('vraag') }}</textarea>
                                </div>
                                <div class="pt-4">
                                    <button 
                                        type="submit" 
                                        class="w-full bg-pblue text-black px-6 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300 rounded-lg"
                                    >
                                        VERSTUUR BERICHT
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <div class="mb-8">
                            <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(02)</p>
                            <h2 class="text-3xl lg:text-4xl font-bold uppercase tracking-wider text-white mb-6">
                                CONTACT<br>INFORMATIE
                            </h2>
                        </div>

                        <div class="space-y-6">
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">RESPONSE TIJD</h3>
                                <p class="text-gray-400">We proberen binnen 48 uur te reageren op alle berichten</p>
                            </div>
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">SUPPORT TIJDEN</h3>
                                <p class="text-gray-400">Maandag t/m vrijdag: 09:00 - 17:00<br>Weekend: Beperkte ondersteuning</p>
                            </div>
                            <div class="border-l-2 border-chiffon pl-6">
                                <h3 class="text-lg font-semibold text-pblue mb-2">PLATFORM VRAGEN</h3>
                                <p class="text-gray-400">Voor technische problemen of account vragen</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-32 border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <div class="mb-20">
                    <p class="text-sm uppercase tracking-widest text-gray-400 mb-4">(03)</p>
                    <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                        VEELGESTELDE<br>VRAGEN
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg text-left">
                        <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">HOE WERKT HET PLATFORM?</h3>
                        <p class="text-gray-400">Gebruikers kunnen contact opnemen met monteurs, problemen delen via berichten en foto's, en facturen ontvangen.</p>
                    </div>
                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg text-left">
                        <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">IS HET PLATFORM GRATIS?</h3>
                        <p class="text-gray-400">Het gebruik van het platform is gratis. Alleen de uitgevoerde werkzaamheden worden gefactureerd door de monteur.</p>
                    </div>
                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg text-left">
                        <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">HOE VIND IK EEN MONTEUR?</h3>
                        <p class="text-gray-400">Na registratie kunt u zoeken naar monteurs in uw regio en direct contact opnemen via berichten.</p>
                    </div>
                    <div class="bg-gray-900/30 border border-gray-800 p-8 rounded-lg text-left">
                        <h3 class="text-lg font-semibold text-chiffon mb-4 uppercase tracking-wide">IS MIJN DATA VEILIG?</h3>
                        <p class="text-gray-400">Ja, we hanteren strikte privacy-standaarden en uw gegevens worden veilig opgeslagen en verwerkt.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alternative Contact Section -->
        <section class="py-32 border-t border-gray-800">
            <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
                <h2 class="text-4xl lg:text-6xl font-black uppercase tracking-wider mb-8">
                    MEER INFORMATIE<br> OVER ONZE FILOSOFIE
                </h2>
                <p class="text-xl text-gray-300 mb-12">
                    Bekijk onze andere pagina's voor meer informatie
                </p>
                <div class="space-x-6">
                    <a href="{{ route('home') }}" class="inline-block bg-pblue text-black px-8 py-4 font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                        TERUG NAAR HOME
                    </a>
                    <a href="/about" class="inline-block border-2 border-pblue text-pblue px-8 py-4 font-medium uppercase tracking-wider hover:bg-white hover:text-black transition-colors duration-300">
                        OVER PITSTOP
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection