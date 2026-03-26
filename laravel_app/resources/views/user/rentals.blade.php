@extends('layouts.app')

@section('content')
<div class="container my-5">

    <h2 class="mb-4">Moja renta</h2>

    @if($rentals->count() > 0)

        @php
            $totalSum = 0;
            foreach ($rentals as $rental) {
                // RAČUNAMO SAMO PENDING I ACCEPTED
                if (
                    $rental->vehicle &&
                    in_array($rental->status, ['pending', 'accepted'])
                ) {
                    $totalSum += $rental->days * $rental->vehicle->price_per_day;
                }
            }
        @endphp

        <div class="row">

            {{-- LEVA STRANA – LISTA IZNAJMLJIVANJA --}}
            <div class="col-md-9">
                <div class="row g-4">
                    @foreach($rentals as $rental)
                        <div class="col-md-6">
                            <div class="card shadow-sm h-100">

                                @if($rental->vehicle && $rental->vehicle->image1)
                                    <img 
                                        src="{{ asset('vehicle_images/'.$rental->vehicle->image1) }}"
                                        class="card-img-top"
                                        style="height: 220px; object-fit: cover;">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ optional($rental->vehicle)->name ?? 'Obrisana oprema' }}
                                    </h5>

                                    <p class="text-muted mb-1">
                                        {{ optional($rental->vehicle)->price_per_day }} RSD / dan
                                    </p>

                                    <p class="mb-1">
                                        <strong>Broj dana:</strong> {{ $rental->days }}
                                    </p>

                                    <p class="mb-2">
                                        <strong>Ukupna cena:</strong>

                                        @if(in_array($rental->status, ['pending', 'accepted']))
                                            <span class="badge bg-success">
                                                {{ $rental->days * optional($rental->vehicle)->price_per_day }} RSD
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                0 RSD
                                            </span>
                                        @endif
                                    </p>

                                    <p>
                                        <strong>Status:</strong>
                                        @if($rental->status === 'pending')
                                            <span class="badge bg-warning text-dark">Na čekanju</span>
                                        @elseif($rental->status === 'accepted')
                                            <span class="badge bg-success">Prihvaćeno</span>
                                        @else
                                            <span class="badge bg-danger">Odbijeno</span>
                                        @endif
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- DESNA STRANA – UKUPNA CENA --}}
            <div class="col-md-3">
                <div class="card shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Ukupna cena</h5>

                        <div class="display-6 fw-bold text-success">
                            {{ $totalSum }} RSD
                        </div>

                       
                    </div>
                </div>
            </div>

        </div>

    @else
        <p class="text-muted">Nemate nijedno iznajmljivano vozilo.</p>
    @endif

</div>
@endsection
