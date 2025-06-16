@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="py-3">
        <h2>Contact</h2>
        <form method="POST" action="{{ route('vraag.verstuur') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="naam@voorbeeld.com" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Vraag/opmerking</label>
                <textarea class="form-control" name="vraag" rows="15" placeholder="" required></textarea>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">
                    Verstuur
                </button> 
            </div>
        </form>
    </div>
@endsection