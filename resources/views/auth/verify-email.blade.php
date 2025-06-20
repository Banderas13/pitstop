@extends('layouts.app')

@section('content')
    @if (session('status') == 'verification-link-sent')
        <div class="bg-green-900/50 border border-green-800 text-green-200 px-6 py-4 mx-6 lg:mx-8 mt-8 rounded-lg">
            {{ __('Een nieuwe verificatie link is verzonden naar uw e-mailadres.') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-900/50 border border-green-800 text-green-200 px-6 py-4 mx-6 lg:mx-8 mt-8 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="min-h-screen bg-black flex items-center justify-center py-12 px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="bg-gray-900/80 backdrop-blur-sm border border-gray-800 p-12 rounded-lg">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold uppercase tracking-wider text-white mb-4">
                        E-MAIL VERIFICATIE
                    </h1>
                    <div class="w-16 h-1 bg-pblue mx-auto"></div>
                </div>

                <div class="text-center">
                    <p class="text-gray-300 mb-8 leading-relaxed">
                        {{ __('Als u de e-mail niet heeft ontvangen') }},
                        <form class="inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="text-pblue hover:text-chiffon underline font-medium transition-colors duration-300">
                                {{ __('klik hier om een nieuwe te vragen') }}
                            </button>.
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection 