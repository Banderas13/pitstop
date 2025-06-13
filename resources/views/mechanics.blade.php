@extends('layouts.app')

@section('content')
    <div class="text-center py-5">
        <h2>Jouw Mechaniekers</h2>
        <div class="w-25 mx-auto my-5">
            <ul>
                @if ($mechanics->isEmpty())
                    <li>Geen Mechaniekers gevonden!</li>
                @else
                    @foreach($mechanics as $mechanic)
                        <li>{{ $mechanic->name }} - {{ $mechanic->company_name }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
        <hr class="w-25 mx-auto my-5">
        <form method="GET" action="{{ route('mechanics.search') }}" class="mb-4">
            <input type="text" name="search" class="form-control w-50 mx-auto" placeholder="Zoek een mechanieker..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary mt-2">Zoeken</button>
        </form>
        <ul>
            @if ($searchedMechanics->isEmpty())
                <li>Geen zoekresultaten gevonden.</li>
            @else
                @foreach($searchedMechanics as $mechanic)
                    <li>
                        {{ $mechanic->name }} - {{ $mechanic->company_name }}

                        @if (!$mechanics->contains($mechanic->id))
                            <form method="POST" action="{{ route('mechanics.add', $mechanic->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Toevoegen</button>
                            </form>
                        @else
                            <span class="text-muted">(al toegevoegd)</span>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
@endsection