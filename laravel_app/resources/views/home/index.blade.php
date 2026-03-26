@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Lista vozila za iznajmljivanje</h1>

        {{-- DESNI DEO: dugmad --}}
        <div class="d-flex gap-2">
            {{-- Dugme za pregled zahteva --}}
            <a href="{{ route('home.requests') }}" class="btn btn-outline-secondary">
                📄 Pregled zahteva
            </a>

            {{-- Dugme za dodavanje nove opreme --}}
            <a href="{{ route('home.newVehicle') }}" class="btn btn-primary">
                + Dodaj vozilo
            </a>
        </div>
    </div>

    @if(isset($myVehicle) && $myVehicle->count() > 0)
        <ul class="list-group">
            @foreach($myVehicle as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">

                    {{-- LEVI DEO: slika + info --}}
                    <div class="d-flex align-items-center gap-3">
                        {{-- Prikaz slike ako postoji --}}
                        @if($item->image1)
                            <img 
                                src="{{ asset('vehicle_images/' . $item->image1) }}" 
                                alt="{{ $item->name }}"
                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 6px;">
                        @else
                            {{-- Placeholder ako nema slike --}}
                            <div 
                                style="width: 70px; height: 70px; background:#f0f0f0; 
                                       border-radius:6px; display:flex; 
                                       align-items:center; justify-content:center;
                                       color:#999; font-size:12px;">
                                Nema slike
                            </div>
                        @endif

                        <div>
                            <strong>{{ $item->name }}</strong><br>
                            <small class="text-muted">
                                {{ $item->price_per_day }} RSD / dan
                            </small>
                        </div>
                    </div>
                    
                    {{-- DESNI DEO: delete dugme --}}
                    <form action="{{ route('home.deleteVehicle', $item->id) }}" 
                          method="POST"
                          onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovaj proizvod?')">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('home.editVehicle', $item->id) }}" class="btn btn-sm btn-outline-primary me-2">
                        Izmeni
                    </a>
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            Obriši
                        </button>
                    </form>

                </li>
            @endforeach
        </ul>
    @else
        <p>Trenutno nemate dodato vozilo.</p>
    @endif
</div>
@endsection
