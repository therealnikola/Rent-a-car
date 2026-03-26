@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="row g-5 align-items-start">

        {{-- LEVA STRANA – SLIKA --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                @if($vehicle->image1)
                    <img 
                        src="{{ asset('vehicle_images/'.$vehicle->image1) }}" 
                        class="img-fluid rounded"
                        style="object-fit: cover; max-height: 420px;"
                        alt="{{ $vehicle->name }}">
                @else
                    <div class="p-5 text-center text-muted">
                        Nema dostupne slike
                    </div>
                @endif
            </div>
        </div>

        {{-- DESNA STRANA – PODACI + ZAHTEV --}}
        <div class="col-md-6">

            <h2 class="fw-bold mb-3">
                {{ $vehicle->name }}
            </h2>

            <p class="text-muted mb-4">
                {{ $vehicle->description }}
            </p>

            <div class="mb-4">
                <span class="badge bg-success fs-6 px-3 py-2">
                    <span id="pricePerDay">{{ $vehicle->price_per_day }}</span> RSD / dan
                </span>
            </div>

            <hr>

            {{-- ULOGOVANI KORISNIK --}}
            @auth
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body">

                        <h5 class="mb-3">Zahtev za iznajmljivanje</h5>

                        <form action="{{ route('vehicle.request', $vehicle->id) }}" method="POST">
                            @csrf

                            {{-- BROJ DANA --}}
                            <div class="mb-3">
                                <label class="form-label">Broj dana iznajmljivanja</label>
                                <input 
                                    type="number" 
                                    name="days"
                                    id="daysInput"
                                    class="form-control"
                                    min="1"
                                    value="1">
                            </div>

                            {{-- UKUPNA CENA --}}
                            <div class="mb-3">
                                <label class="form-label">Ukupna cena</label>
                                <input 
                                    type="text"
                                    id="totalPrice"
                                    class="form-control"
                                    readonly
                                    value="{{ $vehicle->price_per_day }} RSD">
                            </div>

                            {{-- PORUKA --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    Poruka uz zahtev <span class="text-muted">(opciono)</span>
                                </label>
                                <textarea 
                                    name="text" 
                                    class="form-control" 
                                    rows="4"
                                    placeholder="Npr. potrebno je vozilo na 3 dana..."></textarea>
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-success px-4">
                                    Pošalji zahtev
                                </button>

                                {{-- NOVI BUTTON --}}
                                <a href="{{ route('user.rentals') }}" class="btn btn-outline-primary">
                                    Moja iznajmljivanja
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            @else
                {{-- GOST --}}
                <div class="alert alert-warning mt-4">
                    Morate biti prijavljeni da biste poslali zahtev za iznajmljivanje.
                </div>

                <a href="{{ route('login') }}" class="btn btn-primary">
                    Prijavi se
                </a>
            @endauth

            {{-- PORUKA O USPEHU --}}
            @if(session('msg'))
                <div class="alert alert-success mt-4">
                    {{ session('msg') }}
                </div>
            @endif

        </div>
    </div>
</div>

{{-- JAVASCRIPT ZA OBRAČUN CENE --}}
<script>
    const pricePerDay = {{ $vehicle->price_per_day }};
    const daysInput = document.getElementById('daysInput');
    const totalPriceInput = document.getElementById('totalPrice');

    function calculateTotal() {
        const days = parseInt(daysInput.value) || 1;
        const total = days * pricePerDay;
        totalPriceInput.value = total + ' RSD';
    }

    daysInput.addEventListener('input', calculateTotal);
</script>

@endsection
